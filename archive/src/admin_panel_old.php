<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tau Kappa Epsilon - Lambda Upsilon</title>
    <meta name="description" content="Tau Kappa Epsilon fraternity, Lambda Upsilon Colony at Georgia Southern University. Find out more about news, philanthropy, and recruitment information.">


    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/tke.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="shortcut icon" href="/img/favicon.ico" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

	<body>

		<!-- header -->
		<?php
		session_start();
		if (isset($_SESSION['user'])) {
			if ($_SESSION['user'] == $_SESSION['dbUser'] && $_SESSION['dbAdmin'] && $_SESSION['pass'] == $_SESSION['dbPass']){
				$path = $_SERVER['DOCUMENT_ROOT']."/include/navbar.html";
				include_once($path);
				
				$path = $_SERVER['DOCUMENT_ROOT']."/include/functions.php";
				include_once($path);
				
				global $db;
				
				pdo_open_admin();
				
				//get users in alpabetical order by last name for form
				$stmt = $db->query('SELECT users.first_name, users.last_name, users.username FROM users ORDER BY users.last_name');
				
				//get all member positions for form
				$stmtpos = $db->query('SELECT members.position FROM members WHERE members.position IS NOT NULL');
				
				//get all member_id's and image paths
				$stmtcurrent = $db->query('SELECT members.* FROM members');
			
				//store all queried values as an associative array
				$userResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$posResults = $stmtpos->fetchAll(PDO::FETCH_ASSOC);
				$currentResults = $stmtcurrent->fetchAll(PDO::FETCH_ASSOC);
				
				//set directory for image upload
				$target_dir = $_SERVER['DOCUMENT_ROOT']."/img/Members/";

				$msg = NULL;
				
				foreach ($currentResults as $row) {
					$member_id = $row['member_id'];
					$img_path = $row['img_path'];
					$scroll_num = $row['scroll_num'];
					$blurb = $row['blurb'];
					$pos = $row['position'];
					
					if($member_id == $_POST['member']){
						$current_img = $img_path;
						$current_scroll = $scroll_num;
						$current_blurb = $blurb;
						$current_pos = $pos;
					}
				}
				
				//image upload logic
				if(!empty($_FILES["fileToUpload"]["name"])){
					
					//get member name, put to lower case, replace spaces with underscores
					$filename = strtolower($_POST['member']) . "." . pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION);
					//real location
					$target_file = $target_dir . $filename;
					//create relative image path
					$relImgPath = "/img/Members/" . $filename;
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is an actual image or fake image
						$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check !== false) {
							$msg = "File is an image - " . $check["mime"] . ".";
							$uploadOk = 1;
						} else {
							$msg .= "<br />File is not an image.";
							$uploadOk = 0;
						}
					// Check if file already exists
					//if (file_exists($target_file)) {
					//	$msg .= "<br />Sorry, file already exists.";
					//	$uploadOk = 0;
					//}
					// Check file size
					if ($_FILES["fileToUpload"]["size"] > 4092000) {
						$msg .= "<br />Sorry, your file is too large.";
						$uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
						$msg .= "<br />Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						$msg .= "<br />Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
					} else {
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
							$msg .= "<br />The file ". $filename . " has been uploaded.";
						} else {
							$msg .= "<br />Sorry, there was an error uploading your file.";
						}
					}		
				} elseif($current_img != "http://placehold.it/400x300") {
					$relImgPath = $current_img;
				} else {
					$relImgPath = $img_path = "http://placehold.it/400x300";
				}
				
				//get member data if submit has been pressed
				if(isset($_POST['submit'])) {
					$member = $_POST['member'];
					$scroll = $_POST['scroll'];
					$blurb = $_POST['blurb'];
					
					//if position is left blank, look for the new position
					if($_POST['position']=="---"){
						$position = $_POST['newposition'];
						if($position == ""){
							$position = $current_pos;
						}
					} else {
						$position = $_POST['position'];
					}	
					
					//Check if a new scroll value has been assigned
					if($scroll == NULL || $scroll == 0 || $scroll == ""){
						$scroll = $current_scroll;
					}
					
					//check if new blurb value has been assigned
					if($blurb == NULL || $blurb == ""){
						$blurb = $current_blurb;
					}
					
					//update member table with new information
					$stmtMem = $db->prepare("
									UPDATE members
									SET 
									scroll_num = :scrollnum,
									blurb = :blurb,
									position = :position,
									img_path = :img_path
									WHERE member_id = :member"
									);
					$stmtMem->bindParam(':scrollnum', $scroll);
					$stmtMem->bindParam(':blurb', $blurb);
					$stmtMem->bindParam(':position', $position);
					$stmtMem->bindParam(':img_path', $relImgPath);
					$stmtMem->bindParam(':member', $member);
					
					if($stmtMem->execute()){
						$msg .= "<br />Member updated";
					} else {
						$msg .= "<br />Member profile not updated.";
					}
				}
				

				
				//wrapper
				echo "<div class='container wrapper'>";
				
				//error message
				echo "<p>".$msg."</p>"; 
					
				//page content
				echo "	
					<div class='row thumbnail'>
						<h1 class='text-center'>Add User</h1>
						<form class='form-horizontal admin' role='form' method='post' action='/admin/panel/user.php'>
							<div class='form-group'>
								<label for='first_name' class='col-sm-2 control-label'>First Name</label>
								<div class='col-sm-10'>
									<input type='text' class='form-control' id='first_name' name='first_name' placeholder='First Name' value=''>
								</div>
							</div>
							<div class='form-group'>
								<label for='last_name' class='col-sm-2 control-label'>Last Name</label>
								<div class='col-sm-10'>
									<input type='text' class='form-control' id='last_name' name='last_name' placeholder='Last Name' value=''>
								</div>
							</div>
							<div class='form-group'>
								<label for='email' class='col-sm-2 control-label'>Email</label>
								<div class='col-sm-10'>
									<input type='email' class='form-control' id='email' name='email' placeholder='example@domain.com' value=''>
								</div>
							</div>
							<div class='form-group'>
								<label for='dob' class='col-sm-2 control-label'>Birthday</label>
								<div class='col-sm-10'>
									<input type='date' class='form-control' id='dob' name='dob' placeholder='' value=''>
								</div>
							</div>
							<div class='form-group'>
								<label for='username' class='col-sm-2 control-label'>Username</label>
								<div class='col-sm-10'>
									<input type='text' class='form-control' id='username' name='username' placeholder='username' value=''>
								</div>
							</div>
							<div class='form-group'>
								<label for='password' class='col-sm-2 control-label'>Password</label>
								<div class='col-sm-10'>
									<input type='password' class='form-control' id='password' name='password' placeholder='password' value=''>
								</div>
							</div>
							<div class='form-group'>
								<label for='admin' class='col-sm-2 control-label'>Admin</label>
								<div class='col-sm-10'>
									<select name= 'admin' class='form-control'>
										<option value='0'>Member</option>
										<option value='1'>Admin</option>
									</select>
								</div>
							</div>
							<div class='form-group'>
								<div class='col-sm-10 col-sm-offset-2'>
									<input id='submit' name='submit' type='submit' value='Add User' class='btn btn-primary'>
								</div>
							</div>
						</form>
					</div>
					
					<div class='row thumbnail'>
						<h1 class='text-center'>Update Password</h1>
						<form class='form-horizontal admin' role='form' method='post' action='/admin/panel/password.php' enctype='multipart/form-data'>
							<div class='row form-group'>
								<label for='current_pass' class='col-sm-2 control-label'>Current Password:</label>
								<div class='col-sm-10'>
									<input type='password' class='form-control' id='current_pass' name='current_pass' placeholder='current password' value=''>
								</div>
							</div>
							<div class='row form-group'>
								<label for='new_pass' class='col-sm-2 control-label'>New Password:</label>
								<div class='col-sm-10'>
									<input type='password' class='form-control' id='new_pass' name='new_pass' placeholder='new password' value=''>
								</div>
							</div>
							<div class='row form-group'>
								<label for='conf_new_pass' class='col-sm-2 control-label'>Confirm New Password:</label>
								<div class='col-sm-10'>
									<input type='password' class='form-control' id='conf_new_pass' name='conf_new_pass' placeholder='new password' value=''>
								</div>
							</div>
							<div class='row form-group'>
								<div class='col-sm-10 col-sm-offset-2'>
									<input id='post' name='post' type='submit' value='Update Password' class='btn btn-primary'>
								</div>
							</div>
						</form>
					</div>
					
					<!-- Add/edit member data for existing user -->
					<div class='row thumbnail'>
						<h1 class='text-center'>Edit member data for existing users</h1>
						<form class='form-horizontal admin' role='form' method='post' action='/admin/panel/index.php' enctype='multipart/form-data'>
							<div class='form-group'>
								<label for='member' class='col-sm-2 control-label'>Member</label>
								<div class='col-sm-10'>
									<select name= 'member' class='form-control'>
										";
				foreach ($userResults as $row) {
					$firstName = $row['first_name'];
					$lastName = $row['last_name'];
					$username = $row['username'];
					
					echo '<option value='.$username.'>'.$firstName.' '.$lastName.'</option>';
				}
				echo "
									</select>
								</div>
							</div>
							<div class='form-group'>
								<label for='position' class='col-sm-2 control-label'>Position</label>
								<div class='col-sm-10'>
									<select name='position' class='form-control'>
										<option value='---'>---</option>";
										
				foreach ($posResults as $row) {
					$position = $row['position'];
					
					echo '<option value='.$position.'>'.$position.'</option>';
				};
				
				echo "
									</select>
								</div>
							</div>
							<div class='form-group'>
								<label for='newposition' class='col-sm-2 control-label'>New Position</label>
								<div class='col-sm-10'>
									<input type='text' class='form-control' id='newposition' name='newposition' placeholder='New position'>
								</div>
							</div>
							<div class='form-group'>
								<label for='scroll' class='col-sm-2 control-label'>Scroll #</label>
								<div class='col-sm-10'>
									<!-- We should look into crating the default value of the value tag the lowest current scroll# -->
									<input type='number' class='form-control' id='scroll' name='scroll' placeholder='###' value=''>
								</div>
							</div>
							<div class='form-group'>
								<label for='blurb' class='col-sm-2 control-label'>Blurb</label>
								<div class='col-sm-10'>
									<textarea class='form-control' rows='4' name='blurb'></textarea>
								</div>
							</div>
							<div class='form-group'>
								<label for='member_img' class='col-sm-2 control-label'>Member Image</label>
								<div class='col-sm-10'>
									<input type='file' name='fileToUpload' id='fileToUpload'>
								</div>
							</div>
							<div class='form-group'>
								<div class='col-sm-10 col-sm-offset-2'>
									<input id='submit' name='submit' type='submit' value='Edit Member' class='btn btn-primary'>
								</div>
							</div>
						</form>
					</div>
				</div>
				</div>";

				//include footer
				$path = $_SERVER['DOCUMENT_ROOT']."/include/footer.html";
				include_once($path);
			} else {
				echo "Access denied.";
			}
		} else {
			echo "Access denied.";
		}
		?>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" defer></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js" defer></script>

	</body>

</html>

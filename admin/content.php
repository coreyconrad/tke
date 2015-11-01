	<body>
		<?php
		
		$path = $_SERVER['DOCUMENT_ROOT']."/include/functions.php";
		include_once($path);
		
		global $db;
		
		pdo_open_admin();
		
		//get users in alpabetical order by last name for form
		$stmt = $db->query('SELECT users.first_name, users.last_name, users.username FROM users ORDER BY users.last_name');
		
		//get all member positions for form
		$stmtpos = $db->query('SELECT members.position FROM members WHERE members.position IS NOT NULL');
    
		//store all queried values as an associative array
		$userResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$posResults = $stmtpos->fetchAll(PDO::FETCH_ASSOC);
		
		//set directory for image upload
		$target_dir = $_SERVER['DOCUMENT_ROOT']."/img/Members/";

		
		$msg = NULL;
		
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
		}
		
		//get member data if submit has been pressed
		if(isset($_POST['submit'])) {
			$member = $_POST['member'];
			$scroll = $_POST['scroll'];
			$blurb = $_POST['blurb'];
			
			//if position is left blank, look for the new position
			if($_POST['position']=="---"){
				$position = $_POST['newposition'];
			} else {
				$position = $_POST['position'];
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
		?>

		<!-- wrapper -->
		<div class="container wrapper">
		
			<?php echo "<p>".$msg."</p>"; ?>
			
			<!-- Add new user -->
			<div class="row">
				<h1>Add User</h1>
				<hr>
				<form class="form-horizontal" role="form" method="post" action="/admin/user.php">
					<div class="form-group">
						<label for="first_name" class="col-sm-2 control-label">First Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="last_name" class="col-sm-2 control-label">Last Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="dob" class="col-sm-2 control-label">Birthday</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="dob" name="dob" placeholder="" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input type="tel" class="form-control" id="username" name="username" placeholder="username" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="password" name="password" placeholder="password" value="">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Add User" class="btn btn-primary">
						</div>
					</div>
				</form>
				<hr>
			</div>
			
			<!-- Add/edit member data for existing user -->
			<div class="row">
				<h1>Edit member data for existing users</h1>
				<hr>
				<form class="form-horizontal" role="form" method="post" action="/admin/index.php" enctype="multipart/form-data">
					<div class="form-group">
						<label for="member" class="col-sm-2 control-label">Member</label>
						<div class="col-sm-10">
							<select name= "member" class="form-control">
								<?php
									foreach ($userResults as $row) {
										$firstName = $row['first_name'];
										$lastName = $row['last_name'];
										$username = $row['username'];
										
										echo "<option value=".$username.">".$firstName." ".$lastName."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="position" class="col-sm-2 control-label">Position</label>
						<div class="col-sm-10">
							<select name="position" class="form-control">
								<option value="---">---</option>
								<?php
									foreach ($posResults as $row) {
										$position = $row['position'];
										
										echo "<option value=".$position.">".$position."</option>";
									}									
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="newposition" class="col-sm-2 control-label">New Position</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="newposition" name="newposition" placeholder="New position">
						</div>
					</div>
					<div class="form-group">
						<label for="scroll" class="col-sm-2 control-label">Scroll #</label>
						<div class="col-sm-10">
							<!-- We should look into crating the default value of the value tag the lowest current scroll# -->
							<input type="number" class="form-control" id="scroll" name="scroll" placeholder="###" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="blurb" class="col-sm-2 control-label">Blurb</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="blurb"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="member_img" class="col-sm-2 control-label">Member Image</label>
						<div class="col-sm-10">
							<input type="file" name="fileToUpload" id="fileToUpload">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Edit Member" class="btn btn-primary">
						</div>
					</div>
				</form>
				<hr>
			</div>

		</div>
	</body>
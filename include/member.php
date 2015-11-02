<?php
//get users in alpabetical order by last name for form
$stmtUser = $db->query('SELECT users.first_name, users.last_name, users.username FROM users ORDER BY users.last_name');

//get all member positions for form
$stmtMemberPosition = $db->query('SELECT members.position FROM members WHERE members.position IS NOT NULL');

//get all member_id's and image paths
$stmtMemberIdImg = $db->query('SELECT members.* FROM members');

//store all queried values as an associative array
$userResults = $stmtUser->fetchAll(PDO::FETCH_ASSOC);
$memPosResults = $stmtMemberPosition->fetchAll(PDO::FETCH_ASSOC);
$IDImgResults = $stmtMemberIdImg->fetchAll(PDO::FETCH_ASSOC);

//function to display form, $e variable is to display error messages at the top
function addMemberForm ($msg) {
	
//get the database query results as global variables
global $userResults;
global $memPosResults;
global $IDImgResults;

echo "<!-- Add/edit member data for existing user -->
		<div class='row thumbnail'>
			<h1 class='text-center'>Edit member data for existing users</h1>".
			$msg."
			<form class='form-horizontal admin' role='form' method='post' action='/admin/panel/admin.php' enctype='multipart/form-data'>
				<div class='form-group'>
					<label for='member' class='col-sm-2 control-label'>Member</label>
					<div class='col-sm-10'>
						<select name= 'member' class='form-control'>";

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

foreach ($memPosResults as $row) {
	$position = $row['position'];
	
	echo '<option value='.$position.'>'.$position.'</option>';
}

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
					<input id='submit-member' name='submit-member' type='submit' value='Edit Member' class='btn btn-primary'>
				</div>
			</div>
		</form>
	</div>";						
};

if(isset($_POST['submit-member']) && $_SESSION['dbAdmin']) {
	//set directory for image upload
	$target_dir = $_SERVER['DOCUMENT_ROOT']."/img/Members/";
	
	//set error message to none
	$e = "";
	
	//define current_img for reasons I don't know
	$current_img = "";
	
	//loop through and assign variables
	foreach ($stmtMemberIdImg as $row) {
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
				$e = "<h4 class='text-center'>File is an image - " . $check["mime"] . ".</h4>";
				$uploadOk = 1;
			} else {
				$e .= "<h4 class='text-center'>File is not an image</h4>";
				$uploadOk = 0;
			}
		// Check if file already exists
		//if (file_exists($target_file)) {
		//	$e .= "<br />Sorry, file already exists.";
		//	$uploadOk = 0;
		//}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 4092000) {
			$e .= "<h4 class='text-center'>Sorry, your file is too large.</h4>";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$e .= "<h4 class='text-center'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h4>";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$e .= "<br />Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$e .= "<h4 class='text-center'>The file ". $filename . " has been uploaded.</h4>";
			} else {
				$e .= "<h4 class='text-center'>Sorry, there was an error uploading your file.<h4>";
			}
		}		
	//GARRETT WE NEED COMMENTS HERE
	} elseif($current_img != "http://placehold.it/400x300") {
		$relImgPath = $current_img;
	} else {
		$relImgPath = $img_path = "http://placehold.it/400x300";
	}
	
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
		$e .= "<h4 class='text-center'>Member updated<h4>";
	} else {
		$e .= "<h4 class='text-center'>Member profile not updated.</h4>";
	}
	
	//re-display member update form with completion message
	addMemberForm($e);
//display member form after submission for non-admins
} elseif (isset($_POST['submit-member']) && !$_SESSION['dbAdmin']){
	echo "This is what is visible if submit has been pressed on the non-admin member form";
//display member form for admins
} elseif ($_SESSION['dbAdmin']) {	
	$e = "<h4 class='text-center'>FOR ADMINS</h4>";
	addMemberForm($e);
//display member form for all other members
} else {
	$e = "<h4 class='text-center'>FOR NON-ADMINS</h4>";
	addMemberForm($e);
}
?>
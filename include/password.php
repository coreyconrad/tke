<?php

function addPasswordForm ($msg) {
	echo "					
	<div class='row thumbnail'>
		<h1 class='text-center'>Update Password</h1>"
		.$msg."
		<form class='form-horizontal admin' role='form' method='post' action='/admin/panel/admin.php' enctype='multipart/form-data'>
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
					<input id='submit-pw' name='submit-pw' type='submit' value='Update Password' class='btn btn-primary'>
				</div>
			</div>
		</form>
	</div>";
}

if (isset($_POST['submit-pw'])) {
	$stmt = $db->query('SELECT users.username, users.password FROM users WHERE users.username = "'.$_SESSION['dbUser'].'"');
	
	$userResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$current_pass = md5($_POST['current_pass']);
	$db_pass = $userResults[0]['password'];
	$new_pass = md5($_POST['new_pass']);
	$conf_new_pass = md5($_POST['conf_new_pass']);
	
	//check to see if current password matches database
	if ($db_pass == $current_pass) {
		//if new password confirmation is successful and new password is not the same as the current password
		if($new_pass == $conf_new_pass && $new_pass != $current_pass) {
			//update member table with new information
			$stmtUpdate = $db->prepare("
							UPDATE users
							SET 
							password = :new_pass
							WHERE username = :user
							");
			$stmtUpdate->bindParam(':new_pass', $new_pass);
			$stmtUpdate->bindParam(':user', $_SESSION['dbUser']);
			
			if($stmtUpdate->execute()){
				//update session variable with new password
				$_SESSION['dbPass'] = $new_pass;
				$e = "<h4 class='text-center'>Password updated</h4>";
				addPasswordForm($e);
			} else {
				$e = "<h4 class='text-center'>Password not updated</h4>";
				addPasswordForm($e);
			}
		//if new password is same as old, reject
		} elseif ($new_pass == $conf_new_pass && $new_pass == $current_pass){
			$e = "<h4 class='text-center'>New password cannot be the same as the previous password</h4>";
			addPasswordForm($e);
		//all other scenarios, reject
		} else {
			$e = "<h4 class='text-center'>Passwords do not match</h4>";
			addPasswordForm($e);
		}
	} else {
		$e = "<h4 class='text-center'>Current password does not match</h4>";
		addPasswordForm($e);		
	}
//primary display
} else {
	$e = "";
	addPasswordForm($e);
}
?>	
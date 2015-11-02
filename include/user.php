<?php

//function to display form, $msg variable is to display error messages at the top
function addUserForm ($msg) {
echo "	
		<div class='row thumbnail'>
			<h1 class='text-center'>Add User</h1>
			".$msg."
			<form class='form-horizontal admin' role='form' method='post' action='/admin/panel/admin.php'>
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
						<input id='submit-user' name='submit-user' type='submit' value='Add User' class='btn btn-primary'>
					</div>
				</div>
			</form>
		</div>";	
}
//if submit-user has been pressed, begin checking data
if(isset($_POST['submit-user']) && $_SESSION['dbAdmin']) {

	//hold number of errors in form
	$formError = 0;
	//initialize errorm essage
	$e="";
	
	//check to see if post value is empty. isset does not work on POST because the action of submitting the data sets the value, but leaves it empty
	if(!empty($_POST['first_name'])) {
		//if it is not empty, assign the variable
		$first_name = $_POST['first_name'];
	} else {
		//if it is empty, increment the error counter and add a message to display. Using ".=" appends error messages so it can include multiple messages
		$formError++;
		$e .= "<h4 class='text-center'>Missing first name<h4>";
	}
	
	if(!empty($_POST['last_name'])) {
		$last_name = $_POST['last_name'];
	} else {
		$formError++;
		$e .= "<h4 class='text-center'>Missing last name<h4>";
	}	
	
	if(!empty($_POST['email'])) {
		$email = $_POST['email'];
	} else {
		$formError++;
		$e .= "<h4 class='text-center'>Missing email<h4>";
	}	

	if(!empty($_POST['dob'])) {
		$dob = $_POST['dob'];
	} else {
		$formError++;
		$e .= "<h4 class='text-center'>Missing date of birth<h4>";
	}	
	
	if(!empty($_POST['username'])) {
		$username = $_POST['username'];
	} else {
		$formError++;
		$e .= "<h4 class='text-center'>Missing username<h4>";
	}	
	
	if(!empty($_POST['password'])) {
		$password = md5($_POST['password']);
	} else {
		$formError++;
		$e .= "<h4 class='text-center'>Missing password<h4>";
	}
	
	//if there are any errors in the form, redisplay it and show error messages
	if($formError != 0) {
		addUserForm($e);
	} else {
		//otherwise populate the remaining form data
		$admin = $_POST['admin'];
		$img_path = "http://placehold.it/400x300";
		//insert the data into the database. An admin PDO session must be opened outside of this include file
		$stmt = "INSERT INTO users (username,password,email,first_name,last_name,birth_date,admin) VALUES (:username,:password,:email,:first_name,:last_name,:dob,:admin)";
		$q = $db->prepare($stmt);
		$q->execute(array(	':username'=>$username,
							':password'=>$password,
							':email'=>$email,
							':first_name'=>$first_name,
							':last_name'=>$last_name,
							':dob'=>$dob,
							':admin'=>$admin));
		$stmt = "INSERT INTO members (member_id,img_path) VALUES (:member_id,:img_path)";
		$q = $db->prepare($stmt);
		$q->execute(array(	':member_id'=>$username,
							'img_path'=>$img_path));
		//redisplay the form with a message that the data entry is valid.
		$e = "<h4 class='text-center'>Added user successfully<h4>";
		addUserForm($e);
	}
} else {
	//initial form display if "submit-user" has not been pressed.
	$e = "<h4 class='text-center'>Please fill all form fields</h4>";
	addUserForm($e);
}
?>
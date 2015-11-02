<?php
	$path = $_SERVER['DOCUMENT_ROOT']."/include/functions.php";
	include_once($path);
	
	pdo_open_admin();
	
	global $db;
	
	if(!empty($_POST['first_name'])) {
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$dob = $_POST['dob'];
		$username = $_POST['username'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$img_path = "http://placehold.it/400x300";
		$admin = $_POST['admin'];
	} else {
		exit('No member name entered.');
	}
	
	//echo $first_name.$last_name.$email.$dob.$username.$password;
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
	
	header('location: /admin/index.php');
?>
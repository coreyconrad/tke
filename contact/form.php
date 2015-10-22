<?php
//check to see if message has been filled out, if there is no message presumably it is not worth emailing
if (!empty($_POST['contact-message'])) {
	
	//check to see if contact name has been set, if so strip it and save as variable
	if(isset($_POST['contact-name'])){
		$name = strip_tags(trim($_POST['contact-name']));
	}
	//check to see if a valid email has been input, if so strip it and save
	if(preg_match("/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD",$_POST['email'])){
		$email = strip_tags(trim($_POST['email']));
	}
	//no regex for phones, too many possibilities
	if(isset($_POST['contact-phone'])){
		$phone = strip_tags(trim($_POST['contact-phone']));
	}
	//for contact message, do not strip HTML but convert it to an entity so links may be preserved
	if(isset($_POST['contact-message'])){
		$message = htmlentities(trim($_POST['contact-message']), ENT_NOQUOTES);
	}
	//hard coded variable in a page
	if(isset($_POST['contact-topic'])){
		$topic = strip_tags(trim($_POST['contact-topic']));
	}
	//if topic variable is not present, do not include
	if (!empty($topic)) {
		$subject = "Message from: ".$name." about ".$topic;
	} else {
		$subject = "Message from: ".$name;
	}
    $message = $text."\r\nEmail: ".$email."\r\nPhone: ".$phone."\r\nMessage sent from tkegsu.com";
    $header = "From: admin@tkegsu.com";
    
    mail("tkegsu@gmail.com",$subject,$message,$header);
    header('location: /contact/sent.php');
} else {
    header('location: /contact/sent.php');
}
?>
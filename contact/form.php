<?php
//check to see if message has been filled out, if there is no message presumably it is not worth emailing
if (!empty($_POST['contact-message'])) {
	
	//check to see if contact name has been set, if so strip it and save as variable
	if(isset($_POST['contact-name'])){
		$name = strip_tags(trim($_POST['contact-name']));
	}
	//check to see if a valid email has been input, if so strip it and save
	if(preg_match((?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\]),$_POST['contact-email'])){
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
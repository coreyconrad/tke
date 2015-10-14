<?php
if (!empty($_POST['contact-message'])) {
    $name = $_POST['contact-name'];
    $email = $_POST['contact-email'];
    $phone = $_POST['contact-phone'];
    $text = $_POST['contact-message'];
	$topic = $_POST['contact-topic'];
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
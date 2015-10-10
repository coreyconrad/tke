<?php
if (!empty($_POST['contact-message'])) {
    $name = $_POST['contact-name'];
    $email = $_POST['contact-email'];
    $phone = $_POST['contact-phone'];
    $text = $_POST['contact-message'];
    
    $subject = "Message from: ".$name;
    $message = $text."\r\nEmail: ".$email."\r\nPhone: ".$phone."\r\nMessage sent from tkegsu.com";
    $header = "From: admin@alexgoff.net";
    
    mail("tkegsu@gmail.com",$subject,$message,$header);
    header('location: /tke/contact/sent.php');
} else {
    header('location: /tke/contact/sent.php');
}
?>
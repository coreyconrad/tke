<?php
if (!empty($_POST['contact-message'])) {
    $name = $_POST['contact-name'];
    $email = $_POST['contact-email'];
    $text = $_POST['contact-message'];
    
    $subject = "Message from: ".$name;
    $message = $text."\r\nEmail: ".$email;
    $header = "From: admin@alexgoff.net";
    
    mail("tkegsu@gmail.com",$subject,$message,$header);
    header('location: /tke/index.php');
} else {
    echo "It did not work.";
    //header('location: /tke/index.php');
}
?>
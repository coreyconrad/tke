<?php
	$path = $_SERVER['DOCUMENT_ROOT']."/include/functions.php";
	include_once($path);

	
	pdo_open_admin();
	
	global $db;
    
    $member = $_POST['member'];
    $scroll = $_POST['scroll'];
    $blurb = $_POST['blurb'];
    
    if($_POST['position']=="---"){
        $position = $_POST['newposition'];
    } else {
        $position = $_POST['position'];
    }
	
    echo $member."<br />";
    echo $scroll."<br />";
    echo $blurb."<br />";
    echo $position."<br />";
    
?>
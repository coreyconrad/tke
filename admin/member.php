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
    
    $uploaddir = '/img/Members/';
    $uploadfile = $uploaddir . basename($_FILES['memberUpload']['name']);
    
    echo '<pre>';
    if (move_uploaded_file($_FILES['memberUpload']['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Possible file upload attack!\n";
    }
    
    echo 'Here is some more debugging info:';
    print_r($_FILES);
    echo $uploadfile;
    
    print "</pre>";
    
/*if (!empty($_FILES["memberUpload"])) {
    $myFile = $_FILES["memberUpload"];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }

    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"],
        UPLOAD_DIR . $name);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }

    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
}    */
?>
<?php

function pdo_open() {
	//define database informaiton
	$dsn = 'mysql:dbname=tkegsuco_info;host=localhost;';
	//database username, this will need to be changed
	$username = 'tkegsuco_reader';
	//database password, this will need to be changed
	$password = 'a97004285e831b0dc';
	
    //attempt to open connection, if connection is not available then give an error
    try {
        $db = new PDO($dsn, $username, $password);
    } catch(PDOException $e) {
        die('Could not connect to the database.');
    }
}

?>
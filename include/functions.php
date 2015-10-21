<?php

function db_read() {
    define('DBHOST','localhost');
    define('DBUSER','database username');
    define('DBPASS','database password');
    define('DBNAME','database name');
    
    $db = new PDO("mysql:host=".DBHOST.";port=8889;dbname=".DBNAME, DBUSER, DBPASS);
    
	//define database informaiton
	$dsn = 'mysql:dbname=tkegsuco_info;host=localhost;';
	//database username, this will need to be changed
	$username = 'tkegsuco_admin';
	//database password, this will need to be changed
	$password = '!Ambd-688%';
	//put colcount up here, it can go lower
	$colCount = 0;
	
		//attempt to open connection, if connection is not available then give an error
		try {
			$db = new PDO($dsn, $username, $password); // also allows an extra parameter of configuration
		} catch(PDOException $e) {
			die('Could not connect to the database.');
		}
}

?>
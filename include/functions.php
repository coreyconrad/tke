<?php

function db_read() {
    define('DBHOST','localhost');
    define('DBUSER','tkegsuco_reader');
    define('DBPASS','a97004285e831b0dc');
    define('DBNAME','tkegsuco_info');
	
    //attempt to open connection, if connection is not available then give an error
    try {
        $db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
    } catch(PDOException $e) {
        die('Could not connect to the database.');
    }
}

?>
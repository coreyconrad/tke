<?php
	session_start();
	if (isset($_SESSION['user'])) {
		if ($_SESSION['user'] == $_SESSION['dbUser'] && $_SESSION['pass'] == $_SESSION['dbPass']){
			$path = $_SERVER['DOCUMENT_ROOT']."/include/navbar.html";
			include_once($path);

			$path = $_SERVER['DOCUMENT_ROOT']."/include/functions.php";
			include_once($path);

			global $db;

			pdo_open_admin();
			
			$stmt = $db->query('SELECT users.username, users.password FROM users WHERE users.username = "'.$_SESSION['dbUser'].'"');
			
			$userResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			$msg = NULL;
			
			if(isset($_POST['submit'])) {
				
				$current_pass = md5($_POST['current_pass']);
				$new_pass = md5($_POST['password']);
				$conf_new_pass = md5($_POST['conf_new_pass']);
				

				if($new_pass == $conf_new_pass && $_SESSION['dbPass'] == $current_pass) {
					//update member table with new information
					$stmtUpdate = $db->prepare("
									UPDATE users
									SET 
									password = :new_pass"
									);
					$stmtUpdate->bindParam(':password', $password);
				}
				if($stmtUpdate->execute()){
					$msg .= "<br />Password updated";
				} else {
					$msg .= "<br />Password not updated.";
				}
			}
		}

	}
	
	header('location: /admin/panel/index.php');
	
?>	
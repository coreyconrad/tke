<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tau Kappa Epsilon - Lambda Upsilon</title>
    <meta name="description" content="Tau Kappa Epsilon fraternity, Lambda Upsilon Colony at Georgia Southern University. Find out more about news, philanthropy, and recruitment information.">


    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/tke.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="shortcut icon" href="/img/favicon.ico" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

	<body>

		<!-- header -->
		<?php
		$path = $_SERVER['DOCUMENT_ROOT']."/include/navbar.html";
		include_once($path);
		
		$path = $_SERVER['DOCUMENT_ROOT']."/include/functions.php";
		include_once($path);
		?>

		<!-- wrapper -->
		<div class="container wrapper">
			
		<!-- content -->
		<?php
		//check to see if the username and password have been input
		if(isset($_POST['username'])&&isset($_POST['password'])) {
			//start browser cache session
			session_start();

			# Check for session timeout, else initiliaze time
			if (isset($_SESSION['timeout'])) {	
				# Check Session Time for expiry
				#
				# Time is in seconds. 10 * 60 = 600s = 10 minutes
				if ($_SESSION['timeout'] + 30 * 60 < time()){
					session_destroy();
				}
			}
			else {
				# Initialize variables
				$_SESSION['user']="";
				$_SESSION['pass']="";
				$_SESSION['dbUser']="";
				$_SESSION['dbPass']="";
				$_SESSION['dbAdmin']="";
				$_SESSION['timeout']=time();
			}

			# Store POST data in session variables
			if (isset($_POST["username"])) {	
				$_SESSION['user']=$_POST['username'];
				$_SESSION['pass']=md5($_POST['password']);
			}
			
			global $db;
			
			//start read-only session
			pdo_open_read();
			
			//look for username filled out in form
			$stmt = $db->query('SELECT * FROM users WHERE username = "'.$_SESSION['user'].'"');
		
			//store all queried values as an associative array
			$userResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			//store username and hashed password
			$_SESSION['dbUser'] = $userResult[0]['username'];
			$_SESSION['dbPass'] = $userResult[0]['password'];
			$_SESSION['dbAdmin'] = $userResult[0]['admin'];
			
			//check to see if form username and password match database and if user is an admin
			if ($_SESSION['user'] == $_SESSION['dbUser'] && $_SESSION['dbAdmin'] && $_SESSION['pass'] == $_SESSION['dbPass']) {
				header('location: /admin/panel/admin.php');
			//check to see if user is a member
			} elseif($_SESSION['user'] == $_SESSION['dbUser'] && !$_SESSION['dbAdmin'] && $_SESSION['pass'] == $_SESSION['dbPass']) {
				header('location: /admin/panel/member.php');
			//if credentials are not valid, redisplay form with message that credentials are no good
			} else {
				echo "
				<div class='container log-in thumbnail'>
				<div class='row text-center'>
					<h1>Admin Login</h1>
					<h3>Invalid login credentials</h3>
				</div>
				<form class='form-horizontal' role='form' method='post' action='/admin/index.php'>
				<div class='row log-row'>
					<div class='col-sm-4'></div>
					<label for='username' class='col-sm-1 control-label'>Username:</label>
					<div class='col-sm-3'>
						<input type='text' class='col-sm-3 form-control' id='username' name='username' placeholder='username' value=''>
					</div>					
					<div class='col-sm-4'></div>
				</div>
				<div class='row log-row'>
					<div class='col-sm-4'></div>
					<label for='password' class='col-sm-1 control-label'>Password:</label>
					<div class='col-sm-3'>
						<input type='password' class='form-control' id='password' name='password' placeholder='password' value=''>
					</div>
					<div class='col-sm-4'></div>
				</div>
				<div class='row log-row'>
					<div class='col-sm-4'></div>
					<div class='col-sm-4 col-sm-offset-3'>
						<input id='submit' name='submit' type='submit' value='Login' class='btn btn-primary'>
					</div>
					<div class='col-sm-4'></div>
				</div>
				</form>
			</div>
			";
			}
		//if username and password are not set, display form
		} else {
			echo "
				<div class='container log-in thumbnail'>
				<div class='row text-center'>
					<h1>Admin Login</h1>
				</div>
				<form class='form-horizontal' role='form' method='post' action='/admin/index.php'>
				<div class='row log-row'>
					<div class='col-sm-4'></div>
					<label for='username' class='col-sm-1 control-label'>Username:</label>
					<div class='col-sm-3'>
						<input type='text' class='col-sm-3 form-control' id='username' name='username' placeholder='username' value=''>
					</div>					
					<div class='col-sm-4'></div>
				</div>
				<div class='row log-row'>
					<div class='col-sm-4'></div>
					<label for='password' class='col-sm-1 control-label'>Password:</label>
					<div class='col-sm-3'>
						<input type='password' class='form-control' id='password' name='password' placeholder='password' value=''>
					</div>
					<div class='col-sm-4'></div>
				</div>
				<div class='row log-row'>
					<div class='col-sm-4'></div>
					<div class='col-sm-4 col-sm-offset-3'>
						<input id='submit' name='submit' type='submit' value='Login' class='btn btn-primary'>
					</div>
					<div class='col-sm-4'></div>
				</div>
				</form>
			</div>
			";
		}?>		
		
		</div>

		<!-- footer -->
		<?php
			$path = $_SERVER['DOCUMENT_ROOT']."/include/footer.html";
			include_once($path);
		?>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" defer></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js" defer></script>

	</body>

</html>

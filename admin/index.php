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
		?>

		<!-- wrapper -->
		<div class="container wrapper">
		
			<div class="row text-center">
				<h1>Admin Login</h1>
			</div>
			
		<!-- content -->
		<?php
		$user = "blank";
		$password = "blank";
		if($user == "admin" && $pass == "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918"){
			$path = $_SERVER['DOCUMENT_ROOT']."/admin/content.php";
			include_once($path);
		} else {
			echo "
				<div class='container log-in'>
				<form class='form-horizontal' role='form' method='post' action='/admin/user.php'>
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
		?>		
		
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

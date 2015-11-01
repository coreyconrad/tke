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

		<!-- content -->
		<?php
		$user = "blank";
		$password = "blank";
		if($user == "admin" && $pass == "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918"){
			$path = $_SERVER['DOCUMENT_ROOT']."/admin/content.php";
			include_once($path);
		} else {
			echo "invalid";
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

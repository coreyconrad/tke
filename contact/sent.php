<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tau Kappa Epsilon - Lambda Upsilon</title>

    <!-- Bootstrap Core CSS -->
    <link href="/tke/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/tke/css/tke.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php
	header( "refresh:7; url=/tke" ); 
?>
<!-- header -->
<?php
$path = $_SERVER['DOCUMENT_ROOT']."/tke/include/navbar.html";
include_once($path);
?>

<!-- wrapper -->
<div class="container wrapper">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<header class="jumbotron">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<img src="/tke/img/lu_logo.png" class="img-responsive">
						<h2 class="text-center">Thank you for contacting us!</h2>
						<h3 class="text-center">Re-directing to <a href="/tke">home page</a> in 5 seconds...</h3>
					</div>
					<div class="col-md-3"></div>
				</div>
			</header>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>

<!-- footer -->
<?php
	$path = $_SERVER['DOCUMENT_ROOT']."/tke/include/footer.html";
	include_once($path);
?>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/tke/js/bootstrap.min.js"></script>

</body>

</html>
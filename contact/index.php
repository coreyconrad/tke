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
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/tke.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="shortcut icon" href="img/favicon.ico" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php 	
$path = $_SERVER['DOCUMENT_ROOT']."/include/navbar.html";
include_once($path);
?>
	
		<!-- Content -->
		
		<div class="container wrapper">
			<div class="row">
				<h1>Contact Us</h1>
				<hr>
				<form class="form-horizontal" role="form" method="post" action="/contact/form.php">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="contact-name" placeholder="First & Last Name" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="contact-email" placeholder="example@domain.com" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="col-sm-2 control-label">Phone #</label>
						<div class="col-sm-10">
							<input type="tel" class="form-control" id="phone" name="contact-phone" placeholder="(###) ###-####" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="message" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="contact-message"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
						</div>
					</div>
				</form>
				<hr>
			</div>
		</div>

	<!-- footer -->
	<?php
		$path = $_SERVER['DOCUMENT_ROOT']."/include/footer.html";
		include_once($path);
	?>
	
	<?php
		$path = $_SERVER['DOCUMENT_ROOT']."/include/login.html";
		include_once($path);
	?>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

</body>
</html>

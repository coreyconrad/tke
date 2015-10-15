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

	<div class="row">
		<article class="col-md-7">
			<h2>Philanthropy</h2>
			<h3>St. Jude's Childrens Hospital</h3>
			<p>Mauris ornare sagittis posuere. Morbi ultricies eros et est venenatis blandit in sit amet justo. Ut maximus malesuada neque, at rhoncus lacus convallis sit amet. Integer luctus tellus quis neque vehicula luctus. Quisque tristique aliquam urna, ut tincidunt ligula mattis vitae. Donec nunc ante, fermentum mollis sodales non, mattis a massa. Sed quis elementum risus. Integer dignissim augue vel nisi dignissim, eu faucibus risus eleifend. Mauris lacinia, nunc vel maximus consectetur, leo nunc venenatis libero, sit amet laoreet metus lectus ac diam.</p>
			<hr class="hr-dark" />
			<div class="col-md-6">
				<img class="img-responsive" src="http://placehold.it/600x600" alt="">
			</div>
			<div class="col-md-6">
				<img class="img-responsive" src="http://placehold.it/600x600" alt="">
			</div>
		</article>
		<div class="col-md-1">
		</div>
		<div class="col-md-4">
			<h3>Contact us about philanthropy opportunities</h3>
			<hr>
			<form class="form-horizontal" role="form" method="post" action="/contact/form.php">
				<div class="form-group">
					<label for="name" class="col-md-3 control-label">Name</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="name" name="contact-name" placeholder="First & Last Name" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-md-3 control-label">Email</label>
					<div class="col-md-9">
						<input type="email" class="form-control" id="email" name="contact-email" placeholder="example@domain.com" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="col-md-3 control-label">Phone #</label>
					<div class="col-md-9">
						<input type="tel" class="form-control" id="phone" name="contact-phone" placeholder="(###) ###-####" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="message" class="col-md-3 control-label">Message</label>
					<div class="col-md-9">
						<textarea class="form-control" rows="4" name="contact-message"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-9 col-md-offset-3">
						<input id="topic" type="hidden" name="contact-topic" value="philanthropy">
						<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
					</div>
				</div>
			</form>
			<hr>
		</div>
	</div>
</div>

<!-- footer -->
<?php
	$path = $_SERVER['DOCUMENT_ROOT']."/include/footer.html";
	include_once($path);
?>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>

</body>

</html>

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

<!-- header -->
<?php
$path = $_SERVER['DOCUMENT_ROOT']."/include/navbar.html";
include_once($path);
?>

<!-- wrapper -->
<div class="container wrapper">

	<div class="row">
		<article class="col-md-7">
			<h2>Recruitment</h2>
			<h3>Fall IFC RUSH</h3>
			<p>This fall’s IFC rush brought about a group of engaged men who are ready to change the negative stigma of fraternity life and propel this colony to its chartering goal. The picture above was taken shortly after our first induction ceremony of the semester. Candidates Will Baker, Zhane Roberts, Kyle Brown, Daniel Walton, Ryan Wilcauskas, Russell Burrell and Jeffrey Toler were the first to be inducted. We are currently in the process of scheduling our second induction of this semester in which we will induct three more candidates: Jordan Reep, Bradley Kostensky, and Angelo Grisby. In the meantime, each candidate will be working with their assigned big brothers to fulfill the new member education program in order to be initiated into the fraternity. We have big expectations for this class of individuals who have already proven that they are excited about TKE and eager to be a part of it. While we have already made great strides in recruiting this semester we still have yet to reach our goal for chartering. Our recruitment chairman, Frater Dylan John, has instilled a sense of urgency in these candidates to reach that goal. As a result, we have seen our candidates working hard to recruit more candidates and are proud of the effort all around. The colony will once again employ the “TKE’s Top 20” strategy to recruit the top 20 men at Georgia Southern in terms of service, academics, and character. With the help of our new candidate class, we believe our chance to charter this semester is stronger than it has ever been before.</p>
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
			<h3>Contact us for more information on starting your journey with TKE!</h3>
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
						<input id="topic" type="hidden" name="contact-topic" value="recruitment">
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

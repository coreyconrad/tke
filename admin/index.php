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
			
			<!-- Add new user -->
			<div class="row">
				<h1>Add User</h1>
				<hr>
				<form class="form-horizontal" role="form" method="post" action="/admin/user.php">
					<div class="form-group">
						<label for="first_name" class="col-sm-2 control-label">First Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="last_name" class="col-sm-2 control-label">Last Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="dob" class="col-sm-2 control-label">Birthday</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="dob" name="dob" placeholder="" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input type="tel" class="form-control" id="username" name="username" placeholder="username" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="password" name="password" placeholder="password" value="">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Add User" class="btn btn-primary">
						</div>
					</div>
				</form>
				<hr>
			</div>
			
			<!-- Add/edit member data for existing user -->
			<div class="row">
				<h1>Edit member data for existing users</h1>
				<hr>
				<form class="form-horizontal" role="form" method="post" action="/admin/user.php" enctype="multipart/form-data">
					<div class="form-group">
						<label for="member" class="col-sm-2 control-label">Member</label>
						<div class="col-sm-10">
							<select class="form-control">
								<option value="one">One</option>
								<option value="two">Two</option>
								<option value="three">Three</option>
								<option value="four">Four</option>
								<option value="five">Five</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="position" class="col-sm-2 control-label">Position</label>
						<div class="col-sm-10">
							<select class="form-control">
								<option value="one">One</option>
								<option value="two">Two</option>
								<option value="three">Three</option>
								<option value="four">Four</option>
								<option value="five">Five</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="scroll" class="col-sm-2 control-label">Scroll #</label>
						<div class="col-sm-10">
							<!-- We should look into crating the default value of the value tag the lowest current scroll# -->
							<input type="number" class="form-control" id="scroll" name="scroll" placeholder="###" value="562">
						</div>
					</div>
					<div class="form-group">
						<label for="blurb" class="col-sm-2 control-label">Blurb</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="blurb"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="member_img" class="col-sm-2 control-label">Member Image</label>
						<div class="col-sm-10">
							<input type="file" name="fileToUpload" id="fileToUpload">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Edit Member" class="btn btn-primary">
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

		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="/js/bootstrap.min.js"></script>

	</body>

</html>

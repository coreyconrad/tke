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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/tke.css" rel="stylesheet">
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
$path = $_SERVER['DOCUMENT_ROOT']."/tke/include/navbar.html";
include_once($path);
?>

    <!-- Page Content -->
    <div class="container wrapper">

        <!-- Jumbotron Header -->
		<div class="row">
			<div class="col-xs-12">
				<header class="jumbotron hero-spacer">
					<div class="row">
						<img class="col-md-2 col-xs-6" src="img/logo.png">
						<div class="col-md-10 col-xs-6">
							<h1>Tau Kappa Epsilon</h1>
							<h2>Lambda Upsilon Colony - Georgia Southern University</h2>
							<p>Motivated men redefining fraternity.</p>
						</div>
					</div>
				</header>
			</div>
		</div>
		
        <hr />

        <!-- Page Features -->
        <div class="row text-center">

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>News</h3>
                        <p>
                            <a href="/tke/news" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Recruitment</h3>
                        <p>
                            <a href="/tke/recruitment" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Philanthropy</h3>
                        <p>
                            <a href="/tke/philanthropy" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Learn about us</h3>
                        <p>
                            <a href="/tke/about" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <hr />


    </div>
    <!-- /.container -->
	
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

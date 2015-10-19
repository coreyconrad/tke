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

<?php 	
	$path = $_SERVER['DOCUMENT_ROOT']."/include/navbar.html";
	include_once($path);
	
	//define database informaiton
	$dsn = 'mysql:dbname=tkegsuco_info;host=localhost;';
	//database username, this will need to be changed
	$username = 'tkegsuco_admin';
	//database password, this will need to be changed
	$password = '!Ambd-688%';
	//put colcount up here, it can go lower
	$colCount = 0;
	
		//attempt to open connection, if connection is not available then give an error
		try {
			$db = new PDO($dsn, $username, $password); // also allows an extra parameter of configuration
		} catch(PDOException $e) {
			die('Could not connect to the database.');
		}
	
	//create a new SQL query to select all members
	$stmt = $db->query('SELECT users.first_name, users.last_name, members.scroll_num,
		members.position, members.blurb, members.img_path
		FROM users INNER JOIN members 
		ON users.username = members.member_id
		ORDER BY members.scroll_num');
	//store all queried values as an associative array
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$rowCount = $stmt->rowCount();
	
?>

<div class="container wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Members</h1>
		</div>
	</div>
		
<?php
	//begin foreach loop by storing results in individual row arrays	
	foreach ($results as $row) {
		//store array values for easy concatenation. Also I don't think you can concatenate array values.
		$first = $row['first_name'];
		$last = $row['last_name'];
		$scroll_num = $row['scroll_num'];
		$blurb = $row['blurb'];
		$position = $row['position'];
		$img = $row['img_path'];

		//if no columns have been entered, insert a new row
		if ($colCount==0) {
			echo "<div class='row'>";
		}	

		//echo HTML with variables concatenated
		echo "
			<div class='col-md-3 col-xs-6 thumb member'>
				<a class='thumbnail' href='#'>
					<img class='img-responsive' src=".$img." alt='profile picture'>
				</a>
				<h3>".$first." ".$last."</h3>
				<h4>".$position."</h4>
				<h6>Scroll Number: ".$scroll_num."</h6>
				<p>".$blurb."</p>
			</div>	
		";
		//increment column count by one
		$colCount++;
		//if the column count is divisible by 4 and the column count equals the total rows queried, this is the last column of the last row
		if ($colCount % 4 == 0 && $colCount==$rowCount) {
			echo "
				</div>
				<hr />
			";
		//if the column count is not divisible by 4 but the column count equals the total rows queried, this is the last column but the row is not full
		} elseif ($colCount==$rowCount) {
			echo "
				</div>
				<hr />
			";
		//if the column count is divisible by 4, the end of the row has been reached and a new one is opened
		} elseif ($colCount % 4 == 0) {
			echo "
				</div>
				<hr />
				<div class='row'>
			";		
		}
	}
?>

</div>
<!-- container closing div -->
	
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
<?php

function pdo_open_read() {
	//define database informaiton
	$dsn = 'mysql:dbname=tkegsuco_info;host=localhost;';
	//database username, this will need to be changed
	$username = 'tkegsuco_reader';
	//database password, this will need to be changed
	$password = 'a97004285e831b0dc';
	
    //attempt to open connection, if connection is not available then give an error
    try {
        $db = new PDO($dsn, $username, $password);
    } catch(PDOException $e) {
        die('Could not connect to the database.');
    }
}

function member_output() {
    //number of columns
    $colCount = 0;
    
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
        echo $row;
        
		//increment column count by one
		$colCount++;
        
		//if the column count is divisible by 4 and the column count equals the total rows queried, this is the last column of the last row
		if ($colCount % 4 == 0 && $colCount==$row) {
			echo "
				</div>
				<hr />
			";
		//if the column count is not divisible by 4 but the column count equals the total rows queried, this is the last column but the row is not full
		} elseif ($colCount==$row) {
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
}
?>
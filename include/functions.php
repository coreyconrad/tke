<?php

function pdo_open_read() {
    global $db;
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
        echo "Could not establish database connection.";
    }
}

function member_output() {
    global $db;
    
	//create a new SQL query to select all members
	$stmt = $db->query('SELECT users.first_name, users.last_name, members.scroll_num,
		members.position, members.blurb, members.img_path
		FROM users INNER JOIN members 
		ON users.username = members.member_id
		ORDER BY members.scroll_num');
    
	//store all queried values as an associative array
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$rowCount = $stmt->rowCount();
    
    //number of columns
    $colCount = 0;
    
	//begin foreach loop by storing results in individual row arrays
    //first foreach is for officers
    
    echo "<div class='row'>";
    
	foreach ($results as $row) {
		//store array values for easy concatenation. Also I don't think you can concatenate array values.
		$first = $row['first_name'];
		$last = $row['last_name'];
		$scroll_num = $row['scroll_num'];
		$blurb = $row['blurb'];
		$position = $row['position'];
		$img = $row['img_path'];
      
            if ($position == "Prytanis" ||
                $position == "Epiprytanis" ||
                $position == "Grammateus" ||
                $position == "Crysophylos" ||
                $position == "Histor" ||
                $position == "Hypophetes" ||
                $position == "Pylortes" ||
                $position == "Hegemon") {
    
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
            }            
        }
        
    echo "
        </div>
        <hr />
        <div class='row'>
    ";
    
	foreach ($results as $row) {
		//store array values for easy concatenation. Also I don't think you can concatenate array values.
		$first = $row['first_name'];
		$last = $row['last_name'];
		$scroll_num = $row['scroll_num'];
		$blurb = $row['blurb'];
		$position = $row['position'];
		$img = $row['img_path'];

            if ($position != "Prytanis" &&
                $position != "Epiprytanis" &&
                $position != "Grammateus" &&
                $position != "Crysophylos" &&
                $position != "Histor" &&
                $position != "Hypophetes" &&
                $position != "Pylortes" &&
                $position != "Hegemon") {
    
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
                //if the column count is divisible by 4, the end of the row has been reached and a new one is opened
                } elseif ($colCount % 4 == 0 && $colCount!=$rowCount) {
                    echo "
                        </div>
                        <hr />
                        <div class='row'>
                    ";
                //if the column count is not divisible by 4 but the column count equals the total rows queried, this is the last column but the row is not full
                } else {
                    echo "
                        </div>
                        <hr />
                    ";		
                }
            }  
        
	}    
}
?>
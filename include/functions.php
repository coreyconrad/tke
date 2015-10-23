<?php
function img_upload($location) {
	$uploadMsg = NULL;
	
	if(!empty($_FILES["fileToUpload"]["name"])){ 
		global $uploadMsg;
		
		$target_file = $location . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is an actual image or fake image
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$uploadMsg = "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$uploadMsg .= "<br />File is not an image.";
				$uploadOk = 0;
			}
		// Check if file already exists
		//if (file_exists($target_file)) {
		//	$uploadMsg .= "<br />Sorry, file already exists.";
		//	$uploadOk = 0;
		//}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 4092000) {
			$uploadMsg .= "<br />Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$uploadMsg .= "<br />Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$uploadMsg .= "<br />Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$uploadMsg .= "<br />The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				$uploadMsg .= "<br />Sorry, there was an error uploading your file.";
			}
		}		
	}
}
function pdo_open_read() {
    global $db;
	//define database informaiton
	$dsn = 'mysql:dbname=tkegsuco_info;host=localhost;';
	//database username, this will need to be changed
	$username = 'root';
    //$username = 'tkegsuco_reader';
	//database password, this will need to be changed
    $password = '';
	//$password = '';
	//$password = 'a97004285e831b0dc';
	
    //attempt to open connection, if connection is not available then give an error
    try {
        $db = new PDO($dsn, $username, $password);
    } catch(PDOException $e) {
        echo "Could not establish database connection.";
    }
}

function pdo_open_admin() {
    global $db;
	//define database informaiton
	$dsn = 'mysql:dbname=tkegsuco_info;host=localhost;';
	//database username, this will need to be changed
	//$username = 'tkegsuco_admin';
    $username = 'root';
	//database password, this will need to be changed
    //$password = '!Ambd-688%';
    $password = '';
	
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
    
    //start members page
    echo "<div class='container wrapper'>
            <div class='row'>
                <div class='col-lg-12'>
                    <h1 class='page-header'>Members</h1>
                </div>
            </div>
            <div class='row'>";
    
    //begin foreach loop by storing results in individual row arrays
    //first foreach is for officers
	foreach ($results as $row) {
        
 		//store array values for easy concatenation.       
		$first = $row['first_name'];
		$last = $row['last_name'];
		$scroll_num = $row['scroll_num'];
		$blurb = $row['blurb'];
		$position = $row['position'];
		$img = $row['img_path'];
      
            //check to see if member is an officer
            if ($position == "Prytanis" ||
                $position == "Epiprytanis" ||
                $position == "Grammateus" ||
                $position == "Crysophylos" ||
                $position == "Histor" ||
                $position == "Hypophetes" ||
                $position == "Pylortes" ||
                $position == "Hegemon") {
                
                //close row after fourth officer and start new row
                if ($colCount == 4) {
                        echo "
                                </div>
                                <hr />
                                <div class='row'>
                            ";
                }
                
                //increment counter
                $colCount++;                
                
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
    
    //close last officer row, insert horizontal rule, open new row    
    echo "
        </div>
        <hr />
        <div class='row'>
    ";
    
    //loop for members that are not officers
	foreach ($results as $row) {
		//store array values for easy concatenation.
		$first = $row['first_name'];
		$last = $row['last_name'];
		$scroll_num = $row['scroll_num'];
		$blurb = $row['blurb'];
		$position = $row['position'];
		$img = $row['img_path'];

            //check to see if member is not an officer
            if ($position != "Prytanis" &&
                $position != "Epiprytanis" &&
                $position != "Grammateus" &&
                $position != "Crysophylos" &&
                $position != "Histor" &&
                $position != "Hypophetes" &&
                $position != "Pylortes" &&
                $position != "Hegemon") {
                
                //increment column count by one, at this point count should equal 8 from the officers.
                $colCount++;
                
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
                
                //if the number of columns is divisible by 4 but is not the total number of members, this is the end of the row but not a page
                if ($colCount % 4 == 0 && $colCount != $rowCount) {
                    echo "
                            </div>
                           <hr />
                           <div class='row'>                   
                        ";
                //if the column count is not disible by 4 but equals the total number of members, end the row and the page
                } elseif ($colCount % 4 != 0 && $colCount == $rowCount) {
                    echo "
                        </div>
                        <hr />
                    ";
                //if the column count equals 4 and equals the total number of members, end the row and the page
                } elseif ($colCount % 4 == 0 && $colCount == $rowCount) {
                    echo "
                        </div>
                        <hr />
                    ";
                }
            }  
        
	}
    
    echo "</div>
        <!-- container closing div -->";
}
?>
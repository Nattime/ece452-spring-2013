<?php
	//must always include
	include 'core/init.php';
	protect_page();
	include 'includes/overall/header.php';
?>


    <h1>upload</h1>
    
    <form action="upload.php" method="post" enctype="multipart/form-data">
    	<input type="file" name="activity_file" />
        <br />
        <input type="submit" value="Upload" />
    </form>
    
    <div id="upload">
	<?php
        //check if form is submitted

  		if(isset($_FILES['activity_file']) === true){

			if(empty($_FILES['activity_file']['name']) === true){
				echo 'Please choose a file';
			}else{
				//echo $_FILES['activity_file']['name'] . ' ';
				//echo $_FILES['activity_file']['tmp_name'];
				if(move_uploaded_file($_FILES['activity_file']['tmp_name'],"./user_data/files/". $user_data['username'] . ".csv")){
					echo "Upload was successful.\n";
		
					$fp = fopen('user_data/files/' . $user_data['username'] . '.csv','r') or die("can't open file");
					$total_calories = 0;
					$cardio_points = 0;
						
					echo "<table>\n";
					echo '<tr><th>Date</th><th>Calories</th></tr>';
					while($csv_line = fgetcsv($fp,1024)){
						echo '<tr>';
						for($i = 0, $j = count($csv_line); $i < $j; $i++){
							if($i == 12){
								if(is_numeric($csv_line[$i]) === true){
									echo '<td>' . $csv_line[$i] . '</td>';
									$total_calories = $total_calories + $csv_line[$i];
								}
							}else if($i == 4){
								$array = date_parse($csv_line[$i]);
								$month = $array['month'];
								switch($month){
									case 1:
										$month = 'Jan';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
									case 2:
										$month = 'Feb';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
									case 3:
										$month = 'Mar';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
									case 4:
										$month = 'April';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
										
									case 5:
										$month = 'May';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
									case 6:
										$month = 'June';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
									case 7:
										$month = 'July';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
									case 8:
										$month = 'Aug';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
									case 9:
										$month = 'Sept';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
									case 10:
										$month = 'Oct';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
									case 11:
										$month = 'Nov';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
									case 12:
										$month = 'Dec';
										echo '<td>' . $month . ' ' . $array['day'] . '</td>';
										break;
								}
								//print_r(date_parse($csv_line[$i]));
							}
						}
						echo "</tr>\n";
					}
					echo '</table>';
					
					$cardio_points = $total_calories/30;
					
					echo '<br />Total calories burned: ' . $total_calories . ' Total cardio points earned this month: ' . round($cardio_points);
					echo '<br />';
					
					add_cardio_points($cardio_points, $user_data['user_id']);
					
					fclose($fp) or die("can't close file");

			}else{
				echo $_FILES['activity_file']['error'];
				
			}

		/*
					
                    //check if file is allowed format
                    $allowed = array('csv');
                    $file_name = $_FILES['activity_file']['name'];
                    //extract file extention from file name
                    $file_extn = strtolower(end(explode('.', $file_name)));
                    
                    //where file is temporarily stored
                    $file_temp = $_FILES['activity_file']['tmp_name'];
                    echo $file_temp;
					
                    if(in_array($file_extn, $allowed) === true){
                        //upload file 
                        uploadDeviceData($session_user_id, $file_temp, $file_extn);
                        header('Location: ' . $current_file);
                        exit();
                    }else{
                        echo ' Incorrect file type. Allowed: ';
                        echo implode(', ', $allowed);
                    }
					*/
                }
				
        }
    ?>
    </div>

	<div id="manual_data">
<?php
	//handles manual inputs
	//echo $user_data['gender'];
	//echo $_POST['month'] . $_POST['day'];
	if(isset($_POST['month']) !== false && isset($_POST['day']) !== false){
	$month = ' ';
	switch($_POST['month']){
		case 1:
			$month = 'Jan';
			break;
		case 2:
			$month = 'Feb';
			break;
		case 3:
			$month = 'Mar';
			break;
		case 4:
			$month = 'Apr';
			break;
			
		case 5:
			$month = 'May';
			break;
		case 6:
			$month = 'Jun';
			break;
		case 7:
			$month = 'Jul';
			break;
		case 8:
			$month = 'Aug';
			break;
		case 9:
			$month = 'Sep';
			break;
		case 10:
			$month = 'Oct';
			break;
		case 11:
			$month = 'Nov';
			break;
		case 12:
			$month = 'Dec';
			break;
	}
	$date = $month . ' ' . $_POST['day'];
	//echo $date;
	}
	if(isset($_POST['heartrate']) === true && empty($_POST['heartrate']) === false && isset($_POST['exercise_hours']) === true && empty($_POST['heartrate']) === false && $_POST['day'] !== -1 && $_POST['month'] !== -1){

		//check if heartrate is within range of 50 to 110
		if($_POST['heartrate'] <= 110 && $_POST['heartrate'] >= 50){
			
			//calculate calories burned depending on gender
			if($user_data['gender'] == 'female'){
				$calories = ((-20.4022 + (0.4472 * $_POST['heartrate']) - (0.1263 * $user_data['weight']) + (0.074 * $user_data['age']))/4.184) * 60 * $_POST['exercise_hours'];
			}else{
				$calories = ((-55.0969 + (0.6309 * $_POST['heartrate']) + (0.1988 * $user_data['weight']) + (0.2017 * $user_data['age']))/4.184) * 60 * $_POST['exercise_hours'];
			}
			
			$cardio_points = round((abs($calories))/30);
			//echo $cardio_points;
			//echo '  ';
			$calories = round(abs($calories));
			//echo round($calories);
			
			//transfer everything into .csv file
			$fp = fopen("./user_data/files/" . $user_data['username'] . ".csv", 'a');  //Open file for append
			
			//fwrite($fp, $row1.",".$row2); //Append row,row to file
			
			fputcsv($fp, array('', '', '', '', $date, '', '', '', '', '', '', '', $calories, '', '', '', '', '', '', ''));
			fclose($fp); //Close the file to free memory.
			echo 'Updated successfully';
		}else{
			echo 'Please enter a correct heartrate between 50 to 110. If you have a heartrate below or above the specified number, please exit this program and request to see a doctor.';
		}
	}else{
		echo 'Please fill the boxes below or upload a .csv file';
	}
?>
    	<form action="upload.php" method="post">
        	<ul>
                <li>
                	<input type="text" name="heartrate" placeholder="Heart Rate (beats/min)" />
				</li>
                <li>   
               		<input type="text" name="exercise_hours" placeholder="Exercise duration (hours)" />
                </li>
                <li>
                    <select name="month">
                    	<option value="-1">Month</option>
                    	<?php
							for($i = 1; $i <= 12; $i++){
	                    		echo '<option value="' . $i . '">' . $i . '</option>';
							}
						?>
                    </select>
                    <select name="day">
                    	<option value="-1">Day</option>
                        <?php
							for($i = 1; $i <= 31; $i++){
	                    		echo '<option value="' . $i . '">' . $i . '</option>';
							}
						?>
                    </select>
                </li>
                <li>
                    <input type="submit" value="Submit" />
                </li>
            </ul>
        </form>
    </div>


<?php include 'includes/overall/footer.php'; ?>
<?php
	/*
	NOTE: need to remove or add sending out verification/activation links depending on if you want it or not
	*/
	
	//update user score everytime it increases
	//function cardio_points(){
	//mysql_query("UPDATE `users` SET `` = '' WHERE `user_id` = '$user_id'");

	//creates a graph
	function createGraph(){
		
	}

	//manual inputs to store and stores the information in a .csv file
	function inputData($cardio_points, $user_id){
		global $user_data;
		$cardio_points = $user_data['cardio_points'] + $cardio_points;
		$cardio_points = round($cardio_points);
		echo 'Your user score is now: ' . $cardio_points;
		
		mysql_query("UPDATE `users` SET `cardio_points` = '" . $cardio_points . "' WHERE `user_id` = " . (int)$user_id);
		
		//create and store manually inputed data into a .csv file
		
		//move .csv file to user_data folder
	}

	
	//returns user tips
	function daily_tips($result){
		$result = date('w');
		//echo $result;
		if($result == 0){
			$random = rand(1,3);
			switch ($random){
				case 1:
					$result = 'Find a smart and motivated training partner.';
					break;
				case 2:
					$result = 'Schedule exact times for all workouts.';
					break;
				case 3:
					$result = 'Keep a food and training log, and learn from it!';
					break;
			}
		}
		if($result == 1){
			$random = rand(1,3);
			switch ($random){
				case 1:
					$result = 'Don\'t train in pain. Pain is your body\'s way of telling you that something\'s wrong. Listen and act upon these messages!';
					break;
				case 2:
					$result = 'Frame goals around behaviors rather than outcomes.';
					break;
				case 3:
					$result = 'Continue doing what works. (Many times we tend to discontinue doing things which have worked in the past.)';
					break;
			}
		}
		if($result == 2){
			$random = rand(1,3);
			switch ($random){
				case 1:
					$result = 'Identify and fortify weak links. This could refer to habit patterns, muscle groups, motor qualities, etc.';
					break;
				case 2:
					$result = 'In most things, the truth tends to be in the middle (rather than the extremes.)';
					break;
				case 3:
					$result = 'If you\'re under 40, hold your stretches for 30 seconds. If you\'re over 40, hold them for 60 seconds.';
					break;
			}
		}
		if($result == 3){
			$random = rand(1,3);
			switch ($random){
				case 1:
					$result = 'Count your repetitions backward.';
					break;
				case 2:
					$result = 'Exhale forcefully at the top of the movement when you do abdominal crunches.';
					break;
				case 3:
					$result = 'If you don\'t like an exercise, start doing it. \'You are probably avoiding it because you are weak at it.\'';
					break;
			}
		}
		if($result == 4){
			$random = rand(1,3);
			switch ($random){
				case 1:
					$result = 'Use dumbbells, barbells, and machines in that order.';
					break;
				case 2:
					$result = 'Keep your weight workouts under an hour.';
					break;
				case 3:
					$result = 'Ensure your morning is seamless and quick.';
					break;
			}
		}
		if($result == 5){
			$random = rand(1,3);
			switch ($random){
				case 1:
					$result = 'Envision waking up early, working out and enjoying it.';
					break;
				case 2:
					$result = 'To maximize your workout, good form is a must.';
					break;
				case 3:
					$result = 'We\'re all capable of much more than we think. Believe yourself and you can accomplish it.';
					break;
			}
		}
		if($result == 6){
			$random = rand(1,3);
			switch ($random){
				case 1:
					$result = 'Do more work in the same amount of time (workout to workout) and muscle will grow.';
					break;
				case 2:
					$result = 'In resistance training, we tend to focus too much on what to lift and not enough on how or why. Think about it.';
					break;
				case 3:
					$result = 'Try going outside an hour a day, even if its just sitting in the park or walking around.';
					break;
			}
		}
		return $result;
	}
	
	//stores user score
	function add_cardio_points($cardio_points, $user_id){
		global $user_data;
		$cardio_points = $user_data['cardio_points'] + $cardio_points;
		$cardio_points = round($cardio_points);
		echo 'Your user score is now: ' . $cardio_points;
		
		mysql_query("UPDATE `users` SET `cardio_points` = '" . $cardio_points . "' WHERE `user_id` = " . (int)$user_id);
	}
	
	//upload file, generate name, update user database with path of image
	function uploadDeviceData($user_id, $file_temp, $file_extn){
		$file_path = '../user_data/files/' . $_FILES['activity_file']['name'];
		move_uploaded_file($file_temp, "~./user_data/files/"."{$_FILES['activity_file']['name']}");
		

		
		//insert to database
		mysql_query("UPDATE `users` SET `user_file` = '" . mysql_real_escape_string($file_path) . "' WHERE `user_id` = " . (int)$user_id);
	}
	
	//checks if user is admin
	//NOTE: if changing type, need to also change 'admin_protect()' in general.php
	function has_access($user_id, $type){
		$user_id = (int)$user_id;
		$type = (int)$type;
		return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_id` = $user_id AND `type` = $type"), 0) == 1) ? true : false;
	}
	
	//recover password or username by email
	function recover($mode, $email){
		//sanitize the data to prevent injection
		$mode = sanitize($mode);
		$email = sanitize($email);
		
		$user_data = user_data(user_id_from_email($email), 'user_id', 'first_name', 'username');
		
		if($mode == 'username'){
			
			//recover username
			email($email, 'Your username', "Hello " . $user_data['first_name'] . ",\n\nYour username is: " . $user_data['username'] . "\n\n-something");
		}else if($mode == 'password'){
			
			//recover password
			$generated_password = substr(md5(rand(999, 999999)), 0, 8);
			change_password($user_data['user_id'], $generated_password);
			
			//force user to update new password after temporary password
			update_user($user_data['user_id'], array('password_recover' => '1'));
			
			email($email, 'Your password recovery', "Hello " . $user_data['first_name'] . ",\n\nYour new password is: " . $generated_password . "\n\n-something");
		}
	}
	
	//update user information
	function accountSettings($user_id, $update_data){
		$update = array();
		
		//checks every element in array is valid
		array_walk($update_data, 'array_sanitize');
		
		foreach($update_data as $field=>$data){
			$update[] = '`' . $field . '` = \'' . $data . '\'';
		}
		
		//for testing only
		//print_r($update);
		//die();
		
		mysql_query("UPDATE `users` SET " . implode(', ', $update) . " WHERE `user_id` = $user_id");
	}
	//activating the account through email
	function activate($email, $email_code){
		$email = mysql_real_escape_string($email);
		$email_code = mysql_real_escape_string($email_code);
	
		//check if email codes match
		if(mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 0"), 0) == 1){
			
			//query to update user active status
			mysql_query("UPDATE `users` SET `active` = 1 WHERE `email` = '$email'");
			return true;
		}else{
			return false;
		}
	}

	//change user password
	function change_password($user_id, $password){
		//sanitize the data
		$user_id = (int)$user_id;
		$password = md5($password);
		
		mysql_query("UPDATE `users` SET `password` = '$password', `password_recover` = 0 WHERE `user_id` = $user_id");
	}

	//store the amount of active users
	function user_count(){
		return mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `active` = 1"), 0);
	}
	
	//register new user data
	function registerUser($register_data){
		
		//for testing only
		//print_r($register_data);
		//die();
		
		//checks every element in array is valid
		array_walk($register_data, 'array_sanitize');
		$register_data['password'] = md5($register_data['password']);
		
		$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
		$data = '\'' . implode('\', \'', $register_data) . '\'';
		
		//for testing only
		//echo $data;
		//echo $fields;
		//die();
		
		mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
		
//needs to change link and url to whatever link you are using
		
		//send email of verification code
		//email($register_data['email'], 'Activate your account', "
		//Hello " . $register_data['first_name'] . ",\n\nYou need to active your account, use the link below to activate your account:\n\nhttp://se1.engr.rutgers.edu/~13group12/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . " \n\n-whoever");
	}

	//retrieves user data for usage
	function user_data($user_id){
		$data = array();
		//remove characters from the id, prevents sql injection
		$user_id = (int)$user_id;
		
		$func_num_args = func_num_args();
		$func_get_args = func_get_args();
		
		//for testing only
		//print_r($func_get_args);
		
		if($func_num_args > 1){
			unset($func_get_args[0]);
			
			$fields = '`' . implode('`, `', $func_get_args) . '`';
			$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `user_id` = $user_id"));
			
			//return data in array
			return $data;
		}
	}
	
	
	//sorts the leader in cardio_points
	function leader_list($user_id) {
		
		$sql = "SELECT * FROM `users` ORDER BY `cardio_points` DESC";
		$result = mysql_query($sql);	
		
		$i = 1;
		
		echo "<table>
		<tr><th colspan=\"5\">Top 5 Leaders</th></tr><tr><th>Number</th><th>Username</th><th>Age</th><th>Cardio Points</th><th>Gender</th></tr>";

		while ($row = mysql_fetch_array($result)) {
    			//printf("Name: %s Score: %s", $row["username"], $row["cardio_points"]);
				
				echo '<tr><td>' . $i . '</td><td>' . $row["username"] . '</td><td>' . $row["age"] . '</td><td>' . $row["cardio_points"] . '</td><td>' . $row["gender"] . '</td></tr>';
				$i++;
				if($i == 6){
					break;
				}
		}
		echo "</table>";
		return $result;
		
	}
	
	
	//checks if the user is logged in
	function logged_in(){
		return (isset($_SESSION['user_id'])) ? true : false;
	}
	
	//checks if user exists
	function user_exists($username){
		//removes unnecessary keys, prevents sql injection
		$username = sanitize($username);
		//checks if user is in database From table
		$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'");
		return(mysql_result($query, 0) == 1) ? true : false;
	}
	
	//checks if user email exists
	function email_exists($email){
		//removes unnecessary keys, prevents sql injection
		$email = sanitize($email);
		//checks if user is in database From table
		return(mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'"), 0) == 1) ? true : false;
	}
	
	function user_active($username){
		//removes unnecessary keys, prevents sql injection
		$username = sanitize($username);
		//checks if user is in database
		return(mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `active` = 1"), 0) == 1) ? true : false;
	}
	
	function user_id_from_username($username){
		$username = sanitize($username);
		return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'"), 0, 'user_id');
	}
	
	function user_id_from_email($email){
		$email = sanitize($email);
		return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `email` = '$email'"), 0, 'user_id');
	}
	
	function login($username, $password){
		$user_id = user_id_from_username($username);
		
		//secure the password and username
		$username = sanitize($username);
		//convert password
		$password = md5($password);
		
		return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'"), 0) == 1) ? $user_id : false;
	}
?>
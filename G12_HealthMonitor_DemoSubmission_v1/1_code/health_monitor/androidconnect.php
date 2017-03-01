<?php
	include 'core/init.php';
	//redirects if user is already logged in

	$response = array();
	//check if input boxes are empty
	if(empty($_POST) === false && $_POST['key'] === '13group12'){
		//define variables from user inputs
		$username = $_POST['username'];
if(user_exists($username) === true){
			$user_id = user_id_from_username($username);
			
			//access user data to output to profile
			$profile_data = user_data($user_id, 'first_name', 'last_name', 'email', 'age', 'user_score');
			$response["email"] = $profile_data["email"];
           	 	$response["age"] = $profile_data["age"];
          	  	$response["user_score"] = $profile_data["user_score"];
            	echo $profile_data['email'] . ' ' . $profile_data['age'] . ' ' . $profile_data['user_score'] ;
		}else{
			echo 'Sorry, that user does not exist.';
		}
	}else{
		echo 'nothing happened';
	}
	?>
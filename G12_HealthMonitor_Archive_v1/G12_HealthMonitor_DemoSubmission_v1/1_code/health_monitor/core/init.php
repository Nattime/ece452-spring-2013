<?php
	/*
	NOTE: When adding new or additional data from user, must also make changes in register.php
	*/

	session_start();
	//remember to turn off the error reporting
	//error_reporting(0);
	
	//connects to the database and all needed php functions and files
	require 'database/connect.php';
	require 'functions/general.php';
	require 'functions/users.php';
	
	$current_file = explode('/', $_SERVER['SCRIPT_NAME']);
	$current_file = end($current_file);
	
	//check if user is logged in
	if(logged_in() === true){
		
		//save the user session
		$session_user_id = $_SESSION['user_id'];
		
		//retrieves user information
		//can be used throughout program
		$user_data = user_data($session_user_id, 'user_id','username', 'password','first_name', 'last_name', 'email', 'password_recover', 'type', 'profile', 'age', 'weight', 'cardio_points', 'gender');
				
		//for testing only
		//echo $user_data['username'];
		
		//check if user is active, if user is inactive, immediately log user out
		if(user_active($user_data['username']) === false){
			session_destroy();
			header('Location: index.php');
			exit();
		}
		if($current_file !== 'changepassword.php' && $user_data['password_recover'] == 1){
			header('Location: changepassword.php?force');
			exit();
		}
	}
	

	//store errors in an array
	$errors = array();
?>
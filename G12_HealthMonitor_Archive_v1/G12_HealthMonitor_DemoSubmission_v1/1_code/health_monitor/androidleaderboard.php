<?php
	include 'core/init.php';
	//redirects if user is already logged in
	$row = array();
	//check if input boxes are empty
	if($_POST['key'] === '13group12'){
		//define variables from user inputs
		$username = $_POST['username'];
		if(user_exists($username) === true){
			$user_id = user_id_from_username($username);
			$sql = "SELECT * FROM `users` ORDER BY `user_score` DESC";
               		$result = mysql_query($sql); 
			while ($row = mysql_fetch_array($result)) {
                        //printf("Name: %s Score: %s", $row["username"], $row["user_score"]);
                                
                                echo $i . ' ' . $row["username"] . ' ' . $row["age"] . ' ' . $row["user_score"];
                }
		}else{
			echo 'Sorry, that user does not exist.';
		}
	}else{
		echo 'nothing happened';
	}
?>
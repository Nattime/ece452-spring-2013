<?php
	//sends email of activation code
	function email($to, $subject, $body){
		mail($to, $subject, $body, 'From: no-reply@group12.rutgers.edu');
	}
	
	//prevent register page to appear when logged in
	function logged_in_redirect(){
		if(logged_in() === true){
			header('Location: home.php');
			exit();
		}
	}
	
	//redirect user if not logged in
	function protect_page(){
		if(logged_in() === false){
			header('Location: protected.php');
			exit();
		}
	}

	//keeps users away from page if not an admin
	//NOTE: if changing type, need to change 'is_admin()' in users.php
	function admin_protect(){
		global $user_data;
		if(has_access($user_data['user_id'], 3) === false){
			header('Location: index.php');
			exit();
		}
	}

	//loop through elements to prevent sql injections
	//NOTE: must have & sign before $item
	//strips tags off first, then turns into html code
	function array_sanitize(&$item){
		$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
	}

	//removes escape characters to prevent sql injections
	function sanitize($data){
		return htmlentities(strip_tags(mysql_real_escape_string($data)));
	}
	
	//report error from array in a list
	function output_errors($errors){
		return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
	}
?>
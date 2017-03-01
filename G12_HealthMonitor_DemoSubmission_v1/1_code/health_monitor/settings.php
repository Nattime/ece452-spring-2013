<?php
	/*
	NOTE: to add/remove more user info, make sure to change "update user detail" and then add/remove input forms
	*/
	//must always include
	include 'core/init.php';
	//check if logged in
	protect_page();
	include 'includes/overall/header.php';
	
	//checks if the slots are filled in
	if(empty($_POST) === false){
		$required_fields = array('first_name', 'email');
		
		//require user to fill in necessary spots
		foreach($_POST as $key=>$value){
			if(empty($value) && in_array($key, $required_fields) === true){
				$errors[] = 'Fill in the blank spots.';
				break 1;
			}
		}
		
		//output error
		if(empty($errors) === true){
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
				$error[] = 'A valid email is required';
			}else if(email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']){
				$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use';
			}
		}
	}
?>

<h1>Settings</h1>

<?php
if(isset($_GET['success']) === true && empty($errors) === true){
	echo 'Your details have been updated!';
}else{
	if(empty($_POST) === false && empty($errors) === true){
		
		//update user details
		$update_data = array(
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'email' => $_POST['email']
		);
		
		//for testing only
		//print_r($update_data);
		
		accountSettings($session_user_id, $update_data);
		header('Location: settings.php?success');
		exit();
		
	}else if(empty($errors) === false){
		echo output_errors($errors);
	}
?>

<form action="" method="post">
	<ul>
    	<li>
        	First name:
            <br />
        	<input type="text" name="first_name" placeholder="<?php echo $user_data['first_name']; ?>" />
        </li>
        <li>
        	Last name:
            <br />
        	<input type="text" name="last_name" placeholder="<?php echo $user_data['last_name']; ?>" />
        </li>
        <li>
        	Email:
            <br />
        	<input type="text" name="email" placeholder="<?php echo $user_data['email']; ?>" />
        </li>
        <li>
        	<input type="submit" value="Update" />
        </li>
    </ul>
</form>
<?php
}//end of user update
	include 'includes/overall/footer.php';
?>
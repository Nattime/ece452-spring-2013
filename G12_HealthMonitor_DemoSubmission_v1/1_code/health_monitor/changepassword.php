<?php
	//must always include
	include 'core/init.php';
	//check if logged in
	protect_page();
	
	if(empty($_POST) === false){
		$required_fields = array('current_password', 'password', 'password2');
		
		//require user to fill in necessary spots
		foreach($_POST as $key=>$value){
			if(empty($value) && in_array($key, $required_fields) === true){
				$errors[] = 'Fill in the blank spots.';
				break 1;
			}
		}
		
		//change password to md5 and compare with previous password
		if(md5($_POST['current_password']) === $user_data[
		'password']){
			
			//check if new passwords are matching
			if(trim($_POST['password']) === trim($_POST['password2'])){
				$error[] = 'New passwords do not match';
			}else if(strlen($_POST['password']) < 6){
				$error[] = 'Password needs at least 6 characters';
			}
			
		}else{
			$errors[] = 'Your current password is incorrect!';
		}
		
		//for testing only
		//print_r($errors);
	}
	
	include 'includes/overall/header.php';
?>
    <h1>Change password</h1>
    
<?php
	if(isset($_GET['success']) === true && empty($_GET['success']) === true){
		echo 'Your password has been changed.';
	}else{
		
		//if user has recovered password, force user to change temp password to new password
		if(isset($_GET['force']) === true && empty($_GET['force']) === true){
		?>
        	<p>You must change your password.</p>
        <?php
		}
		
		//check and output errors
		if(empty($_POST) === false && empty($errors) === true){
			
			//post the form and no errors
			change_password($session_user_id, $_POST['password']);
			
			//redirect user to success page
			header('Location: changepassword.php?success');
			
		}else if(empty($errors) === false){
			
			//output errors
			echo output_errors($errors);
		}
	?>
		<form action="changepassword.php" method="post">
			<ul>
				<li>
					<input type="password" name="current_password" placeholder="Current Password" />
				</li>
				<li>
					<input type="password" name="password" placeholder="New password" />
				</li>
				<li>
					<input type="password" name="password2" placeholder="Retype new password" />
				</li>
				<li>
					<input type="submit" value="Change password" />
				</li>
			</ul>
		</form>

<?php 
	}//
	include 'includes/overall/footer.php';
?>
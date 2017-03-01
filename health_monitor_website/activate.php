<?php
	//must always include
	include 'core/init.php';
	//user protection
	logged_in_redirect();
	include 'includes/overall/header.php';
	
	if(isset($_GET['success']) === true && empty($_GET['success']) === true){
		?>
        
		<h2>Your account has been activated</h2>
        <p>You're free to log in.</p>
        
        <?php
	}else if(isset($_GET['email'], $_GET['email_code']) === true){
		$email = trim($_GET['email']);
		$email_code = trim($_GET['email_code']);
		
		//error outputs
		if(email_exists($email) === false){
			$errors[] = 'Oops, something went wrong, and we could not find that email address!';
		}else if(activate($email, $email_code) === false){
			$errors[] = 'We had a problem activating your account';
		}
		
		if(empty($errors) === false){
		?>
        
        	<h2>Oops...</h2>
		
		<?php
			echo output_errors($errors);
		}else{
			header('Location: activate.php?success');
			exit();
		}
	}else{
		//redirect user
		header('Location: index.php');
		exit();
	}
	
	include 'includes/overall/footer.php';
?>
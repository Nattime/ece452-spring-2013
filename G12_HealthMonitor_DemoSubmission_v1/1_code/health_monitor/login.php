<?php
	include 'core/init.php';
	//redirects if user is already logged in
	logged_in_redirect();
	
	//check if input boxes are empty
	if(empty($_POST) === false){
		//define variables from user inputs
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		//for testing only
		//echo $username, ' ', $password;
		
		//checks if variables are empty
		//checks if users exist and have their account activated
		if(empty($username) === true || empty($password) === true){
			//store and report errors
			$errors[] = 'You need to enter a username and password.';
		}elseif(user_exists($username) === false){
			$errors[] = 'Invalid Username.';
		}elseif(user_active($username) === false){
			$errors[] = 'Account is not activated.';
		}else{
			//checks the string length is legal length
			if(strlen($password) > 32){
				$errors[] = 'Password too long';
			}
			
			$login = login($username,$password);
			if($login === false){
				$errors[] = 'Username/password combination is incorrect';
			}else{
				//for testing only
				//echo 'ok';
				
				//set the user session
				$_SESSION['user_id'] = $login;
				//redirect user to home
				header('Location: home.php');
				exit();
			}
		}
	}else{
	}
	
	include 'includes/overall/header.php';
?>
	<h2>LOGIN</h2>
	<form action="login.php" method="post">
    	<input type="text" name="username" placeholder="Username" />
        <br />
        <input type="password" name="password" placeholder="Password" />
        <br />
        <input type="submit" name="Login" />
    </form>
<?php
	//print out errors
	if(empty($errors) === false){
		echo output_errors($errors);
	}
	
	include 'includes/overall/footer.php';
?>
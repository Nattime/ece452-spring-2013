<?php
	/*
	NOTE: need to change init.php when adding or new data to users
	*/

	//must always include
	include 'core/init.php';
	//if user is already logged in, redirect
	logged_in_redirect();
	include 'includes/overall/header.php';
	
	//check if input fields are empty
	if(empty($_POST) === false){
		$required_fields = array('username', 'password', 'password2', 'first_name', 'email');

		//require user to fill in necessary spots
		foreach($_POST as $key=>$value){
			if(empty($value) && in_array($key, $required_fields) === true){
				$errors[] = 'Fill in the blank spots.';
				break 1;
			}
		}
		
		//if there are errors, send out a message of error
		if(empty($errors) === true){
			//checks if username is taken
			if(user_exists($_POST['username']) === true){
				$errors[] = 'Username ' . $_POST['username'] . ' is already taken.';
			}
			
			//checks if username has any spaces
			if(preg_match("/\\s/", $_POST['username']) == true){
				$errors[] = 'Username cannot have spaces.';
			}
			
			//checks if password and verify password matches
			if($_POST['password'] !== $_POST['password2']){
				$errors[] = 'Passwords do not match.';
			}
			
			//checks if email is in use
			if(email_exists($_POST['email']) === true){
				$errors[] = 'Email already in use.';
			}
		}
	}
?>

	<h1>Register</h1>
  
<?php
	if(isset($_GET['success']) && empty($_GET['success'])){
	  echo 'Registered successfully, you may now login.';
	}else{
		
		//output errors
		if(empty($_POST) === false && empty($errors) === true){
			
			//register user if no errors
			$register_data = array(
				'username' => $_POST['username'],
				'password' => $_POST['password'],
				'first_name' => $_POST['first_name'],
				'last_name' => $_POST['last_name'],
				'email' => $_POST['email'],
				'age' => $_POST['age'],
				'weight' => $_POST['weight'],
				'gender' => $_POST['gender']
				
				//sends email code to verify account
				//will not be using for program
				//'email_code' => md5($_POST['username'] + microtime())
			);
			
			registerUser($register_data);
			//redirect
			header('Location: register.php?success');
			
			//exit/ kill script
			exit();
		}elseif(empty($errors) === false){
			
			//output errors
			echo output_errors($errors);
		}
?>
  
<form action="register.php" method="post" id="register">
  	<ul>
    	<li>
        	<input type="text" name="username" placeholder="Username" />
        </li>
        <li>
    		<input type="password" name="password" placeholder="Password" />
		</li>
        <li>
		    <input type="password" name="password2" placeholder="Retype Password" />
		</li>
        <li>
    		<input type="text" name="first_name" placeholder="First Name" />
		</li>
        <li>
    		<input type="text" name="last_name" placeholder="Last Name" />
		</li>
        <li>
    		<input type="text" name="email" placeholder="Email" />
		</li>
        <li>
    		<input type="text" name="age" placeholder="Age" />
		</li>
		<li>
    		<input type="text" name="weight" placeholder="Weight (lbs.)" />
		</li>
       	<li>
        	Gender:
            <br />
    		<input type="radio" name="gender" value="male" />Male
    		<input type="radio" name="gender" value="female" />Female
		</li>
        <li>
		    <input type="submit" value="Register" />
        </li>
    </ul>
</form>

<?php }//end of register successfully
	include 'includes/overall/footer.php';
?>
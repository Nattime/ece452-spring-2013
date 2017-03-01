<?php
	//must always include
	include 'core/init.php';
	logged_in_redirect();
	include 'includes/overall/header.php';
?>
	  <h1>Recovery</h1>
<?php
	if(isset($_GET['success']) === true && empty($_GET['success']) === true){
?>
	<p>Check your email.</p>
<?php
	}else{
		//allow only user to recover username and/or password
		$mode_allowed = array('username', 'password');
		if(isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true){
			
			//checks if the email exists in data and form
			if(isset($_POST['email']) === true && empty($_POST['email']) === false){
				if(email_exists($_POST['email']) === true){
					recover($_GET['mode'], $_POST['email']);
					header('Location: recover.php?success');
					exit();
				}else{
					echo '<p>We could not find that email address</p>';
				}
			}
			
			//recover username or password
	?>
	
			<form action="" method="post">
				<ul>
					<li>
						Please enter your email address:
						<br />
						<input type="text" name="email" />
					</li>
					<li>
						<input type="submit" value"Recover" />
					</li>
				</ul>
			</form>
	<?php
		}else{
			header('Location: index.php');
			exit();
		}
	}
?>

<?php include 'includes/overall/footer.php'; ?>
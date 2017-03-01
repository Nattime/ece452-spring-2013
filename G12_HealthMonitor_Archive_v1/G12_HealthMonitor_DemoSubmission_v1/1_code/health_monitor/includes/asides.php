<aside>
	<?php
		if($current_file == 'register.php'){
			include 'includes/widgets/login.php';
		}else if($current_file == 'login.php'){
		}else if($current_file == 'protected.php'){
			include 'includes/widgets/login.php';
		}
		else{
			if(logged_in() === true){
				include 'includes/widgets/loggedin.php';
			}
		}
	?>
</aside>
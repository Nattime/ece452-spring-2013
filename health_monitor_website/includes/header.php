<header>
    <a href="<?php
		if($current_file == 'index.php'){
			echo 'index.php';
		}else if($current_file == 'protected.php'){
			echo 'index.php';
		}else{
			echo 'home.php';
		}
    ?>" class="logo"><img src="images/g12_logo.gif" alt="logo" /></a>
    <div class="clear"></div>
    <?php
		if($current_file == 'index.php'){
		}else if($current_file == 'register.php'){
			include 'includes/asides.php';
		}else{
			include 'includes/asides.php';
		}
	?>
    
    <div class="clear"></div>
</header>
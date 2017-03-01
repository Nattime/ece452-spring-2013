<div class="logged_in">        
    <h2 id="user_header">Welcome, 
	<?php
		echo $user_data['first_name'];
	?>!
	</h2><div class="clear"></div>
    	<div id="login_nav">
            	<a href="home.php">Home</a> | <a href="profile.php?username=<?php echo $user_data['username']; ?>">Profile</a> | <a href="changepassword.php">Change Password</a> | <a href="settings.php">Settings</a> | <a href="logout.php">Logout</a>
		</div>
</div>
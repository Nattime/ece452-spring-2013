<?php
	/*
	NOTE: when adding more user information, must adjust "access user data to output to profile"
	*/
	//must always include
	include 'core/init.php';
	//do not allow users to see other people's files if not logged in
	if(logged_in() === false){
		header('Location: protected.php');
		exit();
	}
	include 'includes/overall/header.php';
	?>
    <form id="search" action="profile.php" method="get">
    	<input type="search" name="username" placeholder="Type username" />
        <input type="submit" value="Search" />
    </form>
    <?php
	//check if username is posted in url
	if(isset($_GET['username']) === true && empty($_GET['username']) === false){
		$username = $_GET['username'];
		
		if(user_exists($username) === true){
			$user_id = user_id_from_username($username);
			
			//access user data to output to profile
			$profile_data = user_data($user_id, 'username', 'first_name', 'last_name', 'email', 'age', 'cardio_points');
			
	
        	if($user_id != $user_data['user_id']){
				?>
                <table id="compare_data">
                	<tr>
                    	<th></th>
                    	<th colspan="2"><?php echo $profile_data['first_name']; ?>'s Profile</th>
                        <th colspan="2"><?php echo $user_data['first_name']; ?>'s Profile</th>
                    </tr>
                    
                    <tr>
                    	<td>Email</td>
                        <td></td>
                        <td><?php echo $profile_data['email']; ?></td>
                        <td></td>
                        <td><?php echo $user_data['email']; ?></td>
                    </tr>
                    
                    <tr>
                    	<td>Age</td>
                    	<td></td>
                        <td><?php echo $profile_data['age']; ?></td>
                        <td></td>
                        <td><?php echo $user_data['age']; ?></td>
                    </tr>
                    
                    <tr>
                    	<td>Cardio Points</td>
                    	<td><?php
							$a = $profile_data['cardio_points'];
							$b = $user_data['cardio_points'];
							if(($a > $b) === true){
								echo '<img src="images/up.png" alt="up" />';
							}
							if(($a < $b) === true){
								echo '<img src="images/down.png" alt="down" />';
							}
							if($a == $b){
								echo '<img src="images/equal.png" alt="equal" />';
							}
							?></td>
                        <td><?php echo $profile_data['cardio_points']; ?></td>
                        <td><?php
							$a = $profile_data['cardio_points'];
							$b = $user_data['cardio_points'];
							if(($a < $b) === true){
								echo '<img src="images/up.png" alt="up" />';
							}
							if(($a > $b) === true){
								echo '<img src="images/down.png" alt="down" />';
							}
							if($a == $b){
								echo '<img src="images/equal.png" alt="equal" />';
							}
							?></td>
                        <td><?php echo $user_data['cardio_points']; ?></td>
                    </tr>
            	</table>
        <?php
			}else{
		?>            
            <h1><?php echo $user_data['first_name']; ?>'s Profile</h1>
            <p>Email: <?php echo $user_data['email']; ?></p>
            <p>Age: <?php echo $user_data['age']; ?></p>
            <p>Cardio Points: <?php echo $user_data['cardio_points']; ?></p>

        <?php
			}
		}else{
			echo 'Sorry, that user does not exist.';
		}
	}else{
		header('Location: home.php');
		exit();
	}
?>

<?php include 'includes/overall/footer.php'; ?>
<?php
	//must always include
	include 'core/init.php';
	protect_page();
	include 'includes/overall/header.php';
?>
    
    <h1>home</h1>
    
    <a href="upload.php">Upload .csv file or manual inputs</a>
    
    <form id="search" action="profile.php" method="get">
    	<input type="search" name="username" placeholder="Enter username" />
        <input type="submit" value="Search" />
    </form>
    <?php
		echo "<div class='advice'><h2>Daily Tips</h2>\"" . daily_tips(1) . "\"</div>";
		leader_list($user_data['user_id']);
	?>
    
    <p id="graph">Monthly Graph</p>
    <?php
		if(file_exists('user_data/files/' . $user_data['username'] . '.csv') === true){
	    	echo '<img src="graph.php" alt="graph" class="graph" />';
		}else{
			echo '<p style="text-align: center;">You have not uploaded any data yet.</p>';
		}
    ?>
<?php include 'includes/overall/footer.php'; ?>
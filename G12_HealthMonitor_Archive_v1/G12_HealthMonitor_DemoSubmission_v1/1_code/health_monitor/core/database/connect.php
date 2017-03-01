<?php
	//server database, username, password
	mysql_connect('localhost','root','') or die('Cannot connect to server.');
	//database name
	mysql_select_db('members') or die('Cannot connect to database.');
?>
<?php
	$db_host = "localhost";
	$db_username = "root";
	$db_pass = "test123";
	$db_name = "achdb";
	
	$connection = mysql_connect ("$db_host", "$db_username", "$db_pass") 
					or die ("couldn't connect to MySQL");
	mysql_select_db($db_name);				
?>

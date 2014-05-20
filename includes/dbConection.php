<?php
	define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_DATABASE', 'Verona');

	//Connect to mysql server
	mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Database Connection failed: " . mysql_error());
	//Select database
	mysql_select_db(DB_DATABASE) or die("Database Connection failed: " . mysql_error());
?>
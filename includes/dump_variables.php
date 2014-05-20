<?php
	echo "\n<!-- BEGIN VARIABLE DUMP -->\n\n";
	echo "<!-- BEGIN GET VARS -->\n";
	echo "<!-- ".dump_array($_GET)." -->\n";
	
	echo "<!-- BEGIN POST VARS -->\n";
	echo "<!-- ".dump_array($_POST)." -->\n";
	
	echo "<!-- BEGIN SESSION VARS -->\n";
	echo "<!-- ".dump_array($_SESSION)." -->\n";
	
	echo "<!-- BEGIN COOKIE VARS -->\n";
	echo "<!-- ".dump_array($_COOKIE)." -->\n";
	
	echo "\n<!-- END VARIABLE DUMP -->\n";
?>
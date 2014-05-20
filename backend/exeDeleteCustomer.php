<?php
	//Start session
	session_start();
	require('../includes/dbConection.php');
	
	$idtodelete = $_GET['id'];
	
	$qry ="DELETE FROM customer WHERE CustomerID=".$idtodelete;
	//echo $qry;

	$result = @mysql_query($qry);

	if($result) {
		header("location: customers.php");
	}else {
		die("Query failed". mysql_error());
	}
		
	mysql_close();
?>
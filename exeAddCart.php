<?php
	//Start session
	session_start();
	//Include database connection details
	include('includes/dbConection.php');
	include('includes/functions.php');
	
	$pid = $_GET['id'];
	$qty = $_POST['quantity'];
	
	if($qty <1 )	$qty=1;
	
	addtocart($pid,$qty);
	session_write_close();
	header("location:shoppingCart.php");
	exit();
?>
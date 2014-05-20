<?php
	//Start session
	session_start();
	require('../includes/dbConection.php');
	
	//get prod_id of item you want to update
	$idtoupdate = $_GET['id'];
	$name=trim($_POST["prodName"]);
	$type=trim($_POST["prodType"]);
	$price=trim($_POST["price"]);
	//$imageURL=$_POST["Name"];
	$description=trim($_POST["description"]);
	
	//Create INSERT query
	$qry ="UPDATE product SET Name='$name', Type='$type', Price='$price', Description='$description' WHERE ProductID=".$idtoupdate;
	//echo $qry;
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		header("location: products.php");
		exit();
	}else {
		die("Query failed". mysql_error());
	}

	//Close	
	mysql_close();
?>
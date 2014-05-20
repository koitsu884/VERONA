<?php
	//Start session
	session_start();
	require('../includes/dbConection.php');
	$idtodelete = $_GET['id'];
	$imageURL = $_GET['imageURL'];
	
	$qry ="DELETE FROM product WHERE ProductID=".$idtodelete;
	//echo $qry;

	$result = @mysql_query($qry);

	if($result) {
		header("location: products.php");
		
		if(!unlink("../images/products/".$imageURL))
			echo "Error";
		if(!unlink("../images/products/thumb_".$imageURL))
			echo "Error";
	}else {
		die("Query failed". mysql_error());
	}
		
	mysql_close();
	

	//header("location: products.php");
?>
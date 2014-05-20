<?php
	//Start session
	session_start();
	require('../includes/dbConection.php');
	
	$errflag = false;
	
	$custID = $_GET["id"];
	$title=trim($_POST['title']);
	$fname=trim($_POST['fname']);
	$lname=trim($_POST['lname']);
	$gender=trim($_POST['gender']);
	$dob=trim($_POST['dob']);
	$suburb=trim($_POST['suburb']);
	$city=trim($_POST['city']);
	$zip=trim($_POST['zip']);
	$phone=trim($_POST['phone']);
	$email=trim($_POST['email']);
	$ifReceiveMail=trim($_POST['ifReceiveMail']);
	$flagMail = false;
	if($ifReceiveMail == "Yes")
		$flagMail = true;
	
	//Create INSERT query
	$qry ="UPDATE customer SET Title='$title', FirstName='$fname', LastName='$lname', Gender='$gender', DOB='$dob', Suburb='$suburb', 
			City='$city', Zip='$zip', Phone='$phone', Email='$email', ReceiveMail='$flagMail' WHERE CustomerID=".$custID;
	//echo $qry;
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		header("location: customers.php");
		exit();
	}else {
		die("Query failed". mysql_error());
	}

	//Close	
	mysql_close();
?>
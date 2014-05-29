<?php
	session_start();
	include('includes/dbConection.php');

	//Query
	$query = "";
	$errmsg_arr = array();
	$errflag = false;
	
	if( !isset($_SESSION['SESS_MEMBER_ID']))
	{
		$errflag = true;
		$errmsg_arr[] = "Your session had been finished. Please login again.";
	}
	
	if($errflag)
	{
		mysql_close();
		$_SESSION['LOGIN_ERROR'] = $errmsg_arr;
		header("location: myPage.php");
		exit();
	}
	
	
	$custID = $_SESSION['SESS_MEMBER_ID'];
	$loginName=trim($_POST['loginName']);
	$password=trim($_POST['password']);
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
			City='$city', Zip='$zip', Phone='$phone', Email='$email', ReceiveMail='$flagMail', LoginID='$loginName', Password='$password' WHERE CustomerID=".$custID;
	//echo $qry;
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if(!$result) 
	{
		$errflag = true;
		$errmsg_arr[] = "Query failed". mysql_error();
	}
	mysql_close();
	
	if($errflag)
	{
		$_SESSION['LOGIN_ERROR'] = $errmsg_arr;
	}
	header("location: myPage.php");
	exit();
?>
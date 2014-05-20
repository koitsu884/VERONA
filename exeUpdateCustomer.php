<?php
	session_start();
	include('includes/dbConection.php');

	//Query
	$query = "";
	$errmsg_arr = array();
	$errflag = false;
	
	try
	{
		if( !isset($_SESSION['SESS_MEMBER_ID']))
			throw new Exception("Your session had been finished. Please login again.");
			
		$custID = $_SESSION['SESS_MEMBER_ID'];
	
		extract($_POST);
		
		/*$loginName=trim($_POST['loginName']);
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
		$ifReceiveMail=trim($_POST['ifReceiveMail']);*/
		$flagMail = false;
		if($ifReceiveMail == "Yes")
			$flagMail = true;
		
		//Create INSERT query
		$qry ="UPDATE customer SET Title='$title', FirstName='$fname', LastName='$lname', Gender='$gender', DOB='$dob', Suburb='$suburb', 
				City='$city', Zip='$zip', Phone='$phone', Email='$email', ReceiveMail='$flagMail', LoginID='$loginName', Password='$password' WHERE CustomerID=".$custID;
		//echo $qry;
		$result = @mysql_query($qry);
		
		if(!$result)
			throw new Exception("Query failed". mysql_error());
	}
	catch(Exception $e)
	{
		mysql_close();
		$_SESSION['ERRMSG'] = $e->getMessage();
	}
	header("location: myPage.php");
?>
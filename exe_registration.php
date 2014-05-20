<?php
	//Start session
	session_start();
	//Include database connection details
	include('includes/dbConection.php');
	
	function filled_out($form_vars)
	{
		foreach ($form_vars as $key => $value)
		{
			if(!isset($key))
			{
				return false;
			}
			if($value == '')
			{
				if($key != 'info' && $key != 'ifReceiveMail' && $key != 'title' && $key != 'gender')
				{
					return false;
				}
			}
		}
		return true;
	}
	
	/*
	$loginName=trim($_POST['loginName']);
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
	$password=trim($_POST['password']);
	$confirmpassword=trim($_POST['confirm_pwd']);
	$info= trim($_POST['info']);
	$ifReceiveMail=trim($_POST['ifReceiveMail']);
	$flagMail = false;
	if($ifReceiveMail == "Yes")
		$flagMail = true;*/
	$flagMail = false;
	
	try
	{
		if(!filled_out($_POST))
		{
			throw new Exception('Some form values are missing.'); 
		}
		extract($_POST);
	
		if($ifReceiveMail == "Yes")
			$flagMail = true;
		//Duplication check

		$qry = "SELECT * FROM customer WHERE loginID='$loginName'";
		$result = mysql_query($qry);
		if($result) 
		{
			if(mysql_num_rows($result) > 0) 
			{
				@mysql_free_result($result);
				throw new Exception('This login name is already in use'); 
			}
		}
		else 
		{
			throw new Exception('Query failed'. mysql_error()); 
		}

		

		$qry = "SELECT * FROM customer WHERE Email='$email'";
		$result = mysql_query($qry);
		if($result) 
		{
			if(mysql_num_rows($result) > 0) 
			{
				@mysql_free_result($result);
				throw new Exception('This email address is already in use'); 
			}
		}
		else 
		{
			throw new Exception('Query failed'. mysql_error()); 
		}
		
			//Create INSERT query
		$qry = "INSERT INTO customer
			(Title, FirstName, LastName, Gender, DOB, Suburb, City, Zip, Phone, Email, Info, ReceiveMail,loginID, password) VALUES
			('$title', '$fname', '$lname','$gender','$dob','$suburb','$city','$zip','$phone','$email','$info','$flagMail','$loginName','$password')";
			
		
		//$qry = "INSERT INTO customer(fname, lname, gender, b_day, b_month, b_year, street, city, state, country, postal, email, password, membership_date) VALUES ('$fname', '$lname', '$gender', '$day', '$month', '$year', '$street', '$city', '$state', '$country', '$postal', '$email', '$password' ,'$membership')";
		
		$result = @mysql_query($qry);
	
		//Check whether the query was successful or not
		if($result) {//registration success
			unset($_SESSION['SESS_MEMBER_ID']);
			unset($_SESSION['SESS_FNAME']);
			unset($_SESSION['SESS_LNAME']);
			unset($_SESSION['cart']);
		
			$qry="SELECT * FROM customer WHERE loginID='$loginName' AND password='$password'";
			$result=mysql_query($qry);
		
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['CustomerID'];
			$_SESSION['SESS_FNAME'] = $member['FirstName'];
			$_SESSION['SESS_LNAME'] = $member['LastName'];
			session_write_close();

			header("location: registered.php");
			
			exit();
		}
		else {
			throw new Exception('Query failed'. mysql_error()); 
		}
	}
	catch(Exception $e)
	{
		$_SESSION['ERRMSG_ARR'] = $e->getMessage();
		session_write_close();
		header("location: registration.php");
		exit();
	}
	//Close	
	mysql_close();
?>
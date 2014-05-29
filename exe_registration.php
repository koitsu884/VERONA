<?php
	//Start session
	session_start();
	//Include database connection details
	include('includes/dbConection.php');
	
	$errflag = false;
	
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
		$flagMail = true;
	

	//echo $title, $loginName, $fname, $lname, $gender, $dob, $suburb, $city,$zip,$phone,$email,$password,$confirmpassword;
	
	//Duplication check
	if($loginName != '') 
	{
		$qry = "SELECT * FROM customer WHERE loginID='$loginName'";
		$result = mysql_query($qry);
		if($result) 
		{
			if(mysql_num_rows($result) > 0) 
			{
				$errmsg_arr[] = 'This login name is already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else 
		{
			die("Query failed");
		}
	}
	
	if($email != '') 
	{
		$qry = "SELECT * FROM customer WHERE Email='$email'";
		$result = mysql_query($qry);
		if($result) 
		{
			if(mysql_num_rows($result) > 0) 
			{
				$errmsg_arr[] = 'This email address is already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else 
		{
			die("Query failed");
		}
	}
	
	
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: registration.php");
		exit();
	}
	
	//Create INSERT query
	$qry = "INSERT INTO customer
		(Title, FirstName, LastName, Gender, DOB, Suburb, City, Zip, Phone, Email, Info, ReceiveMail,loginID, password) VALUES
		('$title', '$fname', '$lname','$gender','$dob','$suburb','$city','$zip','$phone','$email','$info','$flagMail','$loginName','$password')";
		
	
	//$qry = "INSERT INTO customer(fname, lname, gender, b_day, b_month, b_year, street, city, state, country, postal, email, password, membership_date) VALUES ('$fname', '$lname', '$gender', '$day', '$month', '$year', '$street', '$city', '$state', '$country', '$postal', '$email', '$password' ,'$membership')";
	
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		session_regenerate_id();
		$_SESSION['SESS_MEMBER_ID'] = mysql_insert_id();
		$_SESSION['SESS_FNAME'] = $fname;
		$_SESSION['SESS_LNAME'] = $lname;
		session_write_close();
		
		header("location: registered.php");
		
		exit();
	}
	else {
		die("Query failed");
	}

	//Close	
	mysql_close();
?>
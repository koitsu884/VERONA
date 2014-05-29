<?php
	//Start session
	session_start();
	//Include database connection details
	include('includes/dbConection.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	
	
	$login = $_POST['loginUserName'];
	$password = $_POST['loginPwd'];
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['LOGIN_ERROR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM customer WHERE loginID='$login' AND password='$password'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['CustomerID'];
			$_SESSION['SESS_FNAME'] = $member['FirstName'];
			$_SESSION['SESS_LNAME'] = $member['LastName'];
			session_write_close();

			header("location: index.php");
			exit();
		}else {
			//Login failed
			$errmsg_arr[] = 'Please check your username and password.';
			$_SESSION['LOGIN_ERROR'] = $errmsg_arr;
			session_write_close();
			header("location: index.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>
<?php
	//Start session
	session_start();
	//Include database connection details
	include('includes/dbConection.php');
	
	$login = $_POST['loginUserName'];
	$password = $_POST['loginPwd'];
	
	try
	{
		//Input Validations
		if($login == '')
			throw new Exception('Login failed:Login ID missing');
		if($password == '')
			throw new Exception('Login failed:Password missing'); 
			
		//Create query
		$qry="SELECT * FROM customer WHERE loginID='$login' AND password='$password'";
		$result=mysql_query($qry);
		
		//Check whether the query was successful or not
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['CustomerID'];
			$_SESSION['SESS_FNAME'] = $member['FirstName'];
			$_SESSION['SESS_LNAME'] = $member['LastName'];
			session_write_close();
			mysql_close();
			//header("location: index.php");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}else {
			throw new Exception('Login failed:Please check your username and password.'); 
		}
	}
	catch(Exception $e)
	{
		//Login failed
		$_SESSION['LOGIN_ERROR'] = $e->getMessage();
		session_write_close();
		mysql_close();
		//header("location: index.php");
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
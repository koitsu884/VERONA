<?php
	//Start session
	session_start();
	//Include database connection details
	include('../includes/dbConection.php');
	
	$login = $_POST['loginUserName'];
	$password = $_POST['loginPwd'];

	try
	{
		//Input Validations
		if($login == '')
			throw new Exception('Login ID missing');
		if($password == '') 
			throw new Exception('Password missing');
		
		//Create query
		$qry="SELECT * FROM admin WHERE loginID='$login' AND password='$password'";
		$result=mysql_query($qry);
		
		//Check whether the query was successful or not
		if(!$result)
			throw new Exception("Query failed".mysql_error());

		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_ADMIN_ID'] = $member['AdminID'];
			$_SESSION['SESS_ADMIN_FNAME'] = $member['FirstName'];
			$_SESSION['SESS_ADMIN_LNAME'] = $member['LastName'];
		}else {
			//Login failed
			throw new Exception('Login failed:Please check your username and password.');
		}
	}
	catch(Exception $e)
	{
		$_SESSION['LOGIN_ERROR'] = $e->getMessage();
	}
	session_write_close();
	mysql_close();
	header("location: index.php");
?>
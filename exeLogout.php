<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FNAME']);
	unset($_SESSION['SESS_LNAME']);
	unset($_SESSION['cart']);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Management</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
	<div id="header">
	<h1>Management page</h1>
	</div>
	<?php include "menu.php"?>
	<div id="contents">
	<?php
	if(isset($_SESSION['SESS_ADMIN_ID']))
	{
		echo "<P>Welcome,".$_SESSION['SESS_ADMIN_FNAME']." ".$_SESSION['SESS_ADMIN_LNAME']."!</p>";
		echo"</div>";
		exit();
	}
	?>
	<form method="post" action="exeAdminLogin.php">
	<p>UserName:<input type="text" name="loginUserName"></p>
	<p>Password:<input type="password" name="loginPwd"></p>
	<input type="submit" value="Login">
	<?php
	if( isset($_SESSION['LOGIN_ERROR'])) 
	{
		echo '<div class="err">'.$_SESSION['LOGIN_ERROR'].'</div>'; 
		unset($_SESSION['LOGIN_ERROR']);
	}
	?>
	</form>
</div>

</body>
</html>
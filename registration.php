<?php
	session_start();
	require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Registration</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>	
<script type="text/javascript" src="js/jquery.dropdownPlain.js"></script>
<script type="text/javascript" src="js/validation.js"></script>	
</head>
<body>
<div id="container">
	<div id="header">
	<?php include 'header.php'; ?>

	</div><!--  end header -->
	<div id="main_contents">
		<h2>Registration</h2>

		<?php
		/*if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0 ) 
		{
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) 
			{
				echo '<li>',$msg,'</li>'; 
			}
				echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
		}*/
		if( isset($_SESSION['ERRMSG_ARR'])) 
		{
			displayError($_SESSION['ERRMSG_ARR']);
			//echo '<div class="err">'.$_SESSION['ERRMSG_ARR']."</div>";
			unset($_SESSION['ERRMSG_ARR']);
		}
		?>

		<p>Please fill in all information on the table bellow</p>
		<form method = 'post' action = 'exe_registration.php' onsubmit="return formValidator()">
		<table id="regiTable" class="table1 center">
		<tr><th colspan = 2>Login Information</th></tr>
		<tr><td>Login name<span class="red">*</span></td><td><input type='text' name="loginName" /></td></tr>
		<tr><td>Password<span class="red">*</span></td><td><input type='password' name="password" /></td></tr>
		<tr><td>Re-type password<span class="red">*</span></td><td><input type='password' name="confirm_pwd" /></td></tr>
		<tr><th colspan = 2>Personal Information</th></tr>
		<tr><td class="left">Title:</td><td class="right">
		<select name = "title">
		<option></option>
		<option>Mr</option>
		<option>Mrs</option>
		<option>Miss</option>
		</select>
		</td></tr>
		<tr><td>First Name<span class="red">*</span></td><td><input type='text' name="fname" /></td></tr>
		<tr><td>Last Name<span class="red">*</span></td><td><input type='text' name="lname" /></td></tr>
		<tr><td>Gender:</td><td>
		<select name = "gender" name = "gender">
		<option></option>
		<option>Male</option>
		<option>Female</option>
		</select>
		</td></tr>
		<tr><td>DOB(dd/mm/yyyy)<span class="red">*</span></td><td><input type='text' name='dob' /></td></tr>
		<tr><th colspan = 2>Contact details</th></tr>
		<tr><td>Suburb<span class="red">*</span></td><td><input type='text' name='suburb' /></td></tr>
		<tr><td>City<span class="red">*</span></td><td>
		<select  name = "city">
		<option></option>
		<option>Auckland</option>
		<option>Wellington</option>
		<option>ChristChurch</option>
		</select>
		</td></tr>
		<tr><td>Zip Code<span class="red">*</span></td><td><input type='text' name='zip' /></td></tr>
		<tr><td>Phone<span class="red">*</span></td><td><input type='text' name='phone' /></td></tr>
		<tr><td>Email<span class="red">*</span></td><td><input type='text' name='email' /></td></tr>
		<tr><th colspan = 2>Question</th></tr>
		<tr>
		<td>How did you hear about us?</td>
		<td>
		<select name = "info">
		<option></option>
		<option>Advertisement</option>
		<option>Internet</option>
		<option>Friends</option>
		</select>
		</td></tr>
		<tr><td>Are you interested in receiving specials from us in future?</td>
		<td>
		<input type="radio" name="ifReceiveMail" value="Yes">Yes
		<input type="radio" name="ifReceiveMail" value="No">No
		</td>
		</tr>
		</table>
		<center><input type="submit" value="OK"></center>
		</form>
	</div>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>

</body>
</html>
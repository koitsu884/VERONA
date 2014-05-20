<?php session_start();
	include('includes/dbConection.php');
	include('includes/functions.php');
	include('includes/funcCustomer.php');
	//Query
	$query = "";
	$errMsg = "";
	
	
	
	if( isset($_SESSION['SESS_MEMBER_ID'])){
		$result=get_customer_data($_SESSION['SESS_MEMBER_ID']);
		
		if($result)
		{
			$member = mysql_fetch_assoc($result);
		}
		else
			$errMsg="Can not find your data.";
	}
	else
	{
		$errMsg="Your session had been finished. Please login again.";
	}
	
	//Close	
	mysql_close();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>User Information</title>
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
	<div id="main_contents" class="clearfix">
		<h2>My page</h2>
		<div class="err">
		<?php
		if( isset($_SESSION['ERRMSG']))
		{
			$errMsg=  $_SESSION['ERRMSG'];
			unset($_SESSION['ERRMSG']);
		}
		if($errMsg != "")
		{
		
			displayErrorAndExit($errMsg);
			
		}
		?>
		</div>
		<div class="myPageLeft">
		<ul class="simpleList">
		<li><a href="myPage.php">User information</a></li>
		<li><a href="orderHistory.php">Order history</a></li>
		</ul>
		</div>
		<div class="myPageRight">
		<form method = 'post' action = 'exeUpdateCustomer.php' onsubmit="return formValidator()">
		<table id="regiTable" class="table1 center">
		<tr><th colspan = 2>Login Information</th></tr>
		<tr><td>Login name<span class="red">*</span></td><td><input type='text' name="loginName" value="<?php echo $member['loginID']?>"/></td></tr>
		<tr><td>Password<span class="red">*</span></td><td><input type='password' name="password" value="<?php echo $member['password']?>"/></td></tr>
		<tr><td>Re-type password<span class="red">*</span></td><td><input type='password' name="confirm_pwd" value="<?php echo $member['password']?>"/></td></tr>
		<tr><th colspan = 2>Personal Information</th></tr>
		<tr><td class="left">Title:</td><td class="right">
		<select name = "title">
		<option></option>
		<option <?php if ($member['Title'] == 'Mr') echo 'selected=selected';?>>Mr</option>
		<option <?php if ($member['Title'] == 'Mrs') echo 'selected=selected';?>>Mrs</option>
		<option <?php if ($member['Title'] == 'Miss') echo 'selected=selected';?>>Miss</option>
		</select>
		</td></tr>
		<tr><td>First Name<span class="red">*</span></td><td><input type='text' name="fname" value="<?php echo $member['FirstName']?>"/></td></tr>
		<tr><td>Last Name<span class="red">*</span></td><td><input type='text' name="lname" value="<?php echo $member['LastName']?>"/></td></tr>
		<tr><td>Gender:</td><td>
		<select name = "gender" name = "gender">
		<option></option>
		<option <?php if ($member['Gender'] == 'Male') echo 'selected=selected';?>>Male</option>
		<option <?php if ($member['Gender'] == 'Female') echo 'selected=selected';?>>Female</option>
		</select>
		</td></tr>
		<tr><td>DOB(dd/mm/yyyy)<span class="red">*</span></td><td><input type='text' name='dob' value="<?php echo $member['DOB']?>"/></td></tr>
		<tr><th colspan = 2>Contact details</th></tr>
		<tr><td>Suburb<span class="red">*</span></td><td><input type='text' name='suburb' value="<?php echo $member['Suburb']?>"/></td></tr>
		<tr><td>City<span class="red">*</span></td><td>
		<select  name = "city">
		<option></option>
		<option <?php if ($member['City'] == 'Auckland') echo 'selected=selected';?>>Auckland</option>
		<option <?php if ($member['City'] == 'Wellington') echo 'selected=selected';?>>Wellington</option>
		<option <?php if ($member['City'] == 'ChristChurch') echo 'selected=selected';?>>ChristChurch</option>
		</select>
		</td></tr>
		<tr><td>Zip Code<span class="red">*</span></td><td><input type='text' name='zip' value="<?php echo $member['Zip']?>" /></td></tr>
		<tr><td>Phone<span class="red">*</span></td><td><input type='text' name='phone' value="<?php echo $member['Phone']?>"/></td></tr>
		<tr><td>Email<span class="red">*</span></td><td><input type='text' name='email' value="<?php echo $member['Email']?>"/></td></tr>
		<tr><th colspan = 2>Question</th></tr>
		<tr><td>Are you interested in receiving specials from us in future?</td>
		<td>
		<input type="radio" name="ifReceiveMail" value="Yes" <?php if ($member['ReceiveMail'] == 1) echo 'checked=true';?>>Yes
		<input type="radio" name="ifReceiveMail" value="No" <?php if ($member['ReceiveMail'] == 0) echo 'checked=true';?>>No
		</td>
		</tr>
		</table>
		<center><input type="submit" value="OK"></center>
		</form>
		</div>
	</div>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>

</body>
</html>
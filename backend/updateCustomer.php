<?php
	//Start session
	session_start();
	if(!isset($_SESSION['SESS_ADMIN_ID']))
	{
		header("location: index.php");
		exit();
	}
?>
<!DOCTYPE html>
<?php
	require('../includes/dbConection.php');
	
	$custID = $_GET["id"];

	//Query
	$query="SELECT * FROM customer WHERE CustomerID = ".$custID;
	$result=mysql_query($query);

	if(!$result)	
		die("Error: ". mysql_error());
	
	$errflag = false;
	
	$title=mysql_result($result,0,"Title");
	$fname=mysql_result($result,0,"FirstName");
	$lname=mysql_result($result,0,"LastName");
	$gender=mysql_result($result,0,"Gender");
	$dob=mysql_result($result,0,"DOB");
	$suburb=mysql_result($result,0,"Suburb");
	$city=mysql_result($result,0,"City");
	$zip=mysql_result($result,0,"Zip");
	$phone=mysql_result($result,0,"Phone");
	$email=mysql_result($result,0,"Email");
	$ifReceiveMail=mysql_result($result,0,"ReceiveMail");
	$flagMail = false;
	if($ifReceiveMail == "Yes")
		$flagMail = true;
	
	//Close	
	mysql_close();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Product Update</title>
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
	<div class="err">
		<?php
		if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0 ) 
		{
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) 
			{
				echo '<li>',$msg,'</li>'; 
			}
				echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
		}
		?>
	</div>
	<h3>Update customer</h3>
	<form method = 'post' action = 'exeUpdateCustomer.php?id=<?php echo $custID ?>'>
	<table>
	<th colspan = 2>Personal Information</th>
	<tr><td>Title:</td><td>
	<select name = "title">
	<option></option>
	<option <?php if($title=="Mr") echo"selected='selected'"; ?>>Mr</option>
	<option <?php if($title=="Mrs") echo"selected='selected'"; ?>>Mrs</option>
	<option <?php if($title=="Miss") echo"selected='selected'"; ?>>Miss</option>
	</select>
	</td></tr>
	<tr><td>First Name<span class="red">*</span></td><td><input type='text' name="fname" value='<?php echo $fname; ?>'/></td></tr>
	<tr><td>Last Name<span class="red">*</span></td><td><input type='text' name="lname" value='<?php echo $lname; ?>' /></td></tr>
	<tr><td>Gender:</td><td>
	<select name = "gender">
	<option></option>
	<option <?php if($gender=="Male") echo"selected='selected'"; ?>>Male</option>
	<option <?php if($gender=="Female") echo"selected='selected'"; ?>>Female</option>
	</select>
	</td></tr>
	<tr><td>DOB(dd/mm/yyyy)<span class="red">*</span></td><td><input type='text' name='dob' value='<?php echo $dob; ?>'/></td></tr>
	<th colspan = 2>Contact details</th>
	<tr><td>Suburb<span class="red">*</span></td><td><input type='text' name='suburb' value='<?php echo $suburb; ?>'/></td></tr>
	<tr><td>City<span class="red">*</span></td><td>
	<select  name = "city">
	<option></option>
	<option <?php if($city=="Auckland") echo"selected='selected'"; ?>>Auckland</option>
	<option <?php if($city=="Wellington") echo"selected='selected'"; ?>>Wellington</option>
	<option <?php if($city=="ChristChurch") echo"selected='selected'"; ?>>ChristChurch</option>
	</select>
	</td></tr>
	<tr><td>Zip Code<span class="red">*</span></td><td><input type='text' name='zip' value='<?php echo $zip; ?>'/></td></tr>
	<tr><td>Phone<span class="red">*</span></td><td><input type='text' name='phone' value='<?php echo $phone; ?>'/></td></tr>
	<tr><td>Email<span class="red">*</span></td><td><input type='text' name='email' value='<?php echo $email; ?>'/></td></tr>
	<th colspan = 2>Question</th>
	<tr><td>Are you interested in receiving specials from us in future?</td>
	<td>
	<input type="radio" name="ifReceiveMail" value="Yes" <?php if($ifReceiveMail) echo"checked=true"; ?>>Yes
	<input type="radio" name="ifReceiveMail" value="No">No
	</td>
	</tr>
	</table>
	<center><input type="submit" value="OK"></center>
	</form>
</div>

</body>
</html>
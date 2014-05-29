<?php
	session_start();
	include('includes/dbConection.php');
	include('includes/funcCustomer.php');
	
	if( isset($_SESSION['SESS_MEMBER_ID'])){
		$result=get_customer_data($_SESSION['SESS_MEMBER_ID']);
		
		if($result)
		{
			$member = mysql_fetch_assoc($result);
		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Contact us</title>
<?php include 'common.html'; ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="js/googleMap.js"></script>


</head>
<body>
<div id="container">
	<div id="header">
	<?php include 'header.php'; ?>
	</div><!--  end header -->
	<div id="main_contents">
	<h2>Contact us</h2>
		<div id="companyInfo">
		<img id = "shopImage" src="/Verona/images/shopImage.jpg"/>		
		<table class="table1">
		<tr><td colspan="2"></td>
		<tr><th width="30%">Address</th><td> XXX Main St Palmerston North, 4410</td></tr>
		<tr><th>Phone</th><td>123-456-7890</td></tr>
		<tr><th>Opening hour</th><td>10:00am ~ 4:00pm</td></tr>
		<tr><th>Close</th><td>Sunday, public holidays</td></tr>
		</table>
		</div>
		<div id="map">
		</div>
		<div id="bottom">
		<h3>Feed back form</h3>
		<p>To send us an enquiry please fill in the following form, and we will endeavour to reply within 24 hours</p>
		<br/>
		<form method="post" action="feedback.php">
		<table>
		<tr><th>Your Email<span class="red">*</span></th><td><input type="text" name = "email" <?php if(isset($member)) echo "value='".$member['Email']."'"?>></td></tr>
		<tr><th>Last name<span class="red">*</span></th><td><input type="text" name = "lname" <?php if(isset($member)) echo "value='".$member['LastName']."'"?>></td></tr>
		<tr><th>First name<span class="red">*</span></th><td><input type="text" name = "fname" <?php if(isset($member)) echo "value='".$member['FirstName']."'"?>></td></tr>
		<tr><th>Subject<span class="red">*</span></th><td><input type="text" name = "subject" size="50"></td></tr>
		<tr><th>Your query<span class="red">*</span></th><td><textarea name = "query" rows="10" cols="50"></textarea></td></tr>
		<tr><td colspan="2" style="text-align:center;padding:10px 0 5px 0;"><input type="submit" value="Send"></td></tr>
		</table>
		</form>
		</div>
	</div>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>

</body>
</html>
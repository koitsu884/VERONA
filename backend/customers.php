<?php
	//Start session
	session_start();
	if(!isset($_SESSION['SESS_ADMIN_ID']))
	{
		header("location: index.php");
		exit();
	}
	require_once('../includes/dbConection.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Management</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<script type="text/javascript">
function confirmDelete()
{
	if(!confirm("Are you sure to delete the data?"))
	{
		alert("Canceled!!");
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<body>
<div id="container">
	<div id="header">
	<h1>Management page</h1>
	</div>
	<?php include "menu.php"?>
	<div id="contents">
	<table>
		<tr> 
			<th colspan="14">Customers</th>
		</tr>
		<tr>
			<th></th>
			<th>CustomerID</th>
			<th>Title</th>
			<th>FirstName</th>
			<th>LastName</th>
			<th>Gender</th>
			<th>DOB</th>
			<th>Suburb</th>
			<th>City</th>
			<th>Zip</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Info</th>
			<th>ReceiveEmail</th>
		</tr>
		
		<?php
			//Query
			$query="SELECT * FROM customer ORDER BY CustomerID ASC";
			$result=mysql_query($query);
			//Number of fields
			$num=mysql_numrows($result); 
			
			//Close	
			mysql_close();
			$i=0;
			while ($i < $num)
			{
				$cust_id=mysql_result($result,$i,"CustomerID");
				$title=mysql_result($result,$i,"Title");
				$fname=mysql_result($result,$i,"FirstName");
				$lname=mysql_result($result,$i,"LastName");
				$gender=mysql_result($result,$i,"Gender");
				$dob=mysql_result($result,$i,"DOB");
				$suburb=mysql_result($result,$i,"Suburb");
				$city=mysql_result($result,$i,"City");
				$zip=mysql_result($result,$i,"Zip");
				$phone=mysql_result($result,$i,"Phone");
				$email=mysql_result($result,$i,"Email");
				$info=mysql_result($result,$i,"Info");
				$receiveMail=mysql_result($result,$i,"ReceiveMail");
				
		?>
	
			<tr>
				<td>
					<a href='updateCustomer.php?id=<?php echo"$cust_id";?>'><input type="button" value = "Edit"/></a>
					<br>
					<form method = 'post' action = 'exeDeleteCustomer.php?id=<?php echo"$cust_id";?>'
					onsubmit = "return confirmDelete()">
					<input type="submit" value="Delete">
					</form>
				</td>
				<td><?php echo "$cust_id"; ?></td>
				<td><?php echo "$title"; ?></td>
				<td><?php echo "$fname"; ?></td>
				<td><?php echo "$lname"; ?></td>
				<td><?php echo "$gender"; ?></td>
				<td><?php echo "$dob"; ?></td>
				<td><?php echo "$suburb"; ?></td>
				<td><?php echo "$city"; ?></td>	
				<td><?php echo "$zip"; ?></td>
				<td><?php echo "$phone"; ?></td>
				<td><?php echo "$email"; ?></td>
				<td><?php echo "$info"; ?></td>
				<td><?php echo "$receiveMail"; ?></td>	
			</tr>
		<?php
				++$i;
			} 
		?>
	</table>
	</div>
</div>

</body>
</html>
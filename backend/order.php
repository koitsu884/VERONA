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
	
	//Query
	$query="SELECT * FROM orderList ORDER BY orderDate ASC";
	$result=mysql_query($query);
	//Number of fields
	$num=mysql_numrows($result); 
	
	//Close	
	mysql_close();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Order management</title>
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
	<h1>Order management page</h1>
	</div>
	<?php include "menu.php"?>
	<div id="contents">
	<?php 
			if($num==0)
			{
				echo "<p style='color:red; font-weight:bold;'>No data is available.</p>";
			}
	?>
	<table>
		<tr> 
			<th colspan="10">Order list</th>
		</tr>
		<tr>
			<th></th>
			<th>Order ID</th>
			<th>Customer ID</th>
			<th>Order date</th>
			<th>Item count</th>
			<th>Total price</th>
			<th>Address</th>
			<th>Phone</th>
			<th>Last name</th>
			<th>First name</th>
		</tr>
		<?php
			$i=0;
			while ($i < $num)
			{
				$orderID=mysql_result($result,$i,"orderID");
				$custID=mysql_result($result,$i,"customerID");
				$orderDate=mysql_result($result,$i,"orderDate");
				$itemCnt=mysql_result($result,$i,"itemCount");
				$totalPrice=mysql_result($result,$i,"totalPrice");
				$address=mysql_result($result,$i,"address");
				$phone=mysql_result($result,$i,"phone");
				$lname=mysql_result($result,$i,"lastName");
				$fname=mysql_result($result,$i,"firstName");
				$phone=mysql_result($result,$i,"Phone");
				
		?>
	
			<tr>
				<td>
					<a href='updateOrder.php?id=<?php echo"$orderID";?>'><input type="button" value = "Edit"/></a>
					<br>
					<form method = 'post' action = 'exeDeleteOrder.php?id=<?php echo"$orderID";?>'
					onsubmit = "return confirmDelete()">
					<input type="submit" value="Delete">
					</form>
				</td>
				<td><?php echo "$orderID"; ?></td>
				<td><?php echo "$custID"; ?></td>
				<td><?php echo "$orderDate"; ?></td>
				<td><?php echo "$itemCnt"; ?></td>
				<td><?php echo "$totalPrice"; ?></td>
				<td><?php echo "$address"; ?></td>
				<td><?php echo "$phone"; ?></td>
				<td><?php echo "$lname"; ?></td>	
				<td><?php echo "$fname"; ?></td>
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
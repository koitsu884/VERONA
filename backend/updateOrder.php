<?php
	//Start session
	session_start();
	if(!isset($_SESSION['SESS_ADMIN_ID']))
	{
		header("location: index.php");
		exit();
	}
	require('../includes/dbConection.php');
	
	$orderID = $_GET["id"];
	$errMessage = array();
	
	//Update
	if(isset($_POST['command'] ))
	{
		try
		{
			if($_POST['command'] == 'orderUpdate'){
				$qry="UPDATE orderList SET address='".$_POST["address"]."',phone='".$_POST["phone"]."', firstName='".$_POST["fname"]."', lastName='".$_POST["lname"]."' WHERE orderID=".$orderID;
				$result=mysql_query($qry);
				if(!$result)
				{
					throw new Exception(mysql_error());
				}
			}
			else if($_POST['command'] == 'orderDelete')
			{
			
			}
			else if($_POST['command']=='update'){
				$rowNum = $_POST['rowNum'];
				$quantity = $_POST['qty'][$rowNum];
				$odid = $_POST['odid'][$rowNum];
				
				$qry="UPDATE orderDetails SET quantity='$quantity' WHERE orderDetailID=$odid";
				$result=mysql_query($qry);
				
				if(!$result)
				{
					throw new Exception(mysql_error());
				}
				
				$qry="SELECT quantity, Price FROM orderDetails INNER JOIN product on orderDetails.productID = product.productID
						WHERE orderID=".$orderID;
				$result=mysql_query($qry);
				if(!$result)
				{
					throw new Exception(mysql_error());
				}
				
				$num=mysql_numrows($result);
				$total = 0.0;
				for($i=0; $i<$num; $i++)
				{
					$total += mysql_result($result,$i,"Price") * mysql_result($result,$i,"quantity");
				}
				
				
				$qry="UPDATE orderList SET totalPrice='".$total."' WHERE orderID=".$orderID;
				$result=mysql_query($qry);
					
				if(!$result)
				{
					throw new Exception(mysql_error());
				}	
			}
			else if($_POST['command']=='delete')
			{
				$rowNum = $_POST['rowNum'];
				$odid = $_POST['odid'][$rowNum];
				$qry ="DELETE FROM orderDetails WHERE orderDetailID=$odid";
				$result=mysql_query($qry);
				if(!$result)
				{
					throw new Exception(mysql_error());
				}
					
				$qry="SELECT quantity, Price FROM orderDetails INNER JOIN product on orderDetails.productID = product.productID
							WHERE orderID=".$orderID;
				$result=mysql_query($qry);
				if(!$result)
				{
					throw new Exception(mysql_error());
				}
				$num=mysql_numrows($result);
				if($num != 0)
				{
					$total = 0.0;
					for($i=0; $i<$num; $i++)
					{
					$total += mysql_result($result,$i,"Price") * mysql_result($result,$i,"quantity");
						}
					$qry="UPDATE orderList SET itemCount='".$num."', totalPrice='".$total."' WHERE orderID=".$orderID;
					$result=mysql_query($qry);
					if(!$result)
					{
						throw new Exception(mysql_error());
					}
				}
				else
				{
					$qry ="DELETE FROM orderList WHERE orderID=".$orderID;
					$result=mysql_query($qry);
					if(!$result)
					{
					throw new Exception(mysql_error());
					}
				}
			}
			else
			{
				throw new Exception("nanimo seehenn de-");
			}
		}
		catch(Exception $e)
		{
			$errMessage[] = "Error:".$e;
		}
	}
	
	
	//Query
	$query="SELECT * FROM orderList WHERE orderID = ".$orderID;
	$result=mysql_query($query);
	
	if(!$result)
	{
		$errMessage[] = "Error: ". mysql_error();
	}
	else if ($num=mysql_numrows($result) == 0)
	{
		$errMessage[] = "No data";
	}
	else
		$member = mysql_fetch_assoc($result);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Order Update</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<script language="javascript">
	function updateOD(rowNum){
		document.orderDetailForm.rowNum.value=rowNum;
		document.orderDetailForm.command.value="update";
		document.orderDetailForm.submit();
	}

	function deleteOD(rowNum){
		document.orderDetailForm.rowNum.value=rowNum;
		document.orderDetailForm.command.value="delete";
		document.orderDetailForm.submit();
	}
</script>
<body>
<div id="container">
	<div id="header">
	<h1>Order update</h1>
	</div>
	<?php include "menu.php"?>
	<div id="contents">
		<div style="color:red; font-weight:bold;">
			<?php
			if(count($errMessage) > 0) 
			{
				echo '<ul class="err">';
				foreach($errMessage as $msg)
				{
					echo '<li>',$msg,'</li>';
				}
				echo '</ul>';
			}
			?>
		</div>
		<div style="float:left; width:300px;">
			<h2>Order info</h2>
			<form method="post">
			<input type="hidden" name="command" value="orderUpdate"/>
			<table style="width:100%;">
			<!--  <tr><th></th><td><input type='button' onclick='javascript:orderUpdate(<?php echo $orderID ?>)' value='update'></td></tr> -->
			<tr><th>Order ID</th><td><?php if(isset($member)) echo $member['orderID'] ?></td></tr>
			<tr><th>Customer ID</th><td><?php if(isset($member)) echo $member['customerID']?></td></tr>
			<tr><th>Order date</th><td><?php if(isset($member)) echo $member['orderDate']?></td></tr>
			<tr><th>Item count</th><td><input type="text" value="<?php if(isset($member)) echo $member['itemCount'] ?>" class="label" readonly></td></tr>
			<tr><th>Total price</th><td><input type="text" value="<?php if(isset($member)) echo $member['totalPrice'] ?>" class="label" readonly></td></tr>
			<tr><th>Address</th><td><input type="text" name="address" value="<?php if(isset($member)) echo $member['address'] ?>"></td></tr>
			<tr><th>Phone</th><td><input type="text" name="phone" value="<?php if(isset($member)) echo $member['phone'] ?>"></td></tr>
			<tr><th>Last name</th><td><input type="text" name="lname" value="<?php if(isset($member)) echo $member['lastName'] ?>"></td></tr>	
			<tr><th>First name</th><td><input type="text" name="fname" value="<?php if(isset($member)) echo $member['firstName'] ?>"></td></tr>
			<tr><td colspan="2"><input type='submit' action="updateOrder.php?id=<?php echo $orderID ?>" value='update'></td></tr>
			</table>
			</form>
		</div>
		<div style="float:left; width:600px;">
			<h2>Order Details</h2>
			<form name="orderDetailForm" method='post'>
			<input type='hidden' name='command'/>
			<input type='hidden' name='rowNum'/>
			<table style="width:100%;">
			<tr>
			<td></td><th> ID</th><th>ProductID</th><th>ProductName</th><th>Image</th><th>Price</th><th>Quantity</th>
			</tr>
			<?php 
			$query="SELECT orderDetailID, orderID, orderDetails.productID, Name, ImageURL, Price, quantity  
					FROM orderDetails INNER JOIN product ON orderDetails.productID = product.productID
					WHERE orderID = ".$orderID;
			$result=mysql_query($query);
			if(!$result)
			{
				echo "<tr><th>".mysql_error()."</th></tr>";
			}
			else
			{
				$num=mysql_numrows($result);
				
				for($i = 0; $i < $num; $i++)
				{	
					$odID = mysql_result($result,$i,"orderDetailID");
					$price = mysql_result($result,$i,"Price");
					echo "<tr>";
					//echo "<td><input type='submit' name='updateBtn' value='update'><br/>";
					echo "<td><input type='button' name='updateBtn' onclick = 'updateOD($i)'value='update'><br/>";
					//echo "<input type='submit' name='deleteBtn' value='delete'></td>";
					echo "<input type='button' name='deleteBtn' onclick = 'deleteOD($i)'value='delete'></td>";
					echo "<td><input type='text' name='odid[]' size='3' value='$odID' class='label' readonly></td>";
					echo "<td>".mysql_result($result,$i,"productID")."</td>";
					echo "<td>".mysql_result($result,$i,"Name")."</td>";
					echo "<td><img src='/Verona/images/products/thumb_".mysql_result($result,$i,"ImageURL")."'/></td>";
					echo "<td>$price</td>";
					echo "<td><input type='text' size='1' maxlength='2' name='qty[]' value='".mysql_result($result,$i,"quantity")."'></td>";
					echo "</tr>";
				}
			}
			?>
			</table>
			</form>
		</div>
	</div>
	<div style="clear:both">
	</div>
</div>

</body>
</html>
<?php mysql_close(); ?>
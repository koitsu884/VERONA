<?php
	//Start session
	session_start();
	//Include database connection details
	require_once('includes/dbConection.php');
	require_once('includes/funcShoppingCart.php');

	$query = "";
	$errMsg = "";
	
	if(!isset($_SESSION['cart'])){
		header("location: shoppingCart.php");
		exit();
	}
	
	if( isset($_SESSION['SESS_MEMBER_ID'])){
		$query="SELECT LastName, FirstName, Suburb, City, Zip, Phone FROM customer WHERE CustomerID = '".$_SESSION['SESS_MEMBER_ID']."'";
		$result=mysql_query($query);
		
		if($result)
		{
			$member = mysql_fetch_assoc($result);
		}
		else
			$errMsg="Can not find your data.";
	}
	else
	{
		$errMsg="Please login before confirm.";
	}
	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Confirm order</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>	
<script type="text/javascript" src="js/jquery.dropdownPlain.js"></script>
</head>
<body>
<div id="container">
	<div id="header">
	<?php include 'header.php'; ?>
	</div><!--  end header -->
	<div id="main_contents" class="clearfix">
	<h2>Confirm order</h2>
		<div id="cartInfo">
			<table class="table1">
				<?php
				echo '<tr><th>Name</th><th>Image</th><th>Price</th><th>Qty</th><th>Amount</th></tr>';
				$max=count($_SESSION['cart']);
				for($i=0; $i<$max; $i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname=$_SESSION['cart'][$i]['name'];
					if($q==0) continue;
				?>
				<tr>
				<td><b><?php echo $pname?></b></td>
				<td><img src="images/products/thumb_<?php echo $_SESSION['cart'][$i]['ImageURL']?>"/></td>
				<td>$<?php echo $_SESSION['cart'][$i]['price']?></td>
				<td><?php echo $q ?></td>
				<td>$<?php echo $_SESSION['cart'][$i]['amount']?></td>
				</tr>
				<?php
					}//end for
				?>
				<tr><td colspan="5"><font size="4"><b>Order Total:$<?php echo get_order_total()?></b></font></td></tr>
			</table>
		</div>
		<div id="billingInfo">
		<h3>Customer information</h3>
		<form id="confirm" action="exeOrder.php" method="post">
		<table>
		<tr><th>First name</th><td><input type="text" name="fname" size="40" value="<?php if(isset($member['FirstName'])) echo $member['FirstName']; ?>"></td></tr>
		<tr><th>Last name</th><td><input type="text" name="lname" size="40" value="<?php if(isset($member['LastName'])) echo $member['LastName'] ?>"></td></tr>
		<tr><th>Address</th><td><input type="text" name="address" size="40" value="<?php if(isset($member['City'])) echo $member['Suburb'].' '.$member['City'].' '.$member['Zip'] ?>"></td></tr>
		<tr><th>Phone</th><td><input type="text" name="phone" size="40" value="<?php if(isset($member['Phone'])) echo $member['Phone'] ?>"></td></tr>
		<tr><td colspan="2">
		<?php 
			if($errMsg=="")
			{
				echo '<a onclick="document.getElementById('."'confirm'".').submit()" class="myButton">Confirm</a>';
			}
			else
			{
				echo "<p class='red'>$errMsg</p>";
			}
		?>
		</td></tr>
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
<?php
 //Close	
	mysql_close();
?>
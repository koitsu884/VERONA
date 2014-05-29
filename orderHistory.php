<?php session_start();
	include('includes/dbConection.php');
	include('includes/functions.php');
	date_default_timezone_set('America/New_York');
	//Query
	$query = "";
	$errMsg = "";
	$num = 0;
	$today = gmdate('Y-m-d');
	
	if( !isset($_SESSION['SESS_MEMBER_ID']))
	{
		$errMsg="Your session had been finished. Please login again.";
	}
	else
	{
		try
		{
			$cusID = $_SESSION['SESS_MEMBER_ID'];
			$qry="SELECT od.orderID, orderDate, itemCount, totalPrice, quantity, Name,Price,ImageURL 
					FROM orderDetails od 
					INNER JOIN orderList ol on od.orderID = ol.orderID
					INNER JOIN product p on od.productID = p.productID
					";
			$where = "WHERE ol.customerID = $cusID";
			if(isset($_GET['search']))
			{
				$time = "2013-01-01";
				$timestr=gmdate('y-m-d',strtotime($time));
				$errMsg = $timestr;
				$where .= " AND orderDate > $timestr";
			}

			$qry = $qry.$where;
			
			$result=mysql_query($qry);
			if(!$result)
			{
				throw new Exception(mysql_error());
			}
			//Number of fields
			$num=mysql_numrows($result); 
		}
		catch(Exception $e)
		{
			$errMsg = $e;
		}
	}
	
	//Close	
	mysql_close();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>My page</title>
<?php include 'common.html'; ?>
<script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<div id="container">
	<div id="header">
	<?php include 'header.php'; ?>

	</div><!--  end header -->
	<div id="main_contents" class="clearfix">
		<h2>Order history</h2>
		<div class="err">
		<?php
		if($errMsg != "")
		{
			displayErrorAndExit($errMsg);
		}
		if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0 ) 
		{
			displayErrorArrayAndExit($_SESSION['ERRMSG_ARR']);
			unset($_SESSION['ERRMSG_ARR']);
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
		<!-- <p>Search:
		<select onChange="window.location='orderHistory.php?search='+this.value">
		<option>ALL</option>
		<option>Last 30 days</option>
		<option>2013</option>
		<option>2012</option>
		<option>2011</option>
		</select>
		</p>-->
		<table class="table1 orderHistory">
		<?php
			$prevOrderID = -1;
			for($i = 0; $i < $num; $i++)
			{
				$itemCnt = mysql_result($result,$i,"itemCount");
				$orderID = mysql_result($result,$i,"orderID");
				$orderDate = mysql_result($result,$i,"orderDate");
				$price = mysql_result($result,$i,"Price");
				$quantity = mysql_result($result,$i,"quantity");
				$productTotal = $price * $quantity;
				$total = mysql_result($result,$i,"totalPrice");
				$name = mysql_result($result,$i,"Name");
				$imageURL = mysql_result($result,$i,"ImageURL");
				
				if( $prevOrderID != $orderID)
				{
					
					echo"<tr><td rowspan = '$itemCnt'><p>OrderID:$orderID</p><p>OrderDate:$orderDate</p><p><b>Order Total:$$total</b></p></td>
						";
					$prevOrderID = $orderID;
				}
				else
				{
					echo "<tr>";
				}
				echo "<td><div class='orderDetailBox'><img src='images/products/thumb_$imageURL'/>";
				echo "<p><b>$name</b></p><p>Price:$$price&nbsp&nbsp&nbsp&nbspQuantity:$quantity&nbsp&nbsp&nbsp&nbspTotal:$$productTotal</p></div>";
				echo "</td></tr>";
			}
		?>
		</table>
		</div>
	</div>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>

</body>
</html>
<?php
	session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Confirm order</title>
<?php include 'common.html'; ?>
</head>
<body>
<div id="container">
	<div id="header">
	<?php include 'header.php'; ?>
	</div><!--  end header -->
	<div id="main_contents" class="clearfix">
	<h2>Invoice</h2>
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
		echo '</div>';
		echo '<div id="footer">';
		include 'footer.html';
		echo '</div></div></body></html>';
		exit;
	}
	
	if( !isset($_SESSION['invoice']) || !isset($_SESSION['cart']))
	{
		header("location: billing.php");
		exit;
	}
	
	?>

	<div id="invoice">
	<p><b>Order ID:<?php echo $_SESSION['invoice']['orderid'];?></b></p>
	<p><b>Order date:<?php echo $_SESSION['invoice']['date'];?></b></p>
	<table class="table1" width="100%">
		<?php
			echo '<tr><th>Name</th><th>Price</th><th>Qty</th><th>Total</th></tr>';
			$max=count($_SESSION['cart']);
			for($i=0; $i<$max; $i++){
				$pid=$_SESSION['cart'][$i]['productid'];
				$q=$_SESSION['cart'][$i]['qty'];
				$pname=$_SESSION['cart'][$i]['name'];
				if($q==0) continue;
		?>
		<tr>
		<td><b><?php echo $pname?></b></td>
		<td>$<?php echo $_SESSION['cart'][$i]['price']?></td>
		<td><?php echo $q ?></td>
		<td>$<?php echo $_SESSION['cart'][$i]['amount']?></td>
		</tr>
		<?php
			}//end for
		?>
		<tr><td colspan="5"><font size="4"><b>Order Total:$<?php echo $_SESSION['invoice']['total']?></b></font></td></tr>
	</table>
	<?php
		unset($_SESSION['cart']);
		unset($_SESSION['invoice']);
		echo "<p>Thank you!!!</p>";
	?>
	</div>
	</div>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>
</body>
</html>
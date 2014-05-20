<?php
	//Start session
	session_start();
	//Include database connection details
	require_once('includes/dbConection.php');
	require_once('includes/funcShoppingCart.php');
	require_once('includes/functions.php');
	//include('includes/dump_variables.php');

	$msg="";
	if(!empty($_REQUEST))
	{
		if($_REQUEST['command'] == 'delete' && $_REQUEST['pid']>0){
			remove_product($_REQUEST['pid']);
		}
		else if($_REQUEST['command']=='clear'){
			unset($_SESSION['cart']);
		}
		else if($_REQUEST['command']=='update'){
			$max=count($_SESSION['cart']);
			for($i=0;$i<$max;$i++){
				$pid=$_SESSION['cart'][$i]['productid'];
				$q=intval($_REQUEST['qty'.$pid]);
				if($q > 0 && $q <= 999){
					$_SESSION['cart'][$i]['qty']=$q;
					$_SESSION['cart'][$i]['amount']=$_SESSION['cart'][$i]['price'] * $q;
				}
				else
				{
					$msg='Some products not updated!, quantity must be a number between 1 and 999';
				}
			}
		}
	}
	
	do_html_header("Shopping Cart");
?>
</head>
<!--<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Shopping cart</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>	
<script type="text/javascript" src="js/jquery.dropdownPlain.js"></script>
</head>-->

<script language="javascript">
	function del(pid){
		if(confirm('Do you really mean to delete this item?')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
	}
</script>
<body>
<div id="container">
	<div id="header">
	<?php include 'header.php'; ?>
	</div><!--  end header -->
	<form name="form1" method="post">
	<div id="main_contents" class="clearfix">
	<h2>Shopping Cart</h2>
		
		<input type="hidden" name="pid" />
		<input type="hidden" name="command" />
		<div class="red"><?php echo $msg?></div>
		<table id="shoppingCart" class="table1">
			<?php
			if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
			echo '<tr><th>Name</th><th>Image</th><th>Price</th><th>Qty</th><th>Amount</th><th>Options</th></tr>';
			$max=count($_SESSION['cart']);
			for($i=0; $i<$max; $i++){
				$pid=$_SESSION['cart'][$i]['productid'];
				$q=$_SESSION['cart'][$i]['qty'];
				$pname=$_SESSION['cart'][$i]['name'];
				if($q==0) continue;
			?>
			<tr>
			<td><a href='productDetail.php?id=<?php echo $pid; ?>'><b><?php echo $pname?></b></a></td>
			<td><a href='productDetail.php?id=<?php echo $pid; ?>'><img src="images/products/thumb_<?php echo $_SESSION['cart'][$i]['ImageURL']?>"/></a></td>
			<td>$<?php echo $_SESSION['cart'][$i]['price']?></td>
			<td><input type="text" name="qty<?php echo $pid?>" value="<?php echo $q ?>" maxlength="1" size="1" /></td>
			<td>$<?php echo $_SESSION['cart'][$i]['amount']?></td>
			<td><a href="javascript:del(<?php echo $pid?>)" class="myButton">Remove</a></td>
			</tr>
			<?php
				}//end for
			}//end if
			else{
				echo "<tr><td>there are no items in your shopping cart!</td></tr>";
			}
			?>
		</table>
		<div id="control">
		<table>
		<tr><td colspan="3"><font size="6"><b>Order Total:$<?php echo get_order_total()?></b></font></td></tr>
		<tr>
		<td><a href="javascript:clear_cart()" class="myButton">Clear cart</a></td>
		<td><a href="javascript:update_cart()" class="myButton">Update cart</a></td>
		<td><a href="billing.php" class="myButton">Place Order</a></td>
		</tr>
		<tr>
		<td colspan = "3"><a href="products.php">Continue shopping</a></td>
		</tr>
		</table>
		</div>
	</div>
	</form>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>

</body>
</html>
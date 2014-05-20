<?php
	session_start();
	require_once('includes/functions.php');
	require_once('includes/funcShoppingCart.php');
	
	if( !isset($_SESSION['invoice']) || !isset($_SESSION['cart']))
	{
		header("location: billing.php");
		exit;
	}
	
	do_html_header("Confirm order");
?>
<!--<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Confirm order</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>	
<script type="text/javascript" src="js/jquery.dropdownPlain.js"></script>-->
</head>
<body>
<div id="container">
	<div id="header">
	<?php include 'header.php'; ?>
	</div><!--  end header -->
	<div id="main_contents" class="clearfix">
	<h2>Invoice</h2>
	<?php
	if( isset($_SESSION['ERRMSG']) )
	{
		displayErrorAndExit($_SESSION['ERRMSG']);
		unset($_SESSION['ERRMSG']);
		exit;
	}	
	?>

	<div id="invoice">
	<p><b>Order ID:<?php echo $_SESSION['invoice']['orderid'];?></b></p>
	<p><b>Order date:<?php echo $_SESSION['invoice']['date'];?></b></p>
	<?php
		createInvoiceTable();
		closeInvoiceSession();
	?>
	</div>
	</div>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>
</body>
</html>
<?php
	//Start session
	session_start();
	//Include database connection details
	include('includes/dbConection.php');
	include('includes/funcProducts.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Products</title>
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
	<h2>Products</h2>
	<!--<ul id="product_menu">
	<li><a href="/Verona/products.php">All</a></li>
	<li><a href="/Verona/products.php?type=Deco">Decoration</a></li>
	<li><a href="/Verona/products.php?type=Role">Roles</a></li>
	<li><a href="/Verona/products.php?type=Wed">Wedding</a></li>
	</ul>-->
	<form id="searchBox" method="get">
	<table id="chooseFilter" class="table1">
	<tr><th>Search by name</th></tr>
	<tr><td><input type="text" name="search">&nbsp;<a href="#" onclick='document.getElementById("searchBox").submit()' class="myButton">Search</a></td></tr>
	<tr><th>Search by Category</th></tr>
	<tr>
	<td>
	<ul class="simpleList">
	<li><a href="/Verona/products.php">All</a></li>
	<li><a href="/Verona/products.php?type=Deco">Decoration</a></li>
	<li><a href="/Verona/products.php?type=Role">Roles</a></li>
	<li><a href="/Verona/products.php?type=Wed">Wedding</a></li>
	</ul>
	</td>
	</tr>
	<tr><th>Search by Price</th></tr>
	<tr>
	<td>
	<ul class="simpleList">
	<li><a href="/Verona/products.php?price=less30">~$30</a></li>
	<li><a href="/Verona/products.php?price=f30t60">$30~$60</a></li>
	<li><a href="/Verona/products.php?price=f60t100">$60~$100</a></li>
	<li><a href="/Verona/products.php?price=more100">$100~</a></li>
	</ul>
	</td>
	</tr>
	</table>
	</form>
	<?php
		createProductTable(getProductsInfo()); 
	?>
	</div>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>

</body>
</html>
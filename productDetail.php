<?php
	//Start session
	session_start();
	//Include database connection details
	include('includes/dbConection.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php

	/*require('config.php');
	
	//Connect to mysql server
	mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Database Connection failed: " . mysql_error());
	//Select database
	mysql_select_db(DB_DATABASE) or die("Database Connection failed: " . mysql_error());*/
	//Query
	$prodID = $_GET["id"];
	$query="SELECT * FROM product WHERE ProductID=".$prodID;
	$result=mysql_query($query);
	//Number of fields
	$num=mysql_numrows($result); 
	
	//Close	
	mysql_close();
	
	$name=mysql_result($result,0,"Name");
	$price=mysql_result($result,0,"Price");
	$imageURL=mysql_result($result,0,"ImageURL");
	$description=mysql_result($result,0,"Description");
?>
<head>
<title>Products Detail</title>
<?php include 'common.html'; ?>
</head>
<body>
<div id="container">
	<div id="header">
	<?php include 'header.php'; ?>
	</div><!--  end header -->
	<div class="clearfix" id="main_contents">
	<h2>Product Detail</h2>
	<div id="productImage">
		<img src='/Verona/images/products/<?php echo $imageURL; ?>'/>
	</div>
	<div id="productInfo">
	<form method="post" action="exeAddCart.php?id=<?php echo $prodID;?>">
	<table>
	<tr><td><h3><?php echo $name; ?></h3></td></tr>
	<tr><td><strong>$<?php echo $price; ?></strong></td></tr>
	<tr><td><?php echo $description; ?></td></tr>
	<tr><td>Quantity:<input type="text" name="quantity" size="1" maxlength="1" value="1"></td></tr>
	<tr><td><input type="submit" value="Add shopping cart"></td></tr>
	</table>
	</form>
	<br/>
	<p><a href="products.php">Back to products page</a></p>
	</div>
	</div>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>

</body>
</html>
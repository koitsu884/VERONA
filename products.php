<?php
	//Start session
	session_start();
	//Include database connection details
	include('includes/dbConection.php');
	include('includes/functions.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	//Query
	$query = "";
	if(isset($_GET["type"])){
		$query="SELECT ProductID, Name, Price, ImageURL FROM product WHERE Type = '".$_GET["type"]."'";
	}
	else if(isset($_GET["search"])){
		$query="SELECT ProductID, Name, Price, ImageURL FROM product WHERE Name like '%".$_GET["search"]."%'";
	}
	else if(isset($_GET["price"])){
		if($_GET["price"] == 'less30')
		{
			$query="SELECT ProductID, Name, Price, ImageURL FROM product WHERE  Price < 30";
		}
		else if($_GET["price"] == 'f30t60')
		{
			$query="SELECT ProductID, Name, Price, ImageURL FROM product WHERE Price BETWEEN 30 AND 60";
		}
		else if($_GET["price"] == 'f60t100')
		{
			$query="SELECT ProductID, Name, Price, ImageURL FROM product WHERE Price BETWEEN 60 AND 100";
		}
		else
		{
			$query="SELECT ProductID, Name, Price, ImageURL FROM product WHERE  Price > 100";
		}
		
	}
	else
		$query="SELECT ProductID, Name, Price, ImageURL FROM product ORDER BY ProductID ASC";
	$result=mysql_query($query);
	//Number of fields
	$num=mysql_numrows($result); 
	
	//Close	
	mysql_close();
?>
<head>
<title>Products</title>
<?php include 'common.html'; ?>
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
	
	<table id="product_table">	
		<?php
			$i=0;
			$isClosed = false;
			if($num>0){
				while ($i < $num)
				{
					$prodID=mysql_result($result,$i,"ProductID");
					$name=mysql_result($result,$i,"Name");
					$price=mysql_result($result,$i,"Price");
					$imageURL=mysql_result($result,$i,"ImageURL");
					
					if($i % 4 == 0)
					{
						echo "<tr>";
						$isClosed = false;
					}
					
		?>
			<td>
			<a href='productDetail.php?id=<?php echo "$prodID"; ?>'>
			<img src='/Verona/images/products/thumb_<?php echo "$imageURL"; ?>'/>
			</a>
			
			<h4><a href='productDetail.php?id=<?php echo "$prodID"; ?>'><?php echo "$name"; ?></a></h4>
			<p><a href='productDetail.php?id=<?php echo "$prodID"; ?>'>$<?php echo "$price"; ?></a></p>
			</td>
		<?php
					++$i;
					if($i % 4 == 0)
					{
						echo"</tr>";
						$isClosed = true;
					}
				} 
				if(!$isClosed)
					echo"</tr>";
			}
			else	//$num = 0
			{
				echo"<tr><td><b>Sorry, we can not find any products that matches the search criteria.</b></td></tr>";
			}
		?>
	</table>	
	</div>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>

</body>
</html>
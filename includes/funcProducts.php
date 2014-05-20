<?php
	function getProductsInfo()
	{
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
		
		//Close	
		mysql_close();
		return $result;
	}
	
	function createProductTable($result)
	{
		$i=0;
		$isClosed = false;
		//Number of fields
		$num=mysql_numrows($result); 
		
		echo "<table id='product_table'>";	

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

				echo "<td>";
				echo "<a href='productDetail.php?id=$prodID'>";
				echo "<img src='/Verona/images/products/thumb_$imageURL'/></a>";
				echo "<h4><a href='productDetail.php?id=$prodID'>$name</a></h4>";
				echo "<p><a href='productDetail.php?id=$prodID'>$".$price."</a></p>";
				echo "</td>";

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
		echo "</table>";	
	}
?>
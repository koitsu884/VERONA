<?php
	//Start session
	session_start();
	if(!isset($_SESSION['SESS_ADMIN_ID']))
	{
		header("location: index.php");
		exit();
	}
	require('../includes/dbConection.php');
	//Query
	$query="SELECT * FROM product ORDER BY ProductID ASC";
	$result=mysql_query($query);
	//Number of fields
	$num=mysql_numrows($result); 
	
	//Close	
	mysql_close();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Product Management</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<script type="text/javascript">
function confirmRegistration()
{
	if(!confirm("Are you sure to delete the data?"))
	{
		alert("Canceled!!");
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<div id="container">
	<div id="header">
	<h1>Management page</h1>
	</div>
	<?php include "menu.php"?>
	<div id="contents">
		<div class="err">
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
			}
			?>
		</div>
		<div style="float:left; width:400px;">
		<h2>Add new product</h2>
		<form method = 'post' action = 'addProduct.php' enctype="multipart/form-data" >
		<table style="100%">
		<tr><th>Name</th><td><input type="text" name = "prodName" size="20"></td></tr>
		<tr>
			<th>Type</th>
			<td>
			<select name="prodType">
			<option>Deco</option>
			<option>Role</option>
			<option>Wed</option>
			</select>
			</td>
		</tr>
		<tr><th>Price</th><td><input type="text" name = "price" size="10"></td></tr>
		<tr><th>Image</th><td><input type="file" name = "image" size="30"></td></tr>
		<tr><th>Description</th><td><textarea name = "description" maxlength="200"></textarea></td></tr>
		</table>
		<input type = "submit">
		</form>
		</div>
		<div style="float:left; width:600px;">
		<h2>Product table data</h2>
		<table style="100%">
			<tr> 
				<th colspan="13">Products</th>
			</tr>
			<tr>
				<th></th>
				<th>ProductID</th>
				<th>Name</th>
				<th>Type</th>
				<th>Price</th>
				<th>ImageURL</th>
				<th width="100px">Description</th>
			</tr>
			
			<?php
				$i=0;
				while ($i < $num)
				{
					$prod_id=mysql_result($result,$i,"ProductID");
					$name=mysql_result($result,$i,"Name");
					$type=mysql_result($result,$i,"Type");
					$price=mysql_result($result,$i,"Price");
					$imageURL=mysql_result($result,$i,"ImageURL");
					$description=mysql_result($result,$i,"Description");
					
			?>
		
				<tr>
					<td><a href='updateProduct.php?id=<?php echo"$prod_id";?>'><input type="button" value = "Edit"/></a>
					<br>
					<form method = 'post' action = 'exeDeleteProduct.php?imageURL=<?php echo"$imageURL";?>&id=<?php echo"$prod_id";?>'
					onsubmit = "return confirmRegistration()">
					<input type="submit" value="Delete">
					</form>
					</td>
					<td><?php echo "$prod_id"; ?></td>
					<td><?php echo "$name"; ?></td>
					<td><?php echo "$type"; ?></td>
					<td><?php echo "$price"; ?></td>
					<td><a href = '/Verona/images/products/<?php echo "$imageURL"; ?>'>
						<img src = '/Verona/images/products/thumb_<?php echo "$imageURL"; ?>'/>
						</a>
					</td>
					<td><?php echo "$description"; ?></td>

				</tr>
			<?php
					++$i;
				} 
			?>
		</table>
		</div>
	</div>
</div>

</body>
</html>
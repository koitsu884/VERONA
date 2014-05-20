<?php
	//Start session
	session_start();
	if(!isset($_SESSION['SESS_ADMIN_ID']))
	{
		header("location: index.php");
		exit();
	}
?>
<!DOCTYPE html>
<?php
	require('../includes/dbConection.php');
	
	$prodID = $_GET["id"];
	
	//Query
	$query="SELECT * FROM product WHERE productID = ".$prodID;
	$result=mysql_query($query);

	if(!$result)	
		die("Error: ". mysql_error());
	
	$name=mysql_result($result,0,"Name");
	$type=mysql_result($result,0,"Type");
	$price=mysql_result($result,0,"Price");
	$imageURL=mysql_result($result,0,"ImageURL");
	$description=mysql_result($result,0,"Description");
	
	//Close	
	mysql_close();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Product Update</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
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
	<h3>Update product</h3>
	<form method = 'post' action = 'exeUpdateProduct.php?id=<?php echo"$prodID"; ?>'>
	<table>
	<tr> 
			<th>Name</th>
			<th>Type</th>
			<th>Price</th>
			<th>Description</th>
	</tr>
	<tr>
		<td><input type="text" name = "prodName" size="20" value='<?php echo"$name"; ?>'></td>
		<td>
		<select name="prodType">
		<option <?php if($type=="Deco") echo"selected='selected'"; ?>>Deco</option>
		<option <?php if($type=="Role") echo"selected='selected'"; ?>>Role</option>
		<option <?php if($type=="Wed") echo"selected='selected'"; ?>>Wed</option>
		</select>
		</td>
		<td><input type="text" name = "price" size="10" value='<?php echo"$price"; ?>'></td>
		<td><textarea name = "description" maxlength="200"><?php echo"$description"; ?></textarea></td>
	</tr>
	</table>
	<img src='/Verona/images/products/<?php echo"$imageURL"; ?>'/>
	<br/>
	<input type = "submit" value="Update">
	</form>
</div>

</body>
</html>
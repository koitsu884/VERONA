<div id = "menu">	
	<ul>
	<li><a href="customers.php">Customers</a></li>
	<li><a href="products.php">Products</a></li>
	<li><a href="order.php">Order</a></li>
	<li><a href="/Verona/index.php">Home page</a></li>
	</ul>
	<?php
		if(isset($_SESSION['SESS_ADMIN_ID']))
		{
			echo "<a href='exeAdminLogout.php'>Logout</a>";
		}
	?>
</div>
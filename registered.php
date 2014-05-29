<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Registration</title>
<?php include 'common.html'; ?>
</head>
<body>
<div id="container">
	<div id="header">
	<?php include 'header.php'; ?>

	</div><!--  end header -->
	<div id="main_contents">
		<h2>Registration</h2>	
		<p>Registration successful!!</p>
		<div id="register_info">
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
	</div>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>

</body>
</html>
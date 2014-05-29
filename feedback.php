<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Feedback</title>
<?php include 'common.html'; ?>
</head>
<body>
<div id="container">
	<div id="header">
	<?php include 'header.php'; ?>
	</div><!--  end header -->
	<div id="main_contents">
	<h2>Feedback</h2>
	<?php 
		if(empty($_POST))
		{
			echo "<p>No data was sended.</p>";
			echo "</div>";
			echo "<div id='footer'>";
			include 'footer.html';
			echo "</div>";
			echo "</div>";
			echo "</body>";
			echo "</html>";
			exit;
		}
	?>
	<p>You are sending the message below.</p>
	<form>
	<table>
	<tr><th>Your Email</th><td><?php echo $_POST['email']?></td></tr>
	<tr><th>Last name</th><td><?php echo $_POST['lname']?></td></tr>
	<tr><th>First name</th><td><?php echo $_POST['fname']?></td></tr>
	<tr><th>Subject</th><td><?php echo $_POST['subject']?></td></tr>
	<tr><th>Your query</th><td><?php echo $_POST['query']?></td></tr>
	<tr><td colspan="2" style="text-align:center;padding:10px 0 5px 0;"><input type="submit" value="Send"></td></tr>
	</table>
	</form>
	</div>
	<div id="footer">
	<?php include 'footer.html'; ?>
	</div>
</div>

</body>
</html>
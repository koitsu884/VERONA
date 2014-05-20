<div id="logo"><a href="/Verona/index.php"><img src="/Verona/images/logo.png"/></a></div>
<div id="login">
	<?php
		if( isset($_SESSION['SESS_MEMBER_ID']))
		{
			echo "<div id='userInfo'><p><b>Wellcome, ".$_SESSION['SESS_LNAME']."&nbsp;".$_SESSION['SESS_FNAME']."!!</b>
				&nbsp;&nbsp;&nbsp;&nbsp;<a href='myPage.php'>Go to my page</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='exeLogout.php'>logout</a></p></div>";
		}
		else
		{
			echo "<form id='loginForm' method='post' action='exeLogin.php'>
			<p>Login name:&nbsp;<input type='text' name='loginUserName' class='textbox' size=8>&nbsp;&nbsp;Password:&nbsp;<input type='password' class='textbox' name='loginPwd' size=8>
			<a href='#' onclick='".'document.getElementById("loginForm").submit()'."' class='myButton'>Login</a></p>
			</form><p><a href='/Verona/registration.php'>Make new account</a></p>";
		}
	?>

	<?php
	if( isset($_SESSION['LOGIN_ERROR'])) 
	{
		echo '<span class="red">'.$_SESSION['LOGIN_ERROR'].'</span>';
		unset($_SESSION['LOGIN_ERROR']);
	}
	?>

</div>
<div id="scart_link">
	<table>
	<tr><td>&nbsp;&nbsp;</td>
	<td><a href="/Verona/shoppingCart.php"><img src="/Verona/images/shopping_cart.png"></a></td>
	</tr>
	</table>
</div>
<ul class="dropdown">
<li><a href="/Verona/index.php">Home</a></li>
<li><a href="/Verona/aboutus.php">About Us</a></li>
<li><a href="/Verona/products.php">Products</a>
	<ul class="sub_menu">
	<li><a href="/Verona/products.php?type=Deco">Whole cakes</a></li>
	<li><a href="/Verona/products.php?type=Role">Role cakes</a></li>
	<li><a href="/Verona/products.php?type=Wed">Wedding cakes</a></li>
	</ul>
</li>
<li><a href="/Verona/contactus.php">Contact</a></li>
</ul>
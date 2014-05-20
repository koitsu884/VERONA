<?php 
	session_start();
	require_once('includes/functions.php');
	do_html_header("Home");
?>
<!--<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Home</title>
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.dropdownPlain.js"></script>-->

<script src="js/jquery.slides.min.js"></script>
<script>
//Initialize slidejs
$(function() {
  $('#topImage').slidesjs({
	effect: {
	  fade: {
		speed: 1000//fade speed
	  }
	},
	navigation: {
		active: false,
	},
	pagination: {
		active: false,
	},
	play: {
	  active: false,
	  auto: true,
	  interval: 4000,
	  swap: false,
	  effect: "fade"
	}
  });
});
</script>
</head>
<body>
<div id="container">
	<div id="header">
	<?php include 'header.php'; ?>
	</div><!--  end header -->
	<div id="main_contents" class="clearfix">
		<div id="main">
			<div id = "topImage">
			      <img src="images/top_image1.jpg" alt="cake1">
		  <img src="images/top_image2.jpg" alt="cake2">
		  <img src="images/top_image3.jpg" alt="cake3">
			</div>
			<div id = "topBanners">
			<ul>
			<li><a href="products.php?type=Deco"><img src="images/Banner1.jpg" /></a></li>
			<li><a href="products.php?type=Role"><img src="images/Banner2.jpg" /></a></li>
			<li><a href="products.php?type=Wed"><img src="images/Banner3.jpg" /></a></li>
			</ul>
			</div>
		</div>
		<div id="side">
		<ul id="news_list">
			<li>
			<div class="imageBox">
			<p class="topnewsMark"><img src="images/icon_topnews.png"/></p>
			<p class="topnewsPhoto"><img src="images/news1.png"/></p>
			<p> test test test test test test</p>
			</div>
			</li>
			<li>
			<div class="imageBox">
			<p class="topnewsMark"><img src="images/icon_topnews.png"/></p>
			<p class="topnewsPhoto"><img src="images/news2.png"/></p>
			<p>New product is comming...</p>
			</div>
			</li>
			<li>
			<div class="imageBox">
			<p class="topnewsMark"><img src="images/icon_topnews.png"/></p>
			<p class="topnewsPhoto"><img src="images/news3.png"/></p>
			<p>New product is comming...</p>
			</div>
			</li>
		</ul>
		</div>
	</div>
	<div id="footer">
	<?php include 'footer.html';?>
	</div>
</div>

</body>
</html>
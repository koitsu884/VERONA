<?php
	function dump_array($array){
		if(is_array($array)){
			$size = count($array);
			$string = "";
			if($size){
				$count = 0;
				$string .= "{";
				foreach($array as $var => $value){
					$string .= $var." = ".$value;
					if($count++ < ($size-1)){
						$string .= ", ";
					}
				}
				$string .= " }";
			}
			return $string;
		} else{
			return $array;
		}
	}

	function do_html_header($title){
	//print an HTML header
?>
	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title><?php echo $title;?></title>
	<link href="css/default.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/layout.css" rel="stylesheet" type="text/css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>	
	<script type="text/javascript" src="js/jquery.dropdownPlain.js"></script>
<?php
	}//----- end do_html_header -----

	//===========================================
	// Display error message
	//===========================================
	function displayErrorList($errAray) 
	{
		if(! is_array($errAray)) return false;
		echo '<ul class="red">';
		foreach($errAray as $msg) 
		{
			echo '<li>'.$msg.'</li>'; 
		}
		echo '</ul>';
		return true;
	}
	
	function displayErrorArrayAndExit($errAray) 
	{
		if(!displayErrorList($errAray)) return;
		//enc main contaits div
		echo '</div>';
		echo '<div id="footer">';
		include 'footer.html';
		echo '</div></div></body></html>';//end footer, container div, body, html
		exit;
	}
	
	function displayError($msg)
	{
		echo '<div class="red">'.$msg.'</div>';
	}
	
	function displayErrorAndExit($msg)
	{
		displayError($msg);
		echo '</div>';//close main containts div
		echo '<div id="footer">';
		include 'footer.html';
		echo '</div></div></body></html>';
		exit;
	}
?>
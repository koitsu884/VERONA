<?php
	function remove_product($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	function get_order_total(){
		if(!isset($_SESSION['cart'])) return 0;
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$sum+=$_SESSION['cart'][$i]['amount'];
		}
		return $sum;
	}
	
	function getAllProducts($pid)
	{
		$query="select * from product where ProductID=".$pid;
		$result=mysql_query($query) or die($query."<br/><br/>".mysql_error());
		$row=mysql_fetch_array($result);
		return $row;
	}
	
	
	function addtocart($pid,$q){
		if($pid<1 or $q<1) return;
		
		if(is_array($_SESSION['cart'])){
			if(product_exists($pid)) return;
			$result = getAllProducts($pid);
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['productid']=$pid;
			$_SESSION['cart'][$max]['qty']=$q;
			$_SESSION['cart'][$max]['name']=$result['Name'];
			$price = $result['Price'];
			$_SESSION['cart'][$max]['price']=$price;
			$_SESSION['cart'][$max]['amount']=$price * $q;
			$_SESSION['cart'][$max]['ImageURL']=$result['ImageURL'];
		}
		else{
			$result = getAllProducts($pid);
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['productid']=$pid;
			$_SESSION['cart'][0]['qty']=$q;
			$_SESSION['cart'][0]['name']=$result['Name'];
			$price = $result['Price'];
			$_SESSION['cart'][0]['price']=$price;
			$_SESSION['cart'][0]['amount']=$price * $q;
			$_SESSION['cart'][0]['ImageURL']=$result['ImageURL'];
		}
	}
	function product_exists($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				$flag=1;
				break;
			}
		}
		return $flag;
	}
	
	function createInvoiceTable()
	{
		echo '<table class="table1" width="100%">';
		echo '<tr><th>Name</th><th>Price</th><th>Qty</th><th>Total</th></tr>';
		
		$max=count($_SESSION['cart']);
			for($i=0; $i<$max; $i++){
				$pid=$_SESSION['cart'][$i]['productid'];
				$q=$_SESSION['cart'][$i]['qty'];
				$pname=$_SESSION['cart'][$i]['name'];
				if($q==0) continue;
				echo "<tr>";
				echo "<td><b>$pname</b></td>";
				echo "<td>$".$_SESSION['cart'][$i]['price']."</td>";
				echo "<td>$q</td>";
				echo "<td>$".$_SESSION['cart'][$i]['amount']."</td>";
				echo "</tr>";
			}
		echo" <tr><td colspan='5'><font size='4'><b>Order Total:$".$_SESSION['invoice']['total']."</b></font></td></tr>";
		echo" </table>";
	}
	
	function closeInvoiceSession()
	{
		unset($_SESSION['cart']);
		unset($_SESSION['invoice']);
		echo "<p>Thank you!!!</p>";
	}
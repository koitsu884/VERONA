<?php
	function get_customer_data($pid)
	{
		$query="SELECT * FROM customer WHERE CustomerID = ".$pid;
		$result=mysql_query($query);
		return $result;
	}
	function get_lname(){
		$query="select Name from product where ProductID=".$pid;
		$result=mysql_query($query) or die($query."<br/><br/>".mysql_error());
		$row=mysql_fetch_array($result);
		return $row['Name'];
	}

?>
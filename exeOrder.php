<?php
	//Start session
	session_start();
	date_default_timezone_set('America/New_York');
	//Include database connection details
	include('includes/dbConection.php');
	include('includes/functions.php');
	
	$errmsg_arr = array();
	$errflag = false;
	
	$lname=trim($_POST['lname']);
	$fname=trim($_POST['fname']);
	$address=trim($_POST['address']);
	$phone=trim($_POST['phone']);
	
	$cusID=$_SESSION['SESS_MEMBER_ID'];
	$date=date('Y-m-d');
	$itemCnt=trim(count($_SESSION['cart']));
	$total=trim(get_order_total());
	
	//echo "$cusID $date $itemCnt $total $address $phone $lname $fname";
	//Create INSERT query
	$qry = "INSERT INTO orderList
			(customerID, orderDate, itemCount, totalPrice, address, phone, lastName, firstName)
			VALUES ('$cusID','$date','$itemCnt','$total','$address','$phone','$lname','$fname')";
	
	/*$qry = "INSERT INTO test (customerID, lastName, firstName, orderDate, itemCount, totalPrice, address, phone)
			VALUES ('$cusID','$lname','$fname','$date','$itemCnt','$total','$address','$phone')";*/
		
	
	//$qry = "INSERT INTO customer(fname, lname, gender, b_day, b_month, b_year, street, city, state, country, postal, email, password, membership_date) VALUES ('$fname', '$lname', '$gender', '$day', '$month', '$year', '$street', '$city', '$state', '$country', '$postal', '$email', '$password' ,'$membership')";
	
	$result = @mysql_query($qry);
	if(!$result)
	{
		$errflag=true;
		$errmsg_arr[] = "Query failed". mysql_error();
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		mysql_close();
		header("location: invoice.php");
		exit;
	}

	//------------------------ order detail ----------------------------
	$oid = mysql_insert_id();
	for($i=0; $i<$itemCnt; $i++)
	{
		$pid=$_SESSION['cart'][$i]['productid'];
		$q=$_SESSION['cart'][$i]['qty'];
		$qry = "INSERT INTO orderDetails
		(orderID, productID, quantity) VALUES ('$oid','$pid','$q')";
		$result = @mysql_query($qry);
		if(!$result)
		{
			$errflag=true;
			$errmsg_arr[] = "Query failed". mysql_error();
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			session_write_close();
			mysql_close();
			header("location: invoice.php");
			exit;
		}
	}
	
	$_SESSION['invoice']['orderid'] = $oid;
	$_SESSION['invoice']['total'] = $total;
	$_SESSION['invoice']['date'] = $date;
	
	
	//Check whether the query was successful or not
	header("location: invoice.php");		
	//Close	
	mysql_close();
?>
<?php
	session_start();
	if(!isset($_SESSION['SESS_ADMIN_ID']))
	{
		header("location: index.php");
		exit();
	}
	require('../includes/dbConection.php');
	
	//Define thumbnail size
	define(THUMB_LENGTH,100);
	define(PATH,"../images/products/");
	
	$errflag = false;
	
	$prodName=trim($_POST['prodName']);
	$type=trim($_POST['prodType']);
	$tempImageURL = $_FILES["image"]["tmp_name"];
	$imageURL=$_FILES["image"]["name"] ; 
	$price=trim($_POST['price']);
	$description=trim($_POST['description']);
	
	if (is_uploaded_file($tempImageURL)) {
		
		
		
		//============ Create thumbnail and upload ===================
		$image = imagecreatefromjpeg( $tempImageURL );
		
		$width  = imagesx( $image );
		$height = imagesy( $image );
		//Make the image square (Cut off outside of the range)
		if ( $width >= $height ) {
			$length = $height;
			$x = floor( ( $width - $height ) / 2 );
			$y = 0;
			$width = $length;
		} else { //width < height
			$length = $width;
			$y = floor( ( $height - $width ) / 2 );
			$x = 0;
			$height = $length;
		}

		//Make thumbnail 
		$thumbnail = imagecreatetruecolor( THUMB_LENGTH, THUMB_LENGTH);
		//dst_image , src_image , dst_x , dst_y , src_x , src_y , dst_w , dst_h , src_w , src_h )
		imagecopyresized( $thumbnail, $image, 0, 0, $x, $y, THUMB_LENGTH, THUMB_LENGTH, $width, $height );
		imagejpeg( $thumbnail, PATH."thumb_".$imageURL );
		chmod(PATH."thumb_".$imageURL, 0644);
		
		ImageDestroy($image);
		ImageDestroy($thumbnail);
		
		//============ Upload original image ===================
		if (move_uploaded_file($tempImageURL, PATH.$imageURL))
		{
			//Set parmition
			chmod(PATH.$imageURL, 0644);
		} else {
			$errmsg_arr[] = "File upload fault.";
			$errflag = true;
		}
	} else {
		$errmsg_arr[] = "Upload file is not selected.";
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: products.php");
		exit();
	}
	
	//Create INSERT query
	$qry = "INSERT INTO product
		(Name, Type, Price, ImageURL, Description) VALUES
		('$prodName', '$type','$price', '$imageURL', '$description')";
			
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		header("location: products.php");
		
		exit();
	}
	else {
		die("Query failed");
	}

	//Close	
	mysql_close();
?>
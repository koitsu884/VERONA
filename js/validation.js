function formValidator()
{
	/*var title = document.getElementById("title");
	var fname = document.getElementById("fname");
	var lname = document.getElementById("lname");
	var gender = document.getElementById("gender");
	var dob = document.getElementById("dob");
	var suburb = document.getElementById("suburb");
	var city = document.getElementById("city");
	var zip = document.getElementById("zip");
	var phone = document.getElementById("phone");
	var email = document.getElementById("email");*/
	var loginName = document.getElementsByName("loginName")[0];
	var password = document.getElementsByName("password")[0];
	var confirm_pwd = document.getElementsByName("confirm_pwd")[0];
	var title = document.getElementsByName("title")[0];
	var fname = document.getElementsByName("fname")[0];
	var lname = document.getElementsByName("lname")[0];
	var gender = document.getElementsByName("gender")[0];
	var dob = document.getElementsByName("dob")[0];
	var suburb = document.getElementsByName("suburb")[0];
	var city = document.getElementsByName("city")[0];
	var zip = document.getElementsByName("zip")[0];
	var phone = document.getElementsByName("phone")[0];
	var email = document.getElementsByName("email")[0];
	
	// check each input
	if(!notEmpty(loginName, "Please enter loginName"))
		return false;
	if(!notEmpty(password, "Please enter password"))
		return false;
		//confirm_pwd
	if(!passwordComp(confirm_pwd, password, "Password unmatch"))
		return false;

	if(!notEmpty(fname, "Please enter first name"))
		return false;
	if (!isAlphabet(fname, "Please enter only letters for your name"))
		return false;
		
	if(!notEmpty(lname, "Please enter last name"))
		return false;
	if (!isAlphabet(lname, "Please enter only letters for your name"))
		return false;

	if(!notEmpty(dob, "Please enter date of birth"))
		return false;
	if (!dobValidator(dob, "Please enter correct date (ex. 10/4/1981)"))
		return false;
		
	if(!notEmpty(suburb, "Please enter suburb"))
		return false;
		
	if(!madeSelection(city, "Please choose a city"))
		return false;
		
	if(!notEmpty(zip, "Please enter a zip code"))
		return false;
	if (!isNumeric(zip, "Please enter a valid zip code"))
		return false;
		
	if(!notEmpty(phone, "Please enter a phone number"))
		return false;
	if (!isNumeric(phone, "Please enter only numbers (ex.0123456789)"))
		return false;
		
	if(!notEmpty(email, "Please enter an email address"))
		return false;
	if (!emailValidator(email, "Please enter a valid email address"))
		return false;
		
	return confirmRegistration();
}

function contactFormValidator()
{
	var email = document.getElementsByName("email")[0];
	var lname = document.getElementsByName("lname")[0];
	var fname = document.getElementsByName("fname")[0];
	var subject = document.getElementsByName("subject")[0];
	var query = document.getElementsByName("query")[0];

	
	// check each input
	if (!emailValidator(email, "Please enter a valid email address"))
		return false;
	if(!notEmpty(lname, "Please enter lname"))
		return false;
	if(!notEmpty(fname, "Please enter fname"))
		return false;
	if(!notEmpty(subject, "Please enter subject"))
		return false;
	if(!notEmpty(query, "Please enter query"))
		return false;
			
	return true;
}

function notEmpty(elem, msg){
	if(elem.value.length == 0){
		alert(msg);
		elem.focus();
		return false;
	}
	return true;
}

function isNumeric(elem, msg){
	var numericExpression = /^[0-9]+$/;
	if(elem.value.match(numericExpression)){
		return true;
	}
	else
	{
		alert(msg);
		elem.focus();
		return false;
	}
}

function isAlphabet(elem, msg){
	var alphaExp = /^[a-zA-Z]+$/;
	if( elem.value.match(alphaExp)){
		return true;
	} else{
		alert(msg);
		elem.focus();
		return false;
	}
}

function isAlphanumeric(elem, msg){
	var alphaExp = /^[0-9a-zA-Z]+$/;
	if( elem.value.match(alphaExp)){
		return true;
	} else{
		alert(msg);
		elem.focus();
		return false;
	}
}

function lengthRestriction(elem, min, max){
	var uInput = elem.value;
	if(uInput.length >= min && uInput.length <= max){
		return true;
	}else {
		alert("Please enter between " + min+ "and " + max+ " characters");
		elem.focus();
		return false;
	}
}

function madeSelection(elem, msg){
	if(elem.value == 0)
	{
		alert(msg);
		elem.focus();
		return false;
	} else{
		return true;
	}
}

function emailValidator(elem, msg){
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	if(elem.value.match(emailExp)){
		return true;
	}else{
		alert(msg);
		elem.focus();
		return false;
	}
}

function dobValidator(elem, msg){
	var dobExp = /^[0-3]?[0-9]\/[01]?[0-9]\/[12][90][0-9][0-9]$/
	if(elem.value.match(dobExp)){
		return true;
	}else{
		alert(msg);
		elem.focus();
		return false;
	}
}

function passwordComp(elmSrc, elmComp, msg){
	if(elmSrc.value == elmComp.value)
		return true;
	else
	{
		alert(msg);
		elmSrc.focus();
		return false;
	}
}

function confirmRegistration()
{
	if(!confirm("All information you provided are correct?"))
	{
		alert("Canceled!!");
		return false;
	}
	else
		return true;
}
// JavaScript Document
//admin_validation.js
function EmailValid(emailfield)	{
	var email = emailfield;
	
	if(email=="")	{
		document.getElementById('validation_div').innerHTML='Enter Email ID!';
		return false;
	}
	len = email.length;
	if((email.charAt(1)=='@')||(email.charAt(1)=='.'))		{
		//alert("Invalid Email Please try again!");
		document.getElementById('validation_div').innerHTML='Invalid Email Please try again!';
		return false;
	}
	if((email.charAt(len-2)=='@')||(email.charAt(len-1)=='.'))	{
		//alert("Invalid Email Please try again!");
		document.getElementById('validation_div').innerHTML='Invalid Email Please try again!';
		return false;
	}
	count=0;
	dotcount=0;
	for (i=0; i< email.length; i++)	{
		if(email.charAt(i)=='@')
		count++;
		if(email.charAt(i)=='.')
		dotcount++;
	}		
	if((count !=1)||(dotcount <1))	{
		//alert("Invalid Email Please try again!")
		document.getElementById('validation_div').innerHTML='Invalid Email Please try again!';
		return false
	}			  
	return true
}
function validProfile(frm){
	if(frm.admin_user.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter UserName!';
		frm.admin_user.focus();
		frm.admin_user.style.borderColor='red';
		return false;
	}else{
		frm.admin_user.style.borderColor='';
	}
	
	document.getElementById('validation_div').innerHTML='';
	if(frm.admin_name.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter Name!';
		frm.admin_name.focus();
		frm.admin_name.style.borderColor='red';
		return false;
	}else{
		frm.admin_name.style.borderColor='';
	}
	
	
	if(!EmailValid(frm.admin_email.value)) {
		frm.admin_email.focus();
		frm.admin_email.style.borderColor='red';
		return false;
	}
	else{
		frm.admin_email.style.borderColor='';
	}
}
function addadmin_valid(){
	var frm=document.frm;
	document.getElementById('validation_div').innerHTML='';
	if(frm.name.value.length==0){
	document.getElementById('validation_div').innerHTML='Please Enter Name!';
	frm.name.focus();
	frm.name.style.borderColor='red';
	return false;
	}else{
	frm.name.style.borderColor='';
	}
	if(frm.uname.value.length==0){
	document.getElementById('validation_div').innerHTML='Please Enter UserName!';
	frm.uname.focus();
	frm.uname.style.borderColor='red';
	return false;
	}else{
	frm.uname.style.borderColor='';
	}
	if(frm.pass.value.length==0){
	document.getElementById('validation_div').innerHTML='Please Enter Password!';
	frm.pass.focus();
	frm.pass.style.borderColor='red';
	return false;
	}else{
	frm.pass.style.borderColor='';
	}
	if(frm.repass.value.length==0){
	document.getElementById('validation_div').innerHTML='Please Enter Reenter Password!';
	frm.repass.focus();
	frm.repass.style.borderColor='red';
	return false;
	}else{
	frm.repass.style.borderColor='';
	}
	if(frm.repass.value!=frm.pass.value){
	document.getElementById('validation_div').innerHTML='Password Mismatch!';
	frm.repass.focus();
	frm.repass.style.borderColor='red';
	return false;
	}else{
	frm.repass.style.borderColor='';
	}
	
	if(!EmailValid(frm.email.value)) {
		frm.email.focus();
		frm.email.style.borderColor='red';
		return false;
	}
	else{
	frm.email.style.borderColor='';
	}
	if(frm.phone.value.length==0){
	document.getElementById('validation_div').innerHTML='Please Enter Phone No.!';
	frm.phone.focus();
	frm.phone.style.borderColor='red';
	return false;
	}else{
	frm.phone.style.borderColor='';
	}
	if(isNaN(frm.phone.value)){
	document.getElementById('validation_div').innerHTML='Please Enter Number Only';
	frm.phone.focus();
	frm.phone.style.borderColor='red';
	return false;
	}else{
	frm.phone.style.borderColor='';
	}	
}
function editadmin_valid(){
	var frm=document.frm;
	document.getElementById('validation_div').innerHTML='';
	if(frm.name.value.length==0){
	document.getElementById('validation_div').innerHTML='Please Enter Name!';
	frm.name.focus();
	frm.name.style.borderColor='red';
	return false;
	}else{
	frm.name.style.borderColor='';
	}
	if(frm.uname.value.length==0){
	document.getElementById('validation_div').innerHTML='Please Enter UserName!';
	frm.uname.focus();
	frm.uname.style.borderColor='red';
	return false;
	}else{
	frm.uname.style.borderColor='';
	}		
	if(!EmailValid(frm.email.value)) {
		frm.email.focus();
		frm.email.style.borderColor='red';
		return false;
	}
	else{
	frm.email.style.borderColor='';
	}
	if(frm.phone.value.length==0){
	document.getElementById('validation_div').innerHTML='Please Enter Phone No.!';
	frm.phone.focus();
	frm.phone.style.borderColor='red';
	return false;
	}else{
	frm.phone.style.borderColor='';
	}
	if(isNaN(frm.phone.value)){
	document.getElementById('validation_div').innerHTML='Please Enter Number Only';
	frm.phone.focus();
	frm.phone.style.borderColor='red';
	return false;
	}else{
	frm.phone.style.borderColor='';
	}	
}
function changepass_valid(){
	var frm=document.frm;
	document.getElementById('validation_div').innerHTML='';	
	if(frm.npass.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter New Password!';
		frm.npass.focus();
		frm.npass.style.borderColor='red';
		return false;
	}else{
		frm.npass.style.borderColor='';
	}
	if(frm.cpass.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter Confirm Password!';
		frm.cpass.focus();
		frm.cpass.style.borderColor='red';
		return false;
	}else{
		frm.cpass.style.borderColor='';
	}
	if(frm.cpass.value!=frm.npass.value){
		document.getElementById('validation_div').innerHTML='Password Mismatch!';
		frm.cpass.focus();
		frm.cpass.style.borderColor='red';
		return false;
	}else{
		frm.cpass.style.borderColor='';
	}
}
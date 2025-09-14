$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});


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


function user_valid(){
	var frm=document.frm;
	document.getElementById('validation_div').innerHTML='';
	
	var pic = frm.ppic.value;
	var Extension = pic.substring(pic.lastIndexOf('.') + 1).toLowerCase();
	var size = parseFloat(frm.ppic.files[0].size / 1024).toFixed(2);
	//alert(size);
	/*if(frm.uname.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter Email!';
		frm.uname.focus();
		frm.uname.style.borderColor='red';
		return false;
	}else{
		frm.name.style.borderColor='';
	}*/
	if(!EmailValid(frm.uname.value)) {
		frm.uname.focus();
		frm.uname.style.borderColor='red';
		return false;
	}
	else{
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
	if(frm.contact.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter Phone No.!';
		frm.contact.focus();
		frm.contact.style.borderColor='red';
		return false;
	}else{
		frm.contact.style.borderColor='';
	}
	if(isNaN(frm.contact.value)){
		document.getElementById('validation_div').innerHTML='Please Enter Number Only';
		frm.contact.focus();
		frm.contact.style.borderColor='red';
		return false;
	}else{
		frm.contact.style.borderColor='';
	}
	if(frm.organisation.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter Organisation Name';
		frm.organisation.focus();
		frm.organisation.style.borderColor='red';
		return false;
	}else{
		frm.organisation.style.borderColor='';
	}
	if(frm.cperson.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter Contact Person Name';
		frm.cperson.focus();
		frm.cperson.style.borderColor='red';
		return false;
	}else{
		frm.cperson.style.borderColor='';
	}
	if(isNaN(frm.nemp.value)){
		document.getElementById('validation_div').innerHTML='Please Enter Number Only';
		frm.nemp.focus();
		frm.nemp.style.borderColor='red';
		return false;
	}else{
		frm.nemp.style.borderColor='';
	}
	if(isNaN(frm.atover.value)){
		document.getElementById('validation_div').innerHTML='Please Enter Number Only';
		frm.atover.focus();
		frm.atover.style.borderColor='red';
		return false;
	}else{
		frm.atover.style.borderColor='';
	}
	if(frm.perno.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter the registration number of PF/ESI';
		frm.perno.focus();
		frm.perno.style.borderColor='red';
		return false;
	}else{
		frm.perno.style.borderColor='';
	}
	if(frm.syear.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter the year since business';
		frm.syear.focus();
		frm.syear.style.borderColor='red';
		return false;
	}else{
		frm.syear.style.borderColor='';
	}
	if(pic.length == 0){
		document.getElementById('validation_div').innerHTML='Please upload an image';
		frm.ppic.focus();
		frm.ppic.style.borderColor='red';
		return false;
	}else{
		frm.ppic.style.borderColor='';
	}
	if(Extension != "gif" && Extension != "png" && Extension != "bmp" && Extension != "jpeg" && Extension != "jpg"){
		document.getElementById('validation_div').innerHTML='Please upload an image file only';
		frm.ppic.focus();
		frm.ppic.style.borderColor='red';
		return false;
	}else{
		frm.ppic.style.borderColor='';
	}
	if(size > 100){
		document.getElementById('validation_div').innerHTML='Please upload the image below 100 KB';
		frm.ppic.focus();
		frm.ppic.style.borderColor='red';
		return false;
	}else{
		frm.ppic.style.borderColor='';
	}
	
	
}

function validateTender(formid){ 
	var title = formid.title;
	var tender_name = document.getElementsByName('tender_name[]');
	var tender_file = document.getElementsByName('tender_file[]');
	if (title.value==""){
			alert("Title is required field");
			title.focus();			
			return false;      
		}
	for (var i=0; i<tender_name.length; i++) {        
		if (tender_name[i].value==""){
			alert("Tender Title is required field");
			tender_name[i].focus();			
			return false;      
		}
		/*if (tender_file[i].value==""){
			alert("Tender File is required field");
			tender_file[i].focus();			
			return false;        
		}*/
		
	}
}
function validateTenderEd(formid){ 
	var title = formid.title;
	if (title.value==""){
			alert("Title is required field");
			title.focus();			
			return false;      
		}
	
}
function hunar_valid(frm){ 
	document.getElementById('validation_div').innerHTML='';
	if(frm.h_title.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter title!';
		frm.h_title.focus();
		frm.h_title.style.borderColor='red';
		return false;
	}else{
		frm.h_title.style.borderColor='';
	}
	
}
////////////////////////////////NOTICE/////////////////////////////////////
function notice_valid(){
	var frm=document.frmnotice;
	document.getElementById('validation_div').innerHTML='';
	if(frm.title.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter title!';
		frm.title.focus();
		frm.title.style.borderColor='red';
		return false;
	}else{
		frm.title.style.borderColor='';
	}
	
	if(frm.publish_date.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter  Publish Date!';
		frm.publish_date.focus();
		frm.publish_date.style.borderColor='red';
		return false;
	}else{
		frm.publish_date.style.borderColor='';
	}
	
}
/////////////////////// HAPPENINGS ////////////////////////////////////////
function happenings_valid(){
	var frm=document.frmnotice;
	document.getElementById('validation_div').innerHTML='';
	if(frm.title.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter title!';
		frm.title.focus();
		frm.title.style.borderColor='red';
		return false;
	}else{
		frm.title.style.borderColor='';
	}
	
	if(frm.publish_date.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter  Publish Date!';
		frm.publish_date.focus();
		frm.publish_date.style.borderColor='red';
		return false;
	}else{
		frm.publish_date.style.borderColor='';
	}
	
}
/////////////////////// PHOTO CATEGORY ////////////////////////////////////////
function validateCategory(){
	var frm=document.frm;
	document.getElementById('validation_div').innerHTML='';
	if(frm.category_name.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter Category Name!';
		frm.category_name.focus();
		frm.category_name.style.borderColor='red';
		return false;
	}else{
		frm.category_name.style.borderColor='';
	}
	if(frm.category_url.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter  Category URL!';
		frm.category_url.focus();
		frm.category_url.style.borderColor='red';
		return false;
	}else{
		frm.category_url.style.borderColor='';
	}
	
}
//////////////////////////PHOTO GALLERY////////////////////////////////////////

function photo_valid(formid){
	var appid = formid.appid.value;
	var photo_caption = document.getElementsByName('photo_caption[]');alert(photo_caption.length);
	var photo_file = document.getElementsByName('photo_file[]');
	/*for (var i=0; i<photo_caption.length; i++) {         
		if (photo_caption[i].value==""){
			var elmid=photo_caption[i].getAttribute('id');
			document.getElementById('validation_div').innerHTML='Please Enter Title!';
			elmid.focus();
			elmid.style.borderColor='red';
			return false;      
		}
		if (photo_file[i].value=="" && appid=="" ){
			var elmid=photo_file[i].getAttribute('id');
			document.getElementById('validation_div').innerHTML='Please Upload Photo!';
			return false;      
		}
	
	}
	*/
}

function photo_editvalid(){
	var frm=document.frm;
	document.getElementById('validation_div').innerHTML='';
	if(frm.photo_caption.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter Title!';
		frm.photo_caption.focus();
		frm.photo_caption.style.borderColor='red';
		return false;
	}else{
		frm.photo_caption.style.borderColor='';
	}
		
}
////////////////////////DOCUMENT/////////////////////////
function document_valid(){
	var frm=document.frm;
	document.getElementById('validation_div').innerHTML='';
	if(frm.file_name.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Upload File!';
		frm.file_name.focus();
		frm.file_name.style.borderColor='red';
		return false;
	}else{
		frm.file_name.style.borderColor='';
	}
	if(frm.file_url.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter URL!';
		frm.file_url.focus();
		frm.file_url.style.borderColor='red';
		return false;
	}else{
		frm.file_url.style.borderColor='';
	}
		
}

function document_valid_edit(){
	var frm=document.frm;
	document.getElementById('validation_div').innerHTML='';
	
	if(frm.file_url.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter URL!';
		frm.file_url.focus();
		frm.file_url.style.borderColor='red';
		return false;
	}else{
		frm.file_url.style.borderColor='';
	}
		
}
//////////////////////////TENDER////////////////////////
function tender_valid(){
	var frm=document.frm;
	document.getElementById('validation_div').innerHTML='';
	if(frm.title.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter Title!';
		frm.title.focus();
		frm.title.style.borderColor='red';
		return false;
	}else{
		frm.title.style.borderColor='';
	}
	
	if(frm.publish_date.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter Publish Date!';
		frm.publish_date.focus();
		frm.publish_date.style.borderColor='red';
		return false;
	}else{
		frm.publish_date.style.borderColor='';
	}
	
	if(frm.expiry_date.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter Expire Date!';
		frm.expiry_date.focus();
		frm.expiry_date.style.borderColor='red';
		return false;
	}else{
		frm.expiry_date.style.borderColor='';
	}
	
	
}
/////////////////////Scroll News////////////////////////////////////
function news_valid(){
	var frm=document.frm;
	document.getElementById('validation_div').innerHTML='';
	if(frm.title.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter title!';
		frm.title.focus();
		frm.title.style.borderColor='red';
		return false;
	}else{
		frm.title.style.borderColor='';
	}
	if(frm.url.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter URL!';
		frm.url.focus();
		frm.url.style.borderColor='red';
		return false;
	}else{
		frm.url.style.borderColor='';
	}
	if(frm.publish_date.value.length==0){
		document.getElementById('validation_div').innerHTML='Please Enter  Publish Date!';
		frm.publish_date.focus();
		frm.publish_date.style.borderColor='red';
		return false;
	}else{
		frm.publish_date.style.borderColor='';
	}
	
}
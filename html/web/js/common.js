$(document).ready(function() {
	$(".correct, .error").click(function() {
		$(this).hide(500);
	});
});
function fillURL(txtvalue,txtfld) {
	var nstr = "";
	for(var i=0;i<txtvalue.length;i++) {
		var iChars = "!@#$%^&*()+=[]\\\';,/{}|\":<> ?";
		if (iChars.indexOf(txtvalue.charAt(i)) != -1) {
			nstr += '-';
		}
		else if(txtvalue[i]==" ") {	nstr += '-'; }
		else if(txtvalue[i]=="?") {	nstr += ''; }
		else {
			nstr += txtvalue[i];
		}
	}
	while (nstr.indexOf("--")!=-1){
		nstr=nstr.replace("--","-");
	}
	document.getElementById(txtfld).value = nstr.toLowerCase();
}
function ShowUpload(){
	$('#file').show();
	$('#desc').hide();
	$('#link').hide();
}
function ShowDesc(){
	$('#desc').show();
	$('#file').hide();
	$('#link').hide();
}
function Showlink(){
	$('#link').show();
	$('#desc').hide();
	$('#file').hide();
} 
function chkboxSN(frm){ 
	if(!(frm.checked)){                   
		var id = frm.value;
		$.get("Ajax.php?q=uncheckedSN&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});
	
	}
	else{   
	var id = frm.value;
		$.get("Ajax.php?q=checkedSN&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});
	
	}
}
function chkboxTM(frm){ 
	if(!(frm.checked)){                   
		var id = frm.value;
		$.get("Ajax.php?q=uncheckedTM&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});	
	}
	else{   
		var id = frm.value;
		$.get("Ajax.php?q=checkedTM&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});	
	}
}

function chkboxHUNAR(frm){ 
	if(!(frm.checked)){                   
		var id = frm.value;
		$.get("Ajax.php?q=uncheckedHunar&id="+id,
		function(result) {
			$("#newBlink"+id).html(result);
		});	
	}
	else{   
		var id = frm.value;
		$.get("Ajax.php?q=checkedHunar&id="+id,
		function(result) {
			$("#newBlink"+id).html(result);
		});	
	}
}

function chkboxNB(frm){ 
	if(!(frm.checked)){                   
		var id = frm.value;
		$.get("Ajax.php?q=uncheckedNB&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});
	
	}
	else{   
	var id = frm.value;
		$.get("Ajax.php?q=checkedNB&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});
	
	}
}
function chkboxLN(frm){ 
	if(!(frm.checked)){                   
		var id = frm.value;
		$.get("Ajax.php?q=uncheckedLN&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});
	
	}
	else{   
	var id = frm.value;
		$.get("Ajax.php?q=checkedLN&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});
	
	}
}
function chkboxEL(frm){ 
	if(!(frm.checked)){                   
		var id = frm.value;
		$.get("Ajax.php?q=uncheckedEL&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});
	
	}
	else{   
	var id = frm.value;
		$.get("Ajax.php?q=checkedEL&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});
	
	}
}
function chkboxAL(frm){ 
	if(!(frm.checked)){                   
		var id = frm.value;
		$.get("Ajax.php?q=uncheckedAL&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});
	
	}
	else{   
	var id = frm.value;
		$.get("Ajax.php?q=checkedAL&id="+id,
		function(result) {
		//alert(result);
		$("#newBlink"+id).html(result);
		});
	
	}
}
// JavaScript Document
function addPhotoGalleryRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount>10) {
		alert ("A maximum of 10 Files can be uploaded at once.");
		return true;
	}
	else {
		var row = table.insertRow(rowCount);
		var cell = Array(); var element = Array(); var i=0;	
		cell[i] = row.insertCell(i);cell[i].innerHTML = rowCount;i++;	
		cell[i] = row.insertCell(i);element[i] = document.createElement("textarea");
		element[i].type = "textarea";element[i].name = "photo_caption[]";element[i].setAttribute("id", "photo_caption["+rowCount+"]");
		element[i].setAttribute("rows", "3");
		element[i].setAttribute("cols", "60");
		cell[i].appendChild(element[i]);i++;	
		cell[i] = row.insertCell(i);element[i] = document.createElement("input");
		element[i].type = "file";element[i].name = "photo_file[]";element[i].setAttribute("id", "photo_file["+rowCount+"]");
		cell[i].appendChild(element[i]);
		return true;
	}
	
}
function deletehotoGalleryRow(tableID) {try {var table = document.getElementById(tableID);var rowCount = table.rows.length;
	if(rowCount>2) {table.deleteRow(rowCount-1);}}catch(e) {;}}
	
	
	
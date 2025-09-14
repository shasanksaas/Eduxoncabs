<?php
class dbquery extends SiteData {	
	
	function exeCute($qry){
		$sql_query = mysql_query($qry);
		while($data = mysql_fetch_array($sql_query)){
			$res_data[] = $data; 
		}
		return $res_data;
	}	
	function fetch_data($tbl_nm,$condition="",$order="",$limit=""){
     	 $select = "SELECT * FROM ".$tbl_nm;
		if($condition!=""){
			$select .= " WHERE ".$condition;
		}
		if($order!=""){
			$select .= " ORDER BY ".$order;
		}
		if($limit!=""){
			$select .= " LIMIT ".$limit;
		}
		//echo $select;exit;
		$res = mysql_query($select);
		while($res_row = mysql_fetch_array($res)){
		$res_data[] = $res_row; 
		}
		
		return $res_data;
	}

	
	function fetch_data_query($getquery){
     	$select = $getquery;
		$res = mysql_query($select);
		while($res_row = mysql_fetch_array($res)){
		$res_data[] = $res_row; 
		}
		
		return $res_data;
	}
	function insertToDb($tbl,$fields){
		$insert = "INSERT INTO ".$tbl." SET ".$fields;
		//echo $insert;exit;
		$exe = mysql_query($insert);
		if($exe){
			$val = 1;
		}else{
			$val = 0;	
		}
		return $val;
	}
	
	function insertToDblastId($tbl,$fields){
		$insert = "INSERT INTO ".$tbl." SET ".$fields;
		//echo $insert;exit;
		$exe = mysql_query($insert);
		if($exe){
			$val = mysql_insert_id();
		}else{
			$val = 0;	
		}
		return $val;
	}
	
	function insertToDbd($tbl,$fields){
		$insert = "INSERT INTO ".$tbl." SET ".$fields;
		echo $insert;exit;
		$exe = mysql_query($insert);
		if($exe){
			$val = 1;
		}else{
			$val = 0;	
		}
		return $val;
	}
	
	
	 function enableReview($id) {
		$id = inText($id);
		$sql = "UPDATE tbl_user set review_status='1' where id='$id'";
		$res = $this->update($sql);
		$msg = "success";
		return $msg;
	}
	
	
	function disableReview($id) {
		$id = inText($id);		
		$sql = "UPDATE tbl_user set review_status='0' where id='$id'";
		$res = $this->update($sql);
		$msg = "success";
		return $msg;
	}
	function updateToDb($tbl,$fields,$condition){
	$update = "UPDATE ".$tbl." SET ".$fields." WHERE ".$condition;
	//echo $update;exit;
		$exe = mysql_query($update);
		if($exe){
			$val = 1;
		}else{
			$val=0;
		}
		return $val;
	}
	
	function updateToDbd($tbl,$fields,$condition){
	$update = "UPDATE ".$tbl." SET ".$fields." WHERE ".$condition;
	echo $update;exit;
		$exe = mysql_query($update);
		if($exe){
			$val = 1;
		}else{
			$val=0;
		}
		return $val;
	}
	
	
	
	function selectFromDb($tbl,$fields,$all="*",$condition="",$order="",$limit="")
	{
	
		$select = "SELECT ";
		
		if($fields!=""){
			$select .= $fields;
		}else{
			$select .= $all;
		}
		
		$select .= " FROM ".$tbl." ";
		if($condition!=""){
			$select .= "WHERE ".$condition;
		}
		if($order!=""){
			$select .= " ".$order;
		}
		if($limit!=""){
			$select .= $limit;
		}
		//echo $select;exit;
		$exe = $this->exeCute($select);
		return $exe;
		
	     }
         function delete($tbl_nm,$field,$condition){
		if($field!=""){
			$select = "DELETE ".$field." FROM ".$tbl_nm." WHERE ".$condition;
		}else{
			$select = "DELETE FROM ".$tbl_nm." WHERE ".$condition;
		}
		//echo $select;exit;
		$sql = mysql_query($select);
		if($sql){
			return true;
		}else{
			return false;
		}
		
	}
        
	function countRec($tbl_nm,$condition=""){
		 $select = "SELECT * FROM ".$tbl_nm;
		if($condition!=""){
			$select .= " WHERE ".$condition;
		}
		//echo $select;exit;
		$row_query = mysql_query($select);
		 $num_row = mysql_num_rows($row_query);
		
		return $num_row; 
	}
	function fetchSingleLatest($tbl_nm,$condition="",$key=""){
		$select = "SELECT * FROM ".$tbl_nm;
		if($condition!=""){
			$select .= " WHERE ".$condition;
		}
		if($key!=""){
			$select .= " ORDER BY ".$key." LIMIT 1"; 
		}
		//echo $select;exit;
		$qry_exe = mysql_query($select);
		$ret_rec = mysql_fetch_array($qry_exe);
		
		return $ret_rec;
	}
	function fetchSingle($tbl_nm,$field,$condition){
		if($field!=""){
			$select = "SELECT ".$field." FROM ";
		}else{
			$select = "SELECT * FROM ";
		}
		$select .= $tbl_nm." WHERE ".$condition;
		$sql = mysql_query($select);
		$data_row = mysql_num_rows($sql);
		if($data_row>0){
			$rec = mysql_fetch_array($sql);
			return $rec;
			}else{
			$rec=0;
			return $rec;  
			}

	}

function checkDuplicate($tbl_nm,$condition){
		$select = "SELECT * FROM ".$tbl_nm." WHERE ".$condition;
		$sql = mysql_query($select);
		$row = mysql_num_rows($sql);
		if($row>0){
			return 1;
		}else{
			return 0;
		}
	}
	
	
function fetch_datad($tbl_nm,$condition="",$order="",$limit=""){
     	 $select = "SELECT * FROM ".$tbl_nm;
		if($condition!=""){
			$select .= " WHERE ".$condition;
		}
		if($order!=""){
			$select .= " ORDER BY ".$order;
		}
		if($limit!=""){
			$select .= " LIMIT ".$limit;
		}
		echo $select;exit;
		$res = mysql_query($select);
		while($res_row = mysql_fetch_array($res)){
		$res_data[] = $res_row; 
		}
		
		return $res_data;
	}	
	
function addupd($file){
$target_dir = "uploads/";
$target_file = $target_dir . basename($file["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check file size
//if ($file["fileToUpload"]["size"] > 500000) {
   // echo "Sorry, your file is too large.";
    //$uploadOk = 0;
//}


// Allow certain file formats
if($imageFileType != "pdf" && $imageFileType != "ppt") {
    die("Sorry, only PDF & PDF files are allowed.");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	$temp = explode(".", $target_file);
	//print_r($temp);exit;
	$newfilename =  round(microtime(true)) . '.' . end($temp);
    if (move_uploaded_file($file["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
        $msg = $newfilename;
    } else {
        $msg = "Sorry, there was an error uploading your file.";
    }
}
return $msg;
}	


function addcoverimg($file){
$target_dir = "../image/";
$target_file = $target_dir . basename($file["coverimg"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check file size
//if ($file["fileToUpload"]["size"] > 500000) {
   // echo "Sorry, your file is too large.";
    //$uploadOk = 0;
//}


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif") {
    die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	$temp = explode(".", $target_file);
	//print_r($temp);exit;
	$newfilename =  round(microtime(true)) . '.' . end($temp);
    if (move_uploaded_file($file["coverimg"]["tmp_name"], $target_dir . $newfilename)) {
        $msg = $newfilename;
    } else {
        $msg = "Sorry, there was an error uploading your file.";
    }
}
return $msg;
}	

}

?>
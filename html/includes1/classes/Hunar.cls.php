<?php
//Hunar.cls.php
class Hunar extends SiteData {
	public $file_type = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/bmp", "application/pdf"); 
	
	function getTotalPages() {
		$sql = "SELECT count(*) as total_pages from ".HUNAR;
		$res = $this->getData($sql);
		return $res['oDATA'][0]['total_pages'];
	}
	function getAllData($page=0, $orderby="id", $order="desc") {
		$sql = "SELECT * from ".HUNAR." order by $orderby $order limit $page,".PAGE_LIMIT;	
		$res = $this->getData($sql);
		return $res;
	}
	function getActiveData($type="") {
		$type=intext($type);
		$sql = "SELECT * from ".HUNAR." where h_status='1' AND h_type='$type' order by id desc";	
		$res = $this->getData($sql);
		return $res;
	}
	function getNewsLimit($limit=6) {
		$limit= (int)$limit;
		$sql = "SELECT * from ".HUNAR." where status = '1'  order by id desc,sort_order asc LIMIT 0,$limit";	
		$res = $this->getData($sql);
		return $res;
	}
	function getAllActNews() {
		$sql = "SELECT * from ".HUNAR." where status = '1'  order by id desc,sort_order asc";	
		$res = $this->getData($sql);
		return $res;
	}
	function getDataById($id) {
		$sql = "SELECT * from ".HUNAR." where md5(id) = '$id'";
		$res = $this->getData($sql);
		return $res;
	}
	function getNewsByUrl($url) {
		$sql = "SELECT * from ".HUNAR." where url = '$url' and  url != ''";
		$res = $this->getData($sql);
		return $res;
	}
	function addData($request){ 
		extract($request); 		
		$h_type = inText($h_type);
		$h_title = inText($h_title);
		$h_updated = date("d-m-Y");
		if($h_title == "") {
			$msg = 'Please Provide Title.';
			setMessage($msg, "error");
		}
		else {
			if( isset($_FILES['h_file']['name']) && $_FILES['h_file']['name']!="" ) {
				$h_file = $this->upload($_FILES['h_file'],"hunar");
			}
			else {
				$h_file = "";
			}		
			$sql = "INSERT INTO ".HUNAR." (h_type, h_title, h_file, h_updated) VALUES ('$h_type','$h_title','$h_file','$h_updated')";
			$res = $this->inserttoDB($sql);
			$msg = 'Data Added.';
			setMessage($msg, "correct");
		}
		return $res;
	}
	function updateData($request) {
		extract($request);
		$id = inText($id);
		$h_type = inText($h_type);
		$h_title = inText($h_title);		
		
		if($h_title == "") {
			$msg = 'Please Provide Title.';
			setMessage($msg, "error");
		}
		else {
			if( isset($_FILES['h_file']['name']) && $_FILES['h_file']['name']!="" ) {
				$h_file = $this->upload($_FILES['h_file'],"hunar");
				$sql = "UPDATE ".HUNAR." SET h_type='$h_type', h_title='$h_title', h_file='$h_file' WHERE md5(id)='$id'";
			}
			else {
				$sql = "UPDATE ".HUNAR." SET h_type='$h_type', h_title='$h_title' WHERE md5(id)='$id'";
			}
			//echo "<p>".$sql."</p>";
			$res = $this->update($sql);
			$msg = 'Data Updated.';
			setMessage($msg, "correct");
		}
		return $res;		
	}
	
	function disableStatus($id) {
		$id = inText($id);		
		$sql = "UPDATE ".HUNAR." set h_status='0' where md5(id)='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	function enableStatus($id) {
		$id = inText($id);
		$sql = "UPDATE ".HUNAR." set h_status='1' where md5(id)='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	function deleteData($id) {
		$id = inText($id);
		$s = "SELECT * from ".HUNAR." WHERE md5(id)='$id'";
		$res = $this->getData($s);
		$h_file =$res['oDATA'][0]['h_file'];
		@unlink("../documents/".$h_file);
		$sql = "DELETE from ".HUNAR." WHERE md5(id)='$id'";
		$res = $this->deleterecord($sql);
		return $res;
	}
	function upload($files, $t_name) {
		$file_type = $this->file_type; // access the public varible
		$photo_name = $files["name"];
		$paths = pathinfo($photo_name);
		$ext = $paths['extension']; $fname = $paths['filename'];
		$tempFile = $files["tmp_name"];
		$time=mktime(date("d:m:Y H:i:s"));
		$target_file_name = $t_name."_".$time.".".$ext;
		//echo $target_file_name;
		$target_file_path = "../documents/".$target_file_name;
		move_uploaded_file($tempFile, $target_file_path);			
		return $target_file_name;
	}
	
}//END OF CLASS
?>

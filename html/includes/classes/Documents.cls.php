<?php
class Document extends SiteData {
	public $file_type = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/bmp", "application/pdf"); 
	
	function getTotalPages() {
		$sql = "SELECT count(*) as total_pages from ".DOCUMENTS;
		$res = $this->getData($sql);
		return $res['oDATA'][0]['total_pages'];
	}
	function getAllDcouments($page=0, $orderby="id", $order="desc") {
		$sql = "SELECT * from ".DOCUMENTS." order by $orderby $order limit $page,".PAGE_LIMIT;	
		$res = $this->getData($sql);
		return $res;
	}
	function getDcouments() {
		$sql = "SELECT * from ".DOCUMENTS ." where status = '1'  order by id desc";	
		$res = $this->getData($sql);
		return $res;
	}
	function getDocumentById($id) {
		$sql = "SELECT * from ".DOCUMENTS." where md5(id) = '$id'";
		$res = $this->getData($sql);
		return $res;
	}
	function addDocument($request){ 
		extract($request); 
		$file_url = inText($file_url);
		if( isset($_FILES['file_name']['name']) && $_FILES['file_name']['name']!="" ) {
				$docment = $file_url;
				$file_name = $this->upload($_FILES['file_name'],$docment);
			}
		else {
				$file_name = "";
			}
		$sql = "SELECT * from ".DOCUMENTS." where file_url like '$file_url'";
		$res = $this->getData($sql);
		//echo $sql;exit;
		if($res['NO_OF_ITEMS']>0) {
			$msg = 'URL Already Exists.';
			setMessage($msg, "error");
		}else{
			if($file_url !="")	{		
				$sql = "INSERT INTO ".DOCUMENTS." (file_name,file_url)values('$file_name','$file_url')";
				$res = $this->insert($sql);
				$msg = 'Document Added.';
				setMessage($msg, "correct");
			}else{
				$msg = 'Document not added, Please try again with mandatory field.';
				setMessage($msg, "error");
			}
		}
		return $res;
	
	}
	function updateDocument($request) {
		extract($request); 
		$file_url = inText($file_url);
		if( isset($_FILES['file_name']['name']) && $_FILES['file_name']['name']!="" ) {
				$docment = $file_url;
				$file_name = $this->upload($_FILES['file_name'],$docment);
			}
		else {
				$file_name = "";
			}
		$sql = "SELECT * from ".DOCUMENTS." where file_url like '$file_url' and id!='$id'";
		$res = $this->getData($sql);
		if($res['NO_OF_ITEMS']>0) {
			$msg = 'Faculty URL Already Exists.';
			setMessage($msg, "error");
		}else{	
			if($file_name !="")	{		
				$sql = "UPDATE ".DOCUMENTS." SET file_name='$file_name',file_url='$file_url' where id='$id'";
				$res = $this->update($sql);
				
			}else{
				$sql = "UPDATE ".DOCUMENTS." SET file_url='$file_url' where id='$id'";
				$res = $this->update($sql);
				
			}
			$msg = 'Document Updated.';
			setMessage($msg, "correct");
		}
		return $res;
		
	}
	
	
	function deleteDocument($id) {
		$sql = "DELETE from ".DOCUMENTS." WHERE id = $id ";		
		$s = "SELECT * from ".DOCUMENTS." WHERE id = $id";
		$res2 = $this->getData($s);
		
		$file_name =$res2['oDATA'][0]['file_name'];
		@unlink("../document/".$file_name);
		
		$res = $this->deleterecord($sql);
		$msg="Data deleted Successfully.";
		setMessage($msg, "correct");
		return $res;
	}
	
	function upload($files, $t_name) {
		$target_file_name = "";
		$file_type = $this->file_type; // access the public varible
		if( in_array($files["type"], $file_type) )	{
			$photo_name = $files["name"];
			$paths = pathinfo($photo_name);
			$ext = $paths['extension']; $fname = $paths['filename'];
			$tempFile = $files["tmp_name"];
			$time=mktime(date("d:m:Y H:i:s"));
			$target_file_name = $t_name.".".$ext;
			$target_file_path = "../document/".$target_file_name;
			move_uploaded_file($tempFile, $target_file_path);			
		}
		return $target_file_name;
	}
	
}//END OF CLASS
?>

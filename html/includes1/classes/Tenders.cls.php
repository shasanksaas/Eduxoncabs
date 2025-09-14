<?php
class Tender extends SiteData {
	public $file_type = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/bmp", "application/pdf"); 
	
	function getTotalPages() {
		$sql = "SELECT count(*) as total_pages from ".TENDERS;
		$res = $this->getData($sql);
		return $res['oDATA'][0]['total_pages'];
	}
	function getAllTenders($page=0, $orderby="id", $order="desc") {
		$sql = "SELECT * from ".TENDERS." order by $orderby $order limit $page,".PAGE_LIMIT;	
		$res = $this->getData($sql);
		return $res;
	}
	function getTenders() {
		$sql = "SELECT * from ".TENDERS ." where status = '1'  order by id desc";	
		$res = $this->getData($sql);
		return $res;
	}
	function getTenderById($id) {
		$sql = "SELECT * from ".TENDERS." where md5(id) = '$id'";
		$res = $this->getData($sql);
		return $res;
	}
	
	
	function addTender($request){ 
		extract($request); 
		$title = inHTML($title);
		$publish_date = inText($publish_date);
		$expiry_date = inText($expiry_date);
		$description = inHTML($description);
		$status = 1;
		$new_file_name= "";
		if($title !="" && $publish_date != "" )	{
			if(isset($_FILES['tender_file'])) {
				$tender_file_name = $_FILES['tender_file']['name'];
				$tender_file_type = $_FILES['tender_file']['type'];
				if( ($_FILES['tender_file']['name']!="") && ($tender_file_type == "application/pdf") ) {
					$tender_file_tmp_name = $_FILES['tender_file']['tmp_name'];
					$paths = pathinfo($tender_file_name);
					$ext = $paths['extension'];
					$time=date("dmyHis");
					$new_file_name = "tender_".$time.".".$ext;
					$target_file_path = "../tenders/".$new_file_name;
					move_uploaded_file($tender_file_tmp_name, $target_file_path);						
				}
			}				
			$sql = "INSERT INTO ".TENDERS." (title,  description, publish_date, expiry_date, tender_file, status) values('$title',  '$description', '$publish_date', '$expiry_date', '$new_file_name', '$status')";
			$res = $this->inserttoDB($sql);	
			setMessage("Tender Added.", "correct");
		}else{
			$msg = 'Tender not added, Please try again with mandatory field.';
			setMessage($msg, "error");
		}
	}
	function updateTender($request) {
		extract($request);
		$title = inHTML($title);
		$publish_date = inText($publish_date);
		$expiry_date = inText($expiry_date);
		$description = inHTML($description);
		if($title !="" )	{
			if(isset($_FILES['tender_file'])) {
				$tender_file_name = $_FILES['tender_file']['name'];
				$tender_file_type = $_FILES['tender_file']['type'];
				if( ($_FILES['tender_file']['name']!="") && ($tender_file_type=="application/pdf") ) {
					$tender_file_tmp_name = $_FILES['tender_file']['tmp_name'];
					$paths = pathinfo($tender_file_name);
					$ext = $paths['extension'];
					$time=date("dmyHis");
					$new_file_name = "tender_".$time.".".$ext;
					$target_file_path = "../tenders/".$new_file_name;
					move_uploaded_file($tender_file_tmp_name, $target_file_path);
					$sql = "UPDATE ".TENDERS."	set title='$title', description='$description', publish_date='$publish_date',  expiry_date='$expiry_date', tender_file='$new_file_name' where id='$id'";
					$res = $this->update($sql);
				}
			}
			$sql = "UPDATE ".TENDERS."	set title='$title', description='$description', publish_date='$publish_date',  expiry_date='$expiry_date' where id='$id'";
			$res = $this->update($sql);	
			setMessage("Tender Updated.", "correct");
		}else{
			$msg = 'Tender not Updated, Please try again with mandatory field.';
			setMessage($msg, "error");
		}		
	}
	
	
	
	function disableStatus($id) {
		$id = inText($id);		
		$sql = "UPDATE ".TENDERS." set status='0' where id='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	function enableStatus($id) {
		$id = inText($id);
		$sql = "UPDATE ".TENDERS." set status='1' where id='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	function deleteTender($id) {
		$sql = "DELETE from ".TENDERS." WHERE id = $id ";
		$res = $this->deleterecord($sql);
		$total = $res['NO_OF_ITEMS'];
		for($i=0;$i<$total;$i++){
			$file_name =$res2['oDATA'][$i]['tender_file'];
			@unlink("../tenders/".$file_name);
		}
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
			$target_file_name = $t_name."_".$time.".".$ext;
			$target_file_path = "../tenders/".$target_file_name;
			move_uploaded_file($tempFile, $target_file_path);			
		}
		return $target_file_name;
	}
	
}//END OF CLASS
?>

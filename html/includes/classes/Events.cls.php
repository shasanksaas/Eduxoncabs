<?php
class Events extends SiteData {
	public $file_type = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/bmp", "application/pdf"); 
	
	function getTotalPages() {
		$sql = "SELECT count(*) as total_pages from ".EVENTS;
		$res = $this->getData($sql);
		return $res['oDATA'][0]['total_pages'];
	}
	function getAllEvents($page=0, $orderby="id", $order="desc") {
		$sql = "SELECT * from ".EVENTS." order by $orderby $order limit $page,".PAGE_LIMIT;	
		$res = $this->getData($sql);
		return $res;
	}
	
	function getAllActEvents() {
		$sql = "SELECT *, str_to_date(publish_date,'%d-%m-%Y') as p_date from ".EVENTS." where status = '1'  order by p_date desc,sort_order asc ";	
		$res = $this->getData($sql);
		return $res;
	}
	function getEventsLimit($limit) {
		$sql = "SELECT *, str_to_date(publish_date,'%d-%m-%Y') as p_date from ".EVENTS." where status = '1' order by p_date desc,sort_order asc LIMIT 0,$limit";	
		$res = $this->getData($sql);
		return $res;
	}
	function getEventsById($id) {
		$sql = "SELECT * from ".EVENTS." where md5(id) = '$id'";
		$res = $this->getData($sql);
		return $res;
	}
	function getEventsByUrl($url) {
		$sql = "SELECT * from ".EVENTS." where url = '$url'";
		$res = $this->getData($sql);
		return $res;
	}
	function addEvents($request){ 
		extract($request); 
		$title = inText($title);
		$url = inText($url);
		$publish_date = inText($publish_date);
		$expiry_date = inText($expiry_date);
		$link = ($_REQUEST['link']);
		if( isset($_FILES['file_name']['name']) && $_FILES['file_name']['name']!="" ) {
				$events = "events";
				$file_name = $this->upload($_FILES['file_name'],$events);
		}
		else {
				$file_name = "";
		}
		$sql = "SELECT url from ".EVENTS." where url like '$url'";
		$res = $this->getData($sql);
		if($res['NO_OF_ITEMS']>0) {
			$msg = 'URL Already Exists.';
			setMessage($msg, "error");
		}else{	
			if($title !="" and $publish_date != "")	{		
				$sql = "INSERT INTO ".EVENTS." (type,title,publish_date,description,link,file_name,url)values('$type','$title','$publish_date','$description','$link','$file_name','$url')";
				$res = $this->insert($sql);
				$msg = 'Events Added.';
				setMessage($msg, "correct");
			}else{
				$msg = 'Events not added, Please try again with mandatory field.';
				setMessage($msg, "error");
			}
		}
		return $res;	
	}
	function updateEvents($request) {
		extract($request);
		$id = ($_REQUEST['id']);
		$type = ($_REQUEST['type']);
		$title = inText($_REQUEST['title']);
		$url = inText($url);
		$publish_date = inText($_REQUEST['publish_date']);
		$file_type = $_FILES['file_name']['type'];
		if( isset($_FILES['file_name']['name']) && $_FILES['file_name']['name']!="" ) {
				$events = "events";
				$file_name = $this->upload($_FILES['file_name'],$events);
			}
		else {
				$file_name = "";
			}
		$sql = "SELECT url from ".EVENTS." where url like '$url' and id!='$id'";
		$res = $this->getData($sql);
		if($res['NO_OF_ITEMS']>0) {
			$msg = 'URL Already Exists.';
			setMessage($msg, "error");
		}else{
			if($file_name){
				$s = "select * from ".EVENTS." WHERE id = $id";
				$res = $this->getData($s);
				$filename =$res['oDATA'][0]['file_name'];
				@unlink("../events/".$filename);				
				$sql = "UPDATE ".EVENTS." SET type='$type',title='$title',publish_date='$publish_date',description='$description',link='$link',file_name='$file_name',url='$url' where id='$id'";
				$res = $this->update($sql);
			}else{
				$sql = "UPDATE ".EVENTS." SET type='$type',title='$title',publish_date='$publish_date',description='$description',link='$link',url='$url' where id='$id'";
				$res = $this->update($sql);
			}
			$msg = 'Events Updated.';
			setMessage($msg, "correct");
		}		
	}	
	function disableStatus($id) {
		$id = inText($id);		
		$sql = "UPDATE ".EVENTS." set status='0' where id='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	function enableStatus($id) {
		$id = inText($id);
		$sql = "UPDATE ".EVENTS." set status='1' where id='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	function deleteEvents($id) {
		$sql = "DELETE from ".EVENTS." WHERE id = $id ";
		$s = "SELECT * from ".EVENTS." WHERE id = $id";
		$res = $this->getData($s);
		$file_name =$res['oDATA'][0]['file_name'];
		@unlink("../events/".$file_name);
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
			$target_file_name = $t_name."_".$time.".".$ext;
			$target_file_path = "../events/".$target_file_name;
			move_uploaded_file($tempFile, $target_file_path);			
		}
		return $target_file_name;
	}	
}//END OF CLASS
?>

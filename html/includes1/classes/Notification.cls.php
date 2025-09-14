<?php
class Notification extends SiteData {
	public $file_type = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/bmp", "application/pdf"); 
	
	function getTotalPages() {
		$sql = "SELECT count(*) as total_pages from ".NOTIFICATION;
		$res = $this->getData($sql);
		return $res['oDATA'][0]['total_pages'];
	}
	function getAllNotices($page=0, $orderby="id", $order="desc") {
		$sql = "SELECT * from ".NOTIFICATION." order by $orderby $order limit $page,".PAGE_LIMIT;	
		$res = $this->getData($sql);
		return $res;
	}
	function getNotices() {
		$sql = "SELECT * from ".NOTIFICATION ." where status = '1'  order by id desc ";	
		$res = $this->getData($sql);
		return $res;
	}
	function getNoticesLimt() {
		$sql = "SELECT * from ".NOTIFICATION ." where status = '1'  order by id desc,sort_order asc LIMIT 0,5";	
		$res = $this->getData($sql);
		return $res;
	}
	function getAllActNotices() {
		$sql = "SELECT * from ".NOTIFICATION ." where status = '1'  order by id desc,sort_order asc";	
		$res = $this->getData($sql);
		return $res;
	}
	function getNoticeById($id) {
		$sql = "SELECT * from ".NOTIFICATION." where md5(id) = '$id'";
		$res = $this->getData($sql);
		return $res;
	}
	function getNoticesByUrl($url) {
		$sql = "SELECT * from ".NOTIFICATION." where url = '$url' and  url != ''";
		$res = $this->getData($sql);
		return $res;
	}
	
	// ADD NOTICE
	function addNotice($request){ 
		extract($request); 
		$title = inText($title);
		if($type==0){$url = inText($url);}else{$url ="";}
		$publish_date = inText($publish_date);
		$expiry_date = inText($expiry_date);
		$link = ($_REQUEST['link']);
		if( isset($_FILES['file_name']['name']) && $_FILES['file_name']['name']!="" ) {
				$notice = "notification";
				$file_name = $this->upload($_FILES['file_name'],$notice);
			}
		else {
				$file_name = "";
			}
		if($type==0){	
			$sql = "SELECT url from ".NOTIFICATION." where url like '$url' and url!=''";
			$res = $this->getData($sql);
			if($res['NO_OF_ITEMS']>0) {
				$msg = 'URL Already Exists.';
				setMessage($msg, "error");
			}else{	
				if($title !=""  and $publish_date != "" and $url != "")	{		
					$sql = "INSERT INTO ".NOTIFICATION." (type,title,publish_date,description,link,file_name,url)values('$type','$title','$publish_date','$description','$link','$file_name','$url')";
					$res = $this->inserttoDB($sql);
					$msg = 'Notice Added.';
					setMessage($msg, "correct");
				}else{
					$msg = 'Notice not added, Please try again with mandatory field.';
					setMessage($msg, "error");
				}
			}
		}else{
				if($title !=""  and $publish_date != "")	{		
					$sql = "INSERT INTO ".NOTIFICATION." (type,title,publish_date,description,link,file_name,url)values('$type','$title','$publish_date','$description','$link','$file_name','$url')";
					$res = $this->inserttoDB($sql);
					$msg = 'Notice Added.';
					setMessage($msg, "correct");
				}else{
					$msg = 'Notice not added, Please try again with mandatory field.';
					setMessage($msg, "error");
				}
		}
		return $res;
	
	}
	function updateNotice($request) {
		extract($request);
		$id = ($_REQUEST['id']);
		$type = ($_REQUEST['type']);
		$title = inText($_REQUEST['title']);
		if($type==0){$url = inText($url);}else{$url ="";}
		$publish_date = inText($_REQUEST['publish_date']);
		$file_type = $_FILES['file_name']['type'];
		if( isset($_FILES['file_name']['name']) && $_FILES['file_name']['name']!="" ) {
				$notice = "notification";
				$file_name = $this->upload($_FILES['file_name'],$notice);
			}
		else {
				$file_name = "";
			}
		if($type==0){
			$sql = "SELECT url from ".NOTIFICATION." where url like '$url' and id!='$id' and url!=''";
			$res = $this->getData($sql);
			if($res['NO_OF_ITEMS']>0) {
				$msg = 'URL Already Exists.';
				setMessage($msg, "error");
			}else{
				if($url){
					if($file_name){
						$s = "select * from ".NOTIFICATION." WHERE id = $id";
						$res = $this->getData($s);
						$filename =$res['oDATA'][0]['file_name'];
						@unlink("../notices/".$filename);
						
						$sql = "UPDATE ".NOTIFICATION." SET type='$type',title='$title',publish_date='$publish_date',description='$description',link='$link',file_name='$file_name',url='$url' where id='$id'";
						$res = $this->update($sql);
					}else{
						$sql = "UPDATE ".NOTIFICATION." SET type='$type',title='$title',publish_date='$publish_date',description='$description',link='$link',url='$url' where id='$id'";
						$res = $this->update($sql);
					}
					$msg = 'Notice Updated.';
					setMessage($msg, "correct");
				}else{
					$msg = 'Notice  not Updated, Please try again with mandatory field.';
					setMessage($msg, "error");
				}
			}
		}else{
		
		if($file_name){
				$s = "select * from ".NOTIFICATION." WHERE id = $id";
				$res = $this->getData($s);
				$filename =$res['oDATA'][0]['file_name'];
				@unlink("../notices/".$filename);
				
				$sql = "UPDATE ".NOTIFICATION." SET type='$type',title='$title',publish_date='$publish_date',description='$description',link='$link',file_name='$file_name',url='$url' where id='$id'";
				$res = $this->update($sql);
			}else{
				$sql = "UPDATE ".NOTIFICATION." SET type='$type',title='$title',publish_date='$publish_date',description='$description',link='$link',url='$url' where id='$id'";
				$res = $this->update($sql);
			}
				$msg = 'Notice Updated.';
				setMessage($msg, "correct");
		}
		
	}
	
	// NOTICE STATUS UPDATION
	function disableStatus($id) {
		$id = inText($id);		
		$sql = "UPDATE ".NOTIFICATION." set status='0' where id='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	function enableStatus($id) {
		$id = inText($id);
		$sql = "UPDATE ".NOTIFICATION." set status='1' where id='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	//DELETE NOTICE
	function deleteNotice($id) {
		$sql = "DELETE from ".NOTIFICATION." WHERE id = $id ";
		$s = "SELECT * from ".NOTIFICATION." WHERE id = $id";
		$res = $this->getData($s);
		$file_name =$res['oDATA'][0]['file_name'];
		@unlink("../notices/".$file_name);
		$res = $this->deleterecord($sql);
		$msg="Notice deteled Successfully.";
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
			$target_file_path = "../notices-file/".$target_file_name;
			move_uploaded_file($tempFile, $target_file_path);			
		}
		return $target_file_name;
	}
	
}//END OF CLASS
?>

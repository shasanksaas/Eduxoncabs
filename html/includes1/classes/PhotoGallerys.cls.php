<?php
class PhotoGallerys extends SiteData {
	public $file_type = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/bmp", "application/pdf"); 
	function getTotalPhotoGallery($id) {
		$sql = "SELECT count(*) as total_pages from ".PHOTO_GALLERYS. " where md5(photo_category)='$id'";
		$res = $this->getData($sql);
		return $res['oDATA'][0]['total_pages'];
	}
	function getAllPhotoGallery($page=0, $orderby="photo_id", $order="desc",$id) {
		$sql = "SELECT * from ".PHOTO_GALLERYS." where md5(photo_category)='$id' order by $orderby $order limit $page,".PAGE_LIMIT;	
		$res = $this->getData($sql);
		return $res;
	}
	function getAllActPhoto() {
		$sql = "SELECT * from ".PHOTO_GALLERYS." where photo_status=1 order by photo_category desc limit 0,10";	
		$res = $this->getData($sql);
		return $res;
	}
	function getTotalCategory() {
		$sql = "SELECT count(*) as total_pages from ".PHOTO_CATEGORYS;
		$res = $this->getData($sql);
		return $res['oDATA'][0]['total_pages'];
	}
	function getAllCategory($page=0, $orderby="category_id", $order="desc") {
		$sql = "SELECT * from ".PHOTO_CATEGORYS." order by $orderby $order limit $page,".PAGE_LIMIT;	
		$res = $this->getData($sql);
		return $res;
	}
	
	function getCategoryById($id) {
		$sql = "SELECT * from ".PHOTO_CATEGORYS." where md5(category_id) = '$id'";
		$res = $this->getData($sql);
		return $res;
	}
	function getPhotoById($id) {
		$sql = "SELECT * from ".PHOTO_GALLERYS." where md5(photo_id) = '$id'";
		$res = $this->getData($sql);
		return $res;
	}
	function getCategory() {
		$sql = "SELECT * from ".PHOTO_CATEGORYS." where category_status=1 order by category_id desc";
		//print "SQL:::::Vijaya".$sql;
		$res = $this->getData($sql);
		return $res;
	}
	function getCatPhoto($url) {
		$sql = "SELECT a.*,b.* from ".PHOTO_GALLERYS." a LEFT OUTER JOIN 
		".PHOTO_CATEGORYS." b ON  b.category_id=a.photo_category where category_url='$url' order by category_id desc";
		
		$res = $this->getData($sql);
		return $res;
	}
	function addCategory($request){ 
		extract($request); 
		$category_name = inText($category_name);
		$category_url = inText($category_url);
		
		if($category_name !="" and $category_url != "")	{
			$s = "SELECT * from ".PHOTO_CATEGORYS." where category_name like '$category_name'";
			$res = $this->getData($s);
			
			if($res['NO_OF_ITEMS']>0) {
				$msg = 'Photo Category Name  Already Exists.';
				setMessage($msg, "error");
			}else{		
				$sql = "INSERT INTO ".PHOTO_CATEGORYS." (category_name,category_url)values('$category_name','$category_url')";
				$res = $this->inserttoDB($sql);
				$msg = 'Photo Category Added.';
				setMessage($msg, "correct");
			}
		}else{
			$msg = 'Photo Category not added, Please try again with mandatory field.';
			setMessage($msg, "error");
		}
		return $res;
	
	}
	
	function addPhoto($request){ 
		extract($request); 		
		$sqlarray = array();
		$photo_date = date("d-M-Y");
		$photo_category = inText($photo_category);
		$sql = "INSERT INTO ".PHOTO_GALLERYS." (photo_caption, photo_file, photo_category, photo_date) VALUES ";
		if(isset($_FILES['photo_file'])) {	
			for($i=0;$i<count($_FILES['photo_file']['name']);$i++) {
				$file_name = $_FILES['photo_file']['name'][$i];
				$file_type = $_FILES['photo_file']['type'][$i];
				$file_tmp_name = $_FILES['photo_file']['tmp_name'][$i];
				$paths = pathinfo($file_name);
				$ext = $paths['extension'];				
				$time=date("dmyHis").''.$i;
				$file_name = "photo_".$time.".".$ext;
				$target_file_path = "../photo/".$file_name;
				move_uploaded_file($file_tmp_name, $target_file_path);
				$photocaption = inText($photo_caption[$i]);
				if($photocaption){
					$sqlarray[] = "('$photocaption', '$file_name', '$photo_category', '$photo_date')";
					$msg = 'Photo Gallery Added.';
					setMessage($msg, "correct");
				}else{
					$msg = 'Photo Gallery not added, Please try again with mandatory field.';
					setMessage($msg, "error");
				}
			}
		
			if(count($sqlarray)>0) {
				$sqlarray_string = implode(", ",$sqlarray);
				$sql = $sql.$sqlarray_string;
				$res = $this->inserttoDB($sql);
			}
		}	
	}
	function editPhoto($request) {
		extract($request);
		$id = ($_REQUEST['id']);
		$photo_caption = inText($photo_caption);
		$photo_date = date("d-M-Y");
		if( isset($_FILES['photo_file']['name']) && $_FILES['photo_file']['name']!="" ) {
				$notice = "nluo";
				$file_name = $this->upload($_FILES['photo_file'],$notice);
			}
		else {
				$file_name = "";
			}
		if($file_name){
			$s = "select * from ".PHOTO_GALLERYS." WHERE photo_id = $photo_id";
			$res = $this->getData($s);
			$filename =$res['oDATA'][0]['photo_file'];
			@unlink("../photo/".$filename);
			
			$sql = "UPDATE ".PHOTO_GALLERYS." SET photo_caption='$photo_caption',photo_date='$photo_date',photo_file='$file_name' where photo_id='$photo_id'";
			$res = $this->update($sql);
		}else{
			$sql = "UPDATE ".PHOTO_GALLERYS." SET photo_caption='$photo_caption',photo_date='$photo_date' where photo_id='$photo_id'";
			$res = $this->update($sql);
		}
		$msg = 'Photo Updated.';
		setMessage($msg, "correct");
		
	}
	function updateCategory($request) {
		extract($request);
		$id = ($_REQUEST['id']);
		$category_name = inText($category_name);
		$category_url = inText($category_url);
		
		if($category_name !="" and $category_url != "")	{
			$sql = "SELECT * from ".PHOTO_CATEGORYS." where category_name like '$category_name' and category_id!='$category_id'";
			$res = $this->getData($sql);
			if($res['NO_OF_ITEMS']>0) {
				$msg = 'Photo Name Already Exists.';
				setMessage($msg, "error");
			}
			else{
				$sql = "UPDATE ".PHOTO_CATEGORYS." SET category_name='$category_name',category_url='$category_url' where category_id='$id'";
				$res = $this->update($sql);
			}
			$msg = 'Photo Category Updated.';
			setMessage($msg, "correct");
		}else{
			$msg = 'Photo Category not Updated, Please try again with mandatory field.';
			setMessage($msg, "error");
		}
		
	}
	
	// CATEGORY STATUS UPDATION
	function disableStatus($id) {
		$id = inText($id);		
		$sql = "UPDATE ".PHOTO_CATEGORYS." set category_status='0' where category_id='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	function enableStatus($id) {
		$id = inText($id);
		$sql = "UPDATE ".PHOTO_CATEGORYS." set category_status='1' where category_id='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	// PHOTO STATUS UPDATION
	function disableStatusPhoto($id) {
		$id = inText($id);		
		$sql = "UPDATE ".PHOTO_GALLERYS." set photo_status='0' where photo_id='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	function enableStatusPhoto($id) {
		$id = inText($id);
		$sql = "UPDATE ".PHOTO_GALLERYS." set photo_status='1' where photo_id='$id'";
		$res = $this->update($sql);
		if($res['oDATA']==1) {
			$msg="Status Updated Successfully.";
			setMessage($msg, "correct");
		}
	}
	//DELETE CATEGORY
	function deleteCategory($id) {
	
		$s = "SELECT * from ".PHOTO_GALLERYS." WHERE photo_category = $id";
		$res = $this->getData($s);
		$total = $res['NO_OF_ITEMS'];
		for($i=0;$i<$total;$i++){
			$file_name =$res['oDATA'][$i]['photo_file'];
			@unlink("../photo/".$file_name);
		}
		$sql_1 = "DELETE from ".PHOTO_CATEGORYS." WHERE category_id = $id ";
		$res = $this->deleterecord($sql_1);
		
		$sql = "DELETE from ".PHOTO_GALLERYS." WHERE photo_category = $id ";
		$res = $this->deleterecord($sql);
		
		$msg="Category deleted Successfully.";
		setMessage($msg, "correct");
		return $res;
	}
	//DELETE PHOTO
	function deletePhoto($id) {
		$sql = "DELETE from ".PHOTO_GALLERYS." WHERE photo_id = $id ";
		$s = "SELECT * from ".PHOTO_GALLERYS." WHERE photo_id = $id";
		$res = $this->getData($s);
		$file_name =$res['oDATA'][0]['photo_file'];
		@unlink("../photo/".$file_name);
		$res = $this->deleterecord($sql);
		$msg="Photo deleted Successfully.";
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
			$target_file_path = "../photo/".$target_file_name;
			move_uploaded_file($tempFile, $target_file_path);			
		}
		return $target_file_name;
	}
	
}//END OF CLASS
?>

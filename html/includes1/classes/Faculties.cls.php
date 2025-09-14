<?php
//Faculties.cls.php
class Faculties extends SiteData {
	public $file_type = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/bmp", "application/pdf"); 
	
	function getTotalFacPages() {
		$sql = "SELECT count(*) as total_pages from ".FACULTIES;
		$res = $this->getData($sql);
		return $res['oDATA'][0]['total_pages'];
	}
	function getAllFaculties($page=0,$orderby="f.faculty_name", $order="asc") {
		$sql = "SELECT f.* from ".FACULTIES." f order by $orderby $order limit $page,".PAGE_LIMIT;
		$res = $this->getData($sql);
		return $res;
	}	
	
	function getAllActiveStaff($faculty_type="academic", $orderby="f.faculty_name", $order="asc") {
		$faculty_type = inText($faculty_type);		$orderby = inText($orderby);		$order = inText($order);
		$sql = "SELECT f.* from ".FACULTIES." f where faculty_type='$faculty_type' order by $orderby $order";
		$res = $this->getData($sql);
		return $res;
	}
	function getFaculties($orderby="faculty_name", $order="asc") {
		$sql = "SELECT * from ".FACULTIES." order by $orderby $order";
		$res = $this->getData($sql);
		return $res;
	}
	function getFacultyById($id) {
		$id = (int)$id;
		$sql = "SELECT f.* from ".FACULTIES." f where f.faculty_id='$id'";
		$res = $this->getData($sql);
		return $res;
	}	
	function getFacultyByURL($faculty_url) {
		$faculty_url = inText($faculty_url);
		$sql = "SELECT f.* from ".FACULTIES." f where f.faculty_url='$faculty_url'";
		$res = $this->getData($sql);
		return $res;
	}		
	function addFaculty($request) {
		extract($request);
		$faculty_type = inText($faculty_type);
		$faculty_salutation = inText($faculty_salutation);
		$faculty_name = inText($faculty_name);
		$faculty_url = inText($faculty_url);
		$faculty_designation = inText($faculty_designation);
		$faculty_email = inText($faculty_email);
		$faculty_qualification = inHTML($faculty_qualification);
		$faculty_experience = inHTML($faculty_experience);
		$faculty_membership = inHTML($faculty_membership);
		$faculty_specialization = inHTML($faculty_specialization);
		$faculty_awards = inHTML($faculty_awards);
		
		$faculty_status = 1;		
		
		$sql = "SELECT faculty_url from ".FACULTIES." where faculty_url like '$faculty_url'";
		$res = $this->getData($sql);
		if($res['NO_OF_ITEMS']>0) {
			$msg = 'Faculty URL Already Exists.';
			setMessage($msg, "error");
		}
		else {
			if( isset($_FILES['faculty_photo']['name']) && $_FILES['faculty_photo']['name']!="" ) {
				$faculty_photo = $this->upload($_FILES['faculty_photo'],$faculty_url);
			}
			else {
				$faculty_photo = "";
			}							
			$sql = "INSERT INTO ".FACULTIES." (faculty_id, faculty_type, faculty_salutation, faculty_name, faculty_url, faculty_designation, faculty_email, faculty_photo, faculty_qualification, faculty_experience, faculty_membership, faculty_specialization, faculty_awards, faculty_status) VALUES (
			null, '$faculty_type', '$faculty_salutation', '$faculty_name', '$faculty_url', '$faculty_designation', '$faculty_email', '$faculty_photo', '$faculty_qualification', '$faculty_experience', '$faculty_membership', '$faculty_specialization', '$faculty_awards', '$faculty_status')";
			$res = $this->inserttoDB($sql);			
			$msg = 'New Faculty Added.';
			setMessage($msg, "correct");
		}
	}
	function editFaculty($request) {
		extract($request);
		$faculty_id = (int)($faculty_id);
		$faculty_type = inText($faculty_type);
		$faculty_salutation = inText($faculty_salutation);
		$faculty_name = inText($faculty_name);
		$faculty_url = inText($faculty_url);
		$faculty_designation = inText($faculty_designation);
		$faculty_email = inText($faculty_email);
		$faculty_qualification = inHTML($faculty_qualification);
		$faculty_experience = inHTML($faculty_experience);
		$faculty_membership = inHTML($faculty_membership);
		$faculty_specialization = inHTML($faculty_specialization);
		$faculty_awards = inHTML($faculty_awards);
		$sql = "SELECT faculty_url from ".FACULTIES." where faculty_url like '$faculty_url' and faculty_id!='$faculty_id'";
		$res = $this->getData($sql);
		if($res['NO_OF_ITEMS']>0) {
			$msg = 'Faculty URL Already Exists.';
			setMessage($msg, "error");
		}
		else {
			if( isset($_FILES['faculty_photo']['name']) && $_FILES['faculty_photo']['name']!="" ) {
				$faculty_photo = $this->upload($_FILES['faculty_photo'],$faculty_url);
			}
			else {
				$faculty_photo = "";
			}
			if($faculty_photo){			
				$sql = "UPDATE ".FACULTIES." set faculty_type='$faculty_type', faculty_salutation='$faculty_salutation', faculty_name='$faculty_name', faculty_url='$faculty_url', faculty_designation='$faculty_designation', faculty_email='$faculty_email', faculty_photo='$faculty_photo', faculty_qualification='$faculty_qualification', faculty_experience='$faculty_experience', faculty_membership='$faculty_membership', faculty_awards='$faculty_awards', faculty_specialization='$faculty_specialization' where faculty_id='$faculty_id'";
			}else{
				$sql = "UPDATE ".FACULTIES." set faculty_type='$faculty_type', faculty_salutation='$faculty_salutation', faculty_name='$faculty_name', faculty_url='$faculty_url', faculty_designation='$faculty_designation', faculty_email='$faculty_email', faculty_qualification='$faculty_qualification', faculty_experience='$faculty_experience', faculty_membership='$faculty_membership', faculty_awards='$faculty_awards', faculty_specialization='$faculty_specialization' where faculty_id='$faculty_id'";
			}
			$res = $this->update($sql);	
			$msg = 'Faculty Updated.';
			setMessage($msg, "correct");
		}
	}
	function deleteFaculty($faculty_id) {
		$faculty_id = (int)($faculty_id);
		$sql = "SELECT faculty_photo from ".FACULTIES." where faculty_id ='$faculty_id'";
		$res = $this->getData($sql);
		$faculty_photo = $res['oDATA'][0]['faculty_photo'];
		@unlink("../fdocs/".$faculty_photo);		
		$sql_3 = "DELETE from ".FACULTIES." where faculty_id='$faculty_id'";
		$res_3 = $this->deleterecord($sql_3);		
		$msg = 'Faculty Deleted.';			
		setMessage($msg, "correct");
	}
	function upload($files, $t_name) {
		$target_file_name = "";
		$file_type = $this->file_type; // access the public varible
		if( in_array($files["type"], $file_type) )	{
			$photo_name = $files["name"];
			$paths = pathinfo($photo_name);
			$ext = $paths['extension']; $fname = $paths['filename'];
			$tempFile = $files["tmp_name"];
			$target_file_name = $t_name.".".$ext;
			$target_file_path = "../fdocs/".$target_file_name;
			move_uploaded_file($tempFile, $target_file_path);			
		}
		return $target_file_name;
	}
}
?>
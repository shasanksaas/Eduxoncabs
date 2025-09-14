<?php
//Pages.cls.php
class Pages extends SiteData {
	function getTotalPages() {
		$sql = "SELECT count(*) as total_pages from ".PAGES;
		$res = $this->getData($sql);
		return $res['oDATA'][0]['total_pages'];
	}
	function getAllPages($page=0, $orderby="page_id", $order="desc") {
		if($orderby=="page_updated") {
			$orderby = "date_sort";
			$sql = "SELECT *, STR_TO_DATE( page_updated, '%Y-%m-%d %H:%i' ) AS date_sort from ".PAGES." order by $orderby $order limit $page,".PAGE_LIMIT;			
		}
		else {
			$sql = "SELECT * from ".PAGES." order by $orderby $order limit $page,".PAGE_LIMIT;
		}
		$res = $this->getData($sql);
		return $res;
	}
	function getPageByUrl($page_url) {
		$page_url = cleanInput($page_url);
		$sql = "SELECT a.*,b.* from ".PAGES." a LEFT OUTER JOIN ".PAGE_CONTENTS." b ON  b.page_id=a.page_id where page_url='$page_url'";
		$res = $this->getData($sql);
		return $res;
	}
	function getPageById($page_id) {
		$page_id = (int)$page_id;
		$sql = "SELECT p.*, pc.* from ".PAGES." p, ".PAGE_CONTENTS." pc where p.page_id='$page_id' and p.page_id=pc.page_id";
		$res = $this->getData($sql);
		return $res;
	}
	function getPageNames($page_id=0) {
		if($page_id==0) {
			$sql = "SELECT page_id,page_name from ".PAGES." order by page_name asc";
		}
		else {
			$sql = "SELECT page_id,page_name from ".PAGES." where page_id='$page_id'";
		}
		$res = $this->getData($sql);
		return $res;
	}
	function getPageDetailsByFileName($page_fname) {
		$page_fname = addslashes($page_fname);
		$sql = "SELECT * from iit_pages where page_file_name='$page_fname'";
		$res = $this->getData($sql);
		return $res;
	}
	function getAssociatePages() {
		$sql = "SELECT * from iit_associate_pages order by page_name asc";
		$res = $this->getData($sql);
		return $res;
	}	
	function getPageFileByID($page_id) {
		$page_id = (int)$page_id;
		$sql = "SELECT page_file_name from iit_pages where page_id='$page_id'";
		$res = $this->getData($sql);
		if($res['NO_OF_ITEMS']>0 && $res['oDATA'][0]['page_file_name']!="") {
			return stripslashes($res['oDATA'][0]['page_file_name']).".php";
		}
		else {
			return false;
		}
	}
	function addPage($request){
		extract($request);
		$page_updated = date("Y-m-d H:i");
		$page_name = inText($page_name);
		$page_url = inText($page_url);
		$page_type = inText($page_type);
		$page_title = inText($page_title);
		$page_metakeywords = inText($page_metakeywords);
		$page_metadesc = inText($page_metadesc);
		if($page_type=="static") {
			$page_contents = inHTML($page_content_static);
		}
		else {
			$page_contents = inHTML($page_content_dynamic);
		}
		$sql = "SELECT page_url from ".PAGES." where page_url like '$page_url'";
		$res = $this->getData($sql);
		if($res['NO_OF_ITEMS']>0) {
			$msg = 'Page URL Already Exists.';
			setMessage($msg, "error");
			$_SESSION[SES]['pagedata'] = $request;
		}
		else {		
			$sql = "INSERT INTO ".PAGES." (page_id, page_name, page_url, page_type, page_updated) VALUES (NULL, '$page_name', '$page_url', '$page_type', '$page_updated')";
			$res = $this->inserttoDB($sql);
			$page_id = (int)$res['oDATA'];
			$sql = "INSERT INTO ".PAGE_CONTENTS." (page_id, page_title, page_metakeywords, page_metadesc, page_contents)
				VALUES ('$page_id', '$page_title', '$page_metakeywords', '$page_metadesc', '$page_contents')";	
			$res = $this->inserttoDB($sql);		
			$msg = 'New Page Added.';
			setMessage($msg, "correct");
		}
	}
	function editPage($request){
		extract($request);
		$page_updated = date("Y-m-d H:i");
		$page_id = (int)($page_id);
		$page_name = inText($page_name);
		$page_url = inText($page_url);
		$page_type = inText($page_type);
		$page_title = inText($page_title);
		$page_metakeywords = inText($page_metakeywords);
		$page_metadesc = inText($page_metadesc);
		if($page_type=="static") {
			$page_contents = inHTML($page_content_static);
		}
		else {
			$page_contents = inHTML($page_content_dynamic);
		}
		$sql = "SELECT page_url from ".PAGES." where page_url like '$page_url' and page_id != '$page_id'";
		$res = $this->getData($sql);
		if($res['NO_OF_ITEMS']>0) {
			$msg = 'Page URL Already Exists.';
			setMessage($msg, "error");
			$_SESSION[SES]['pagedata'] = $request;
		}
		else {
			$sql = "UPDATE ".PAGES." set page_name='$page_name', page_url='$page_url', page_type='$page_type', page_updated='$page_updated' where page_id='$page_id'";
			$res = $this->update($sql);
			$sql = "UPDATE ".PAGE_CONTENTS." set page_title='$page_title', page_metakeywords='$page_metakeywords', page_metadesc='$page_metadesc', page_contents='$page_contents' where page_id='$page_id'";
			$res = $this->update($sql);			
			$msg = 'Page Updated Successfully.';			
			setMessage($msg, "correct");
		}
	}
	function deletePage($page_id) {
		$page_id = (int)($page_id);		
		$sql = "DELETE from ".PAGES." where page_id='$page_id'";
		$res = $this->deleterecord($sql);
		$sql = "DELETE from ".PAGE_CONTENTS." where page_id='$page_id'";
		$res = $this->deleterecord($sql);		
		$msg = 'Page Deleted.';			
		setMessage($msg, "correct");
	}
}
?>
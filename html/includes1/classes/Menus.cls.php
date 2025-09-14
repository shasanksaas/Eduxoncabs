<?php
class Menus extends SiteData {	
	function showParent($menu_pid, $ar) {
		$sql= "SELECT * from ".MENU." where menu_id='$menu_pid'";
		$res = $this->getData($sql);
		if($res['NO_OF_ITEMS']>0) {	
			$data = $res['oDATA'][0];
			$menu_id = outText($data['menu_id']);
			$menu_pid = outText($data['menu_pid']);
			$menu_name = outText($data['menu_name']);
			$menu_url = outText($data['menu_url']);
			$ar[] = $menu_url;
			return $this->showParent($menu_pid, $ar);
		}else {
			return $ar;
		}
	}
	function getCompleteURL($menu_id) {
		$sql= "SELECT * from ".MENU." where menu_id='$menu_id'";
		$res = $this->getData($sql);
		$data = $res['oDATA'][0];
		$menu_id = outText($data['menu_id']);
		$menu_pid = outText($data['menu_pid']);
		$menu_name = outText($data['menu_name']);
		$menu_url = outText($data['menu_url']);
		$CompleteURL = array($menu_url);
		$URL  = $this->showParent($menu_pid,$CompleteURL);
		return $URL;
	}
	function showChild($menu_id) {
		$sql= "SELECT * from ".MENU." where menu_pid='$menu_id' order by menu_position asc, menu_name asc";
		$res = $this->getData($sql);
		if($res['NO_OF_ITEMS']>0) {	
			echo '<ul>';
			for($i=0;$i<$res['NO_OF_ITEMS'];$i++) {
				$data = $res['oDATA'][$i];
				$menu_id = outText($data['menu_id']);
				$menu_name = outText($data['menu_name']);
				$menu_page = outText($data['menu_page']);
				$menu_target = outText($data['menu_target']);
				if(is_numeric($menu_page)) {
					$sql_1 = "SELECT a.page_url from ".PAGES." a where a.page_id='$menu_page'";
					$res_1 = $this->getData($sql_1);
					if($res_1['NO_OF_ITEMS']>0){		
						$url = getPageUrl(outText($res_1['oDATA'][0]['page_url']));
					}else{
						 $url = "javascript: void(0)";
					}
				}
				else {		
					$url = 	$menu_page;
				}
				$abcd = '<a href="'.$url.'"/>'.$menu_name.'</a>';
				if($menu_target) {
					$abcd = '<a href="'.$url.'" target="_blank"/>'.$menu_name.'</a>';					
				}				
				$menu_status = outText($data['menu_status']);
				if($menu_status=="1") {				
					echo '<li>'.$abcd;
					$this->showChild($menu_id);
					echo "</li>";
				}			
			}
			echo "</ul>";
		}
	}
	
	function getMenuTree() {
		$sql= "SELECT * from ".MENU." where menu_pid=0 order by menu_position asc, menu_name asc";
		$res = $this->getData($sql);
		echo '<ul class="sf-menu" id="menu">';
		for($i=0;$i<$res['NO_OF_ITEMS'];$i++) {
			$data = $res['oDATA'][$i];
			$menu_id = outText($data['menu_id']);
			$menu_name = outText($data['menu_name']);
			$menu_page = outText($data['menu_page']);
			$menu_target = outText($data['menu_target']);
			if(is_numeric($menu_page)) {
				$sql_1 = "SELECT a.page_url,a.page_name from ".PAGES." a where a.page_id='$menu_page'";
				$res_1 = $this->getData($sql_1);
				if($res_1['NO_OF_ITEMS']>0)		
					$url =getPageUrl(outText($res_1['oDATA'][0]['page_url']));
				else $url = "javascript: void(0)";
			}
			else {		
				$url = 	$menu_page;
			}			
			$abcd = '<a href="'.$url.'"/>'.$menu_name.'</a>';
			if($menu_target) {
				$abcd = '<a href="'.$url.'" target="_blank"/>'.$menu_name.'</a>';					
			}
			$menu_status = outText($data['menu_status']);
			if($menu_status=="1") {
				echo '<li>'.$abcd;
				$this->showChild($menu_id);
				echo "</li>";
			}
		}
		echo "</ul></div>";
	}	
	
	function getTotalMenu($menu_pid=0) {
		$menu_pid = (int)$menu_pid;
		$sql = "SELECT count(*) as total from ".MENU." m where menu_pid='$menu_pid'";
		$res = $this->getData($sql);		
		return $res['oDATA'][0]['total'];
	}
	function getMenu($menu_pid=0, $page=0, $orderby="m.menu_id", $order="desc") {
		$menu_pid = (int)$menu_pid;
		$sql = "SELECT m.* from ".MENU." m where m.menu_pid='$menu_pid' order by $orderby $order limit $page,".PAGE_LIMIT;
		$res = $this->getData($sql);
		return $res;
	}
	function getMenuDetails($menu_id) {
		$sql = "SELECT m.*,p.page_name,p.page_id from ".MENU." m LEFT JOIN ".PAGES." p ON m.menu_page=p.page_id where m.menu_id=$menu_id and m.menu_status='1'";
		$res = $this->getData($sql);
		return $res;
	}
	function getMenuName($menu_id) {
		$menu_id = (int)$menu_id;	
		$sql = "SELECT m.menu_name from ".MENU." m where m.menu_id='$menu_id'";
		$res = $this->getData($sql);
		return $res['oDATA'][0]['menu_name'];
	}
	function getSubMenuDetails($menu_pid) {
		$sql = "SELECT m.*,p.page_name,p.page_id,p.page_url from ".MENU." m LEFT JOIN ".PAGES." p ON m.menu_page=p.page_id where m.menu_pid=$menu_pid and m.menu_status='1' order by m.menu_position,m.menu_name Asc";
		$res = $this->getData($sql);
		return $res;
	}	
	function getParentMenuURL($menu_id) {
		$sql = "SELECT m.menu_url from ".MENU." m where m.menu_id = (SELECT m.menu_pid from ".MENU." m where m.menu_id='$menu_id')";
		$res = $this->getData($sql);
		return $res;
	}
	function getParentMenuID($mid) {
		$menu_pid = (int)$mid;
		$sql = "SELECT menu_pid from ".MENU." where menu_id='$menu_pid'";
		$res = $this->getData($sql);
		return $res['oDATA'][0]['menu_pid'];
	}
	function getParentMenuName($mid) {
		$menu_pid = (int)$mid;
		$sql = "SELECT menu_name from ".MENU." where menu_pid='$menu_pid'";
		$res = $this->getData($sql);
		return $res['oDATA'][0]['menu_name'];
	}	
	function addMenu($request) {
		$menu_pid = (int)$request['menu_pid'];
		$menu_name = inText($request['menu_name']);
		$menu_position = (int)$request['menu_position'];
		$menu_target = inText($request['menu_target']);
		if($request['menu_link']!="") {
			$menu_page = inText($request['menu_link']);
		}
		else{
			$menu_page= inText($request['menu_page_id']);
		}		
		$sql = "INSERT INTO ".MENU." (menu_id, menu_pid, menu_name, menu_position, menu_page, menu_target, menu_status) VALUES (NULL, '$menu_pid', '$menu_name',  '$menu_position', '$menu_page', '$menu_target', '1')";
		$res = $this->inserttoDB($sql);
		$msg = 'New Menu Added.';
		setMessage($msg, "correct");
	}
	function updateMenu($request) {
		$menu_id = (int)$request['menu_id'];
		$menu_pid = (int)$request['menu_pid'];
		$menu_name = inText($request['menu_name']);
		$menu_position = (int)$request['menu_position'];
		$menu_target = inText($request['menu_target']);
		if($request['menu_link']!="") {
			$menu_page = inText($request['menu_link']);
		}
		else{
			$menu_page= inText($request['menu_page_id']);
		}
		$sql = "UPDATE ".MENU." set menu_name='$menu_name', menu_position=$menu_position, menu_page='$menu_page', menu_target='$menu_target' where menu_id='$menu_id'";
		$res = $this->update($sql);
		$msg = 'Menu Updated.';
		setMessage($msg, "correct");
	}
	function deleteMenu($menu_id) {
		$menu_id = (int)$menu_id;
		if($menu_id) {
			$sql = "DELETE from ".MENU." where menu_id='$menu_id'";
			$res = $this->deleterecord($sql);
			$msg = 'Menu Deleted.';
			setMessage($msg, "correct");
		}
	}
}
?>
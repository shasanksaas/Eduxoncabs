<?php
//MenuAction.php
session_start();
require_once("../includes/settings.php");
require_once("../includes/database.php");
require_once("../includes/classes/db.cls.php");
require_once("../includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("../includes/classes/News.cls.php");

loginValidate();
$db = new SiteData();
$newsObj = new News();

$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$ext = array("html", "htm", "php");
define("ROOT_PATH","./");
$location = "news.php";
switch($act) {
	case "addnews": {
		$newsObj->addNews($_REQUEST);
		$location = "news.php";
	}break;
		
	case "updatenews": {
		$newsObj->updateNews($_REQUEST);
		$location = "news.php";
	}break;
	
	case "del": {
		$id = (int)$_REQUEST['id'];
		$newsObj->deleteNews($id);
		$location = "news.php";
	}break;
	case "disable":{		
		$respond = $newsObj->disableStatus($_REQUEST['id']);
		header("location:".$location);
	}break;
	case "enable":{		
		$respond = $newsObj->enableStatus($_REQUEST['id']);
		header("location:".$location);
	}break;
	case "sort_order": {				
			if(isset($_REQUEST['sortorder'])) {			
				foreach($_REQUEST['sortorder'] as $k=>$v) {
					$x = substr($k,1,strlen($k));
					$aid = (int)$x;
					$sql = "UPDATE ".NEWS." set sort_order=$v where id=$aid";					
					$db->update($sql);
				}				
			}header("location:".$location);
	}break;
	default : break;
}
redirect ($location);
?>
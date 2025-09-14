<?php
//PageAction.php
session_start();
require_once("../includes/settings.php");
require_once("../includes/database.php");
require_once("../includes/classes/db.cls.php");
require_once("../includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("../includes/classes/Pages.cls.php");
loginValidate();
$db = new SiteData();
$pageObj = new Pages();
$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
$location = "page-management.php";
switch($act) {
	case "addpage": {
		$respond = $pageObj->addPage($_REQUEST);
		redirect ($location."?q=add");
	}break;
	
	case "editpage": {
		$respond = $pageObj->editPage($_REQUEST);
		$page = $_REQUEST['page'];
		redirect ($location."?q=edit&pid=".$_REQUEST['page_id'].'&page='.$page);
	}break;
	
	case "delpage": {
		$respond = $pageObj->editPage($_REQUEST);
		$page_id = inText($_GET['pid']);		
		$pageObj->deletePage($page_id);
		$page = $_REQUEST['page'];
		redirect ($location.'?page='.$page);
	}break;	
	default :redirect ($location); break;
}
?>
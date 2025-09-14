<?php
//LoginAction.php
session_start();
require_once("../includes/settings.php");
require_once("../includes/database.php");
require_once("../includes/classes/db.cls.php");
require_once("../includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("../includes/classes/Admin.cls.php");
$db = new SiteData();
$adminObj = new Admin();

$action = $_REQUEST['act'];
$location = $_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:"index.php";
switch($action){
	case "login":{		
	  // echo $_REQUEST;
		$respond = $adminObj->checkLogin($_REQUEST);
		if($respond == 1) {
			$location = "index.php";
		}
		else{
			$location = "login.php";
		}
	}break;
	
	default: break; 
}
redirect ($location);
exit;
?>
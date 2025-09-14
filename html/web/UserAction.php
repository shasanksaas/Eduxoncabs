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
$location = "signup.php";
//echo $action;
$adminObj = new admin();
switch($action){		
	case "add_user":{		
		$respond = $adminObj->addUser($_REQUEST);
	}break;
	
	default: 
		header("location:".$location);
	break; 
}
redirect ($location);
?>

<?php
//LoginAction.php
session_start();
require_once("../includes/settings.php");
require_once("../includes/database.php");
require_once("../includes/classes/db.cls.php");
require_once("../includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("../includes/classes/DBquery.cls.php");
$db = new SiteData();
$dbObj = new dbquery();
loginValidate();
$action = $_REQUEST['act'];
$location = "book.php";
//echo $action;
switch($action){		
		
	
	case "deletecon":{		
		$id = filter($_REQUEST['id']);
		$respond = $respond = $dbObj->delete("tbl_order","id = $id");
		if($respond){
			setMessage("Record Deleted Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;		
	
	
	default: 
		header("location:".$location);
	break; 
}
redirect ($location);
?>

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
$location = "blockdl.php";
//echo $action;
switch($action){		
	case "blockDL":{
	    $dlnumber 	 = filter($_REQUEST['txtDLnumber']);
	    $respond = $dbObj->insertToDblastId("blocked_dl","dl_number= '$dlnumber'");
		
		
		if($respond == 1){
			setMessage("Record Added Successfully","alert alert-success");
		}
	}break;
	
	case "deletedl":{		
		$id = filter($_REQUEST['id']);
		$respond = $dbObj->delete("blocked_dl","id = $id");
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

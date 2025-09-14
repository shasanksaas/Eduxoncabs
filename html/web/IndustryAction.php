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
$location = "industry.php";
//echo $action;
switch($action){		
	case "addind":{	
		$industry 	 = filter($_REQUEST['industry']);
		$date 	 = date("Y-m-d");	
		$respond = $dbObj->insertToDb("tbl_industry","industry = '$industry', entry_date = '$date', status = 1");
		if($respond == 1){
			setMessage("Record Added Successfully","alert alert-success");
		}
	}break;
	
	
	case "updind":{		
		$industry 	 = filter($_REQUEST['industry']);
		$date 	 = date("Y-m-d");	
		$id		 = filter($_REQUEST['id']);
		$respond = $dbObj->updateToDb("tbl_industry","industry = '$industry', entry_date = '$date', status = 1","id = $id");
		if($respond == 1){
			setMessage("Record Updated Successfully","alert alert-success");
		}
	}break;
	
	
	case "deleteind":{		
		$id = filter($_REQUEST['id']);
		$respond = $respond = $dbObj->delete("tbl_industry","id = $id");
		if($respond){
			setMessage("Record Deleted Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;		
	
	case "disable":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("tbl_industry","status = 0","id = $id");
		if($respond){
			setMessage("Record Disabled Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;
	
	case "enable":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("tbl_industry","status = 1","id = $id");
		if($respond){
			setMessage("Record Enabled Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;
	
	
	default: 
		header("location:".$location);
	break; 
}
redirect ($location);
?>

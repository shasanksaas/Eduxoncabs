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

$mysqli_conn = $db->getConnection();
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}
loginValidate();
$action = $_REQUEST['act'];
$location = "admin-manager.php";
//echo $action;
$adminObj = new admin();
switch($action){		
	case "addadmin":{		
		$respond = $adminObj->addAdmin($_REQUEST);
	}break;
	case "editadmin":{		
		$respond = $adminObj->editAdmin($_REQUEST);
		$location .= "?q=edit&id=".$_REQUEST['id'];
	}break;
	
	case "changeadminpass":{		
		$respond = $adminObj->changeAdminPass($_REQUEST);
	}break;
	
	
	case "deleteadmin":{		
		$respond = $adminObj->deleteAdmin($_REQUEST['id']);
		header("location:".$location);
	}break;		
	
	case "disable":{		
		$respond = $adminObj->disableStatus($_REQUEST['id']);
		header("location:".$location);
	}break;
	case "enable":{		
		$respond = $adminObj->enableStatus($_REQUEST['id']);
		header("location:".$location);
	}break;
	case "changeadminprofile":{	
		$location = "my-account.php";
		$respond = $adminObj->changeadminprofile($_REQUEST);
		header("location:".$location);
	}break;
	case "changepass":{	
		$location = "my-account.php";	
		$respond = $adminObj->changeAdminPass($_REQUEST);
		header("location:".$location);
	}break;
	
	default: 
		header("location:".$location);
	break; 
}
redirect ($location);
?>

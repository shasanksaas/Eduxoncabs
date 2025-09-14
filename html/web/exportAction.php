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
$location = "export-contact.php";
//echo $action;
switch($action){		
		
	
	case "getContact":{		
		$city = filter($_REQUEST['city']);
		//$respond = $dbObj->fetch_data("tbl_order","city = '$city'");
		//echo "<pre>";print_r($respond);exit;
		$filename = "contact-export.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Email','Phone');
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		$respond = "SELECT buyer_name, email, phone FROM tbl_order WHERE city = '$city'";
		$result = mysql_query($respond);
		while($row = mysql_fetch_row($result)) {
			fputcsv($fp, $row);
		}
		exit;
		header("location:".$location);
	}break;		
	
	
	default: 
		header("location:".$location);
	break; 
}
redirect ($location);
?>

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
$location = "coupon.php";
//echo $action;
switch($action){		
	case "addcoupon":{	
		$coupon 	 = filter($_POST['coupon']);
                $couponpercent 	 = filter($_POST['couponpercent']);
		$fromdate= filter($_POST['fromdate']);
		$todate= filter($_POST['todate']);
		$issuedate= filter($_POST['issuedate']);
		$expdate= filter($_POST['expdate']);

			
		$respond = $dbObj->insertToDblastId("master_gv","gv_code= '$coupon', gv_amount= '0', from_date='$fromdate', to_date= '$todate', issue_date= '$issuedate', expiry_date = '$expdate', status=1, gv_percent='$couponpercent'");
		
		
		if($respond == 1){
			setMessage("Record Added Successfully","alert alert-success");
		}
	}break;
	
	
	case "editcoupon":{		
		$id = filter($_POST['id']);
                $coupon 	 = filter($_POST['coupon']);
$couponpercent 	 = filter($_POST['couponpercent']);
		$fromdate= filter($_POST['fromdate']);
		$todate= filter($_POST['todate']);
		$issuedate= filter($_POST['issuedate']);
		$expdate= filter($_POST['expdate']);
		
			$respond = $dbObj->updateToDb("master_gv","gv_code= '$coupon', gv_percent='$couponpercent',from_date='$fromdate', to_date= '$todate', issue_date= '$issuedate', expiry_date = '$expdate', status=1","id = $id");
			
		if($respond == 1){
			setMessage("Record Updated Successfully","alert alert-success");
		}
	}break;
	
	
	case "deletecoupon":{		
		$id = filter($_REQUEST['id']);
		
		$respond = $dbObj->delete("master_gv","id = $id");
		if($respond){
			setMessage("Record Deleted Successfully","alert alert-success");
		}
		
	}break;		
	
	case "disable":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("master_gv","status = 0","id = $id");
		if($respond){
			setMessage("Record Disabled Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;
	
	case "enable":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("master_gv","status = 1","id = $id");
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

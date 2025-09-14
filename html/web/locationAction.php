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
$location = "location.php";
//echo $action;
switch($action){		
	case "addlocation":{	
		$city 	 = filter($_POST['city']);
		$pick_point= filter($_POST['pick_point']);
		$drop_point= filter($_POST['drop_point']);

                $getdta = $dbObj->fetch_data("tbl_city","id='$city'");
                $city_location = $getdta [0]["city"];
			
		$respond = $dbObj->insertToDblastId("location","city_id= '$city',city_location='$city_location', pickup_point= '$pick_point', drop_point= '$drop_point', status = 1");
		
	
		
		
		if($respond == 1){
			setMessage("Record Added Successfully","alert alert-success");
		}
	}break;
	
	
	case "updlocation":{		
		$id = filter($_POST['id']);
                $city 	 = filter($_POST['city']);
		$pick_point= filter($_POST['pick_point']);
		$drop_point= filter($_POST['drop_point']);

                $getdta = $dbObj->fetch_data("tbl_city","id='$city'");
                $city_location = $getdta [0]["city"];
		
			$respond = $dbObj->updateToDb("location","city_id= '$city',city_location='$city_location', pickup_point= '$pick_point', drop_point= '$drop_point', status = 1","id = $id");
			
		if($respond == 1){
			setMessage("Record Updated Successfully","alert alert-success");
		}
	}break;
	
	
	case "deletelocation":{		
		$id = filter($_REQUEST['id']);
		$getimg = $dbObj->fetch_data("location","id = $id");
		$respond = $dbObj->delete("location","id = $id");
		if($respond){
			setMessage("Record Deleted Successfully","alert alert-success");
		}
		
	}break;		
	
	case "disable":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("location","status = 0","id = $id");
		if($respond){
			setMessage("Record Disabled Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;
	
	case "enable":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("location","status = 1","id = $id");
		if($respond){
			setMessage("Record Enabled Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;

        case "addcity":{	
		$city 	 = filter($_POST['city']);
		
			
		$respond = $dbObj->insertToDblastId("tbl_city","city= '$city',status = 1");

		if($respond == 1){
			setMessage("Record Added Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;

        case "editcity":{	
		$id = filter($_POST['id']);
                $city 	 = filter($_POST['city']);
		
		
			$respond = $dbObj->updateToDb("tbl_city","city= '$city',status = 1","id = $id");
			
		if($respond == 1){
			setMessage("Record Updated Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;
        case "deletecity":{		
		$id = filter($_REQUEST['id']);
		$getimg = $dbObj->fetch_data("tbl_city","id = $id");
		$respond = $dbObj->delete("tbl_city","id = $id");
		if($respond){
			setMessage("City Deleted Successfully","alert alert-success");
		}
		
	}break;		
	
	case "disablecity":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("tbl_city","status = 0","id = $id");
		if($respond){
			setMessage("City Disabled Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;
	
	case "enablecity":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("tbl_city","status = 1","id = $id");
		if($respond){
			setMessage("Record Enabled Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;
	
	case "editminHour":{		
		$minHour = filter($_POST['minHour']);
		$respond = $dbObj->updateToDb("tbl_min_hour","hours= '$minHour' ","id=1");
		
		if($respond == 1){
			setMessage("Record Updated Successfully","alert alert-success");
			$location = "minhour.php";
		}
	}break;
	
	
	default: 
		header("location:".$location);
	break; 
}
redirect ($location);
?>

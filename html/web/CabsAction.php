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
$location = "cabs.php";
//echo $action;
switch($action){		
	case "addcab":{	
		$city 	 = filter($_POST['city']);
		$car_nme 	 = filter($_REQUEST['car_nme']);
		$cost		 = filter($_REQUEST['cost']);
		$weekendcost	=filter($_REQUEST['weekendcost']);
		$offers = filter($_POST['car_ofr']);
		$car_desc	 = $_REQUEST['car_desc'];
		$unavail_datefrm = $_POST['unavail_datefrm'];
		$unavail_dateto = $_POST['unavail_dateto'];
		$unavail_tmfrm	= $_POST['ptime'];
		$unavail_tmto	= $_POST['dtime'];
		$pickup  = filter($_REQUEST['pickup']);
		//echo count($unavail_datefrm);exit;
		$allowed 	 =  array('jpg','JPEG' ,'png','PNG');
		$car_image 	 = $_FILES['car_image']['name'];
		$car_image_temp = $_FILES['car_image']['tmp_name'];
		$check = pathinfo($car_image, PATHINFO_EXTENSION);
			if(!in_array($check,$allowed) ) {
				die("Sorry !!! upload an Image file");
			} else {
				$temp = explode(".", $car_image);
				$newfilename =  "cab".round(microtime(true)) . '.' . end($temp);
				move_uploaded_file($car_image_temp,"../uploadedDocument/cab/".$newfilename);
			}		
		$no_of_seat  = filter($_REQUEST['no_of_seat']);	
		$fuel  		 = filter($_REQUEST['fuel']);
		$security  	 = filter($_REQUEST['security']);
		$date 	 	 = date("Y-m-d");	
		$respond = $dbObj->insertToDblastId("tbl_cabs","car_nme = '$car_nme', car_image = '$newfilename', car_desc = '$car_desc', cost = '$cost', weekend_cost ='$weekendcost', unavail_datefrm = '1000-01-01', unavail_tmfrm = '00:00', unavail_dateto = '1000-01-01', unavail_tmto = '00:00', no_of_seat = '$no_of_seat', fuel = '$fuel', security = '$security', pickup = '$pickup', created_dte = '$date',city = '$city', offers='$offers', status = 1");
		
		/*for($j=0; $j<count(array_filter($unavail_datefrm));$j++){
			$dbObj->insertToDb("tbl_unavail_dtes","car_id = '$respond', unavail_dte = '$unavail_datefrm[$j]', unavail_tme = '$unavail_tmfrm[$j]', unavail_dte_to = '$unavail_dateto[$j]', unavail_to_tme = '$unavail_tmto[$j]'");
		}*/
		for($j=0; $j<count(array_filter($unavail_datefrm));$j++){
				$dbObj->insertToDb("tbl_unavail_dtes","type = '0', car_id = '$respond', bike_id = '0', unavail_dte = '$unavail_datefrm[$j] $unavail_tmfrm[$j]', unavail_dte_to = '$unavail_dateto[$j] $unavail_tmto[$j]', status = '0', payment_id = ''");
			}
		
		
		if($respond == 1){
			setMessage("Record Added Successfully","alert alert-success");
		}
	}break;
	
	
	case "updcab":{		
		$id			 = filter($_REQUEST['id']);
		$car_nme 	 = filter($_REQUEST['car_nme']);
		$city 	 = filter($_POST['city']);
		$offers = filter($_POST['car_ofr']);
		$cost		 = filter($_REQUEST['cost']);
		$weekendcost	=filter($_REQUEST['weekendcost']);
		$car_desc	 = $_REQUEST['car_desc'];
		$hdnimg		 = filter($_REQUEST['hdnimg']);
		$unavail_datefrm = $_POST['unavail_datefrm'];
		$unavail_dateto = $_POST['unavail_dateto'];
		$unavail_tmfrm	= $_POST['ptime'];
		$unavail_tmto	= $_POST['dtime'];
		
		$pickup  = filter($_REQUEST['pickup']);
		$allowed 	 =  array('jpg','JPEG' ,'png','PNG');
		$car_image 	 = $_FILES['car_image']['name'];
		$car_image_temp = $_FILES['car_image']['tmp_name'];
		if($car_image != ""){
		$check = pathinfo($car_image, PATHINFO_EXTENSION);
			if(!in_array($check,$allowed) ) {
				die("Sorry !!! upload an Image file");
			} else {
				$temp = explode(".", $car_image);
				$newfilename =  "cab".round(microtime(true)) . '.' . end($temp);
			}
		}
		$no_of_seat  = filter($_REQUEST['no_of_seat']);	
		$fuel  		 = filter($_REQUEST['fuel']);
		$security  	 = filter($_REQUEST['security']);
		$date 	 	 = date("Y-m-d");	
		if(move_uploaded_file($car_image_temp,"../uploadedDocument/cab/".$newfilename)){
		unlink("../uploadedDocument/cab/".$hdnimg);
			$respond = $dbObj->updateToDb("tbl_cabs","car_nme = '$car_nme', car_image = '$newfilename', car_desc = '$car_desc', cost = '$cost',weekend_cost ='$weekendcost', no_of_seat = '$no_of_seat', fuel = '$fuel', security = '$security', pickup = '$pickup', created_dte = '$date', city = '$city', offers='$offers' , status = 1","id = $id");
			$dbObj->delete("tbl_unavail_dtes","car_id = $id");
			for($j=0; $j<count(array_filter($unavail_datefrm));$j++){
				$dbObj->insertToDb("tbl_unavail_dtes","type = '0', car_id = '$id', bike_id = '0', unavail_dte = '$unavail_datefrm[$j] $unavail_tmfrm[$j]', unavail_dte_to = '$unavail_dateto[$j] $unavail_tmto[$j]', status = '0', payment_id = ''");
			}
			
		}else{
			$respond = $dbObj->updateToDb("tbl_cabs","car_nme = '$car_nme', car_desc = '$car_desc', cost = '$cost', weekend_cost ='$weekendcost', no_of_seat = '$no_of_seat', fuel = '$fuel', security = '$security', pickup = '$pickup', created_dte = '$date', city = '$city', offers='$offers', status = 1","id = $id");
			$dbObj->delete("tbl_unavail_dtes","car_id = $id");
			for($j=0; $j<count(array_filter($unavail_datefrm));$j++){
				$dbObj->insertToDb("tbl_unavail_dtes","type = '0', car_id = '$id', bike_id = '0', unavail_dte = '$unavail_datefrm[$j] $unavail_tmfrm[$j]', unavail_dte_to = '$unavail_dateto[$j] $unavail_tmto[$j]', status = '0', payment_id = ''");
			}
		}
		if($respond == 1){
			setMessage("Record Updated Successfully","alert alert-success");
		}
	}break;
	
	
	case "deletecab":{		
		$id = filter($_REQUEST['id']);
		$getimg = $dbObj->fetch_data("tbl_cabs","id = $id");
		$respond = $dbObj->delete("tbl_cabs","id = $id");
		if($respond){
			setMessage("Record Deleted Successfully","alert alert-success");
		}
		unlink("../uploadedDocument/cab/".$getimg[0]['car_image']);
		header("location:".$location);
	}break;		
	
	case "disable":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("tbl_cabs","status = 0","id = $id");
		if($respond){
			setMessage("Record Disabled Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;
	
	case "enable":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("tbl_cabs","status = 1","id = $id");
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

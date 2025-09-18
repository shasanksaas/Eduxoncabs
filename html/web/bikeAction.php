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


$mysqli_conn = $db->getConnection();
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}

loginValidate();
$action = $_REQUEST['act'];
$location = "bikes.php";
//echo $action;
switch($action){		
	case "addbike":{	
		$city 	 = filter($_POST['city']);
		$bike_nme 	 = filter($_REQUEST['bike_nme']);
		$cost		 = filter($_REQUEST['cost']);
		$weekendcost	=filter($_REQUEST['weekendcost']);
		$offers = filter($_POST['bike_ofr']);
		$bike_desc	 = $_REQUEST['bike_desc'];
		$unavail_datefrm = $_POST['unavail_datefrm'];
		$unavail_dateto = $_POST['unavail_dateto'];
		$unavail_tmfrm	= $_POST['ptime'];
		$unavail_tmto	= $_POST['dtime'];
		$pickup  = filter($_REQUEST['pickup']);
		//echo count($unavail_datefrm);exit;
		$allowed 	 =  array('jpg','JPEG' ,'png','PNG');
		$bike_image 	 = $_FILES['bike_image']['name'];
		$image_temp = $_FILES['bike_image']['tmp_name'];
		$check = pathinfo($bike_image, PATHINFO_EXTENSION);
			if(!in_array($check,$allowed) ) {
				die("Sorry !!! upload an Image file");
			} else {
				$temp = explode(".", $bike_image);
				$newfilename =  "bike".round(microtime(true)) . '.' . end($temp);
				move_uploaded_file($image_temp,"../uploadedDocument/bikes/".$newfilename);
			}		
		$no_of_seat  = filter($_REQUEST['no_of_seat']);	
		$fuel  		 = filter($_REQUEST['fuel']);
		$security  	 = filter($_REQUEST['security']);
		$date 	 	 = date("Y-m-d");	
		
		$respond = $dbObj->insertToDblastId("tbl_bikes","bike_name = '$bike_nme', bike_image = '$newfilename', bike_desc = '$bike_desc', cost = '$cost', weekend_cost ='$weekendcost', unavail_datefrm = '1000-01-01', unavail_tmfrm = '00:00', unavail_dateto = '1000-01-01', unavail_tmto = '00:00', no_of_seat = '$no_of_seat', fuel = '$fuel', security = '$security', pickup = '$pickup', created_dte = '$date',city = '$city', offers='$offers', status = 1");
		//echo $respond; exit;
		/*for($j=0; $j<count(array_filter($unavail_datefrm));$j++){
			$dbObj->insertToDb("tbl_unavail_dtes","car_id = '$respond', unavail_dte = '$unavail_datefrm[$j]', unavail_tme = '$unavail_tmfrm[$j]', unavail_dte_to = '$unavail_dateto[$j]', unavail_to_tme = '$unavail_tmto[$j]'");
		}*/
		for($j=0; $j<count(array_filter($unavail_datefrm));$j++){
				$dbObj->insertToDb("tbl_unavail_dtes","type = '2', car_id = '0', bike_id = '$respond', unavail_dte = '$unavail_datefrm[$j] $unavail_tmfrm[$j]', unavail_dte_to = '$unavail_dateto[$j] $unavail_tmto[$j]', status = '0', payment_id = ''");
			}
		
		
		if($respond == 1){
			setMessage("Record Added Successfully","alert alert-success");
		}
	}break;
	
	
	case "updatebike":{		
		$id			 = filter($_REQUEST['id']);
		$bike_nme 	 = filter($_REQUEST['bike_nme']);
		$city 	 = filter($_POST['city']);
		$offers = filter($_POST['bike_ofr']);
		$cost		 = filter($_REQUEST['cost']);
		$weekendcost	=filter($_REQUEST['weekendcost']);
		$bike_desc	 = $_REQUEST['bike_desc'];
		$hdnimg		 = filter($_REQUEST['hdnimg']);
		$unavail_datefrm = $_POST['unavail_datefrm'];
		$unavail_dateto = $_POST['unavail_dateto'];
		$unavail_tmfrm	= $_POST['ptime'];
		$unavail_tmto	= $_POST['dtime'];
		
		$pickup  = filter($_REQUEST['pickup']);
		$allowed 	 =  array('jpg','JPEG' ,'png','PNG');
		$bike_image 	 = $_FILES['bike_image']['name'];
		$image_temp = $_FILES['bike_image']['tmp_name'];
		if($bike_image != ""){
		$check = pathinfo($bike_image, PATHINFO_EXTENSION);
			if(!in_array($check,$allowed) ) {
				die("Sorry !!! upload an Image file");
			} else {
				$temp = explode(".", $bike_image);
				$newfilename =  "bike".round(microtime(true)) . '.' . end($temp);
			}
		}
		$no_of_seat  = filter($_REQUEST['no_of_seat']);	
		$fuel  		 = filter($_REQUEST['fuel']);
		$security  	 = filter($_REQUEST['security']);
		$date 	 	 = date("Y-m-d");	
		if(move_uploaded_file($image_temp,"../uploadedDocument/bikes/".$newfilename)){
		unlink("../uploadedDocument/bikes/".$hdnimg);
			$respond = $dbObj->updateToDb("tbl_bikes","bike_name = '$bike_nme', bike_image = '$newfilename', bike_desc = '$bike_desc', cost = '$cost',weekend_cost ='$weekendcost', no_of_seat = '$no_of_seat', fuel = '$fuel', security = '$security', pickup = '$pickup', created_dte = '$date', city = '$city', offers='$offers' , status = 1","id = $id");
			$dbObj->delete("tbl_unavail_dtes","bike_id = $id");
			for($j=0; $j<count(array_filter($unavail_datefrm));$j++){
				$dbObj->insertToDb("tbl_unavail_dtes","type = '2', car_id = '0', bike_id = '$id', unavail_dte = '$unavail_datefrm[$j] $unavail_tmfrm[$j]', unavail_dte_to = '$unavail_dateto[$j] $unavail_tmto[$j]', status = '0', payment_id = ''");
			}
			
		}else{
			$respond = $dbObj->updateToDb("tbl_bikes","bike_name = '$bike_nme', bike_desc = '$bike_desc', cost = '$cost', weekend_cost ='$weekendcost', no_of_seat = '$no_of_seat', fuel = '$fuel', security = '$security', pickup = '$pickup', created_dte = '$date', city = '$city', offers='$offers', status = 1","id = $id");
			$dbObj->delete("tbl_unavail_dtes","bike_id = $id");
			for($j=0; $j<count(array_filter($unavail_datefrm));$j++){
				$dbObj->insertToDb("tbl_unavail_dtes","type = '2', car_id = '0', bike_id = '$id', unavail_dte = '$unavail_datefrm[$j] $unavail_tmfrm[$j]', unavail_dte_to = '$unavail_dateto[$j] $unavail_tmto[$j]', status = '0', payment_id = ''");
			}
		}
		if($respond == 1){
			setMessage("Record Updated Successfully","alert alert-success");
		}
	}break;
	
	
	case "deletebike":{		
		$id = filter($_REQUEST['id']);
		$getimg = $dbObj->fetch_data("tbl_bikes","id = $id");
		$respond = $dbObj->delete("tbl_bikes","id = $id");
		if($respond){
			setMessage("Record Deleted Successfully","alert alert-success");
		}
		unlink("../uploadedDocument/bikes/".$getimg[0]['bike_image']);
		header("location:".$location);
	}break;		
	
	case "disable":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("tbl_bikes","status = 0","id = $id");
		if($respond){
			setMessage("Record Disabled Successfully","alert alert-success");
		}
		header("location:".$location);
	}break;
	
	case "enable":{	
		$id = filter($_REQUEST['id']);	
		$respond = $dbObj->updateToDb("tbl_bikes","status = 1","id = $id");
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

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
		$car_nme 	 = filter($_REQUEST['car_nme']);
		$cost		 = filter($_REQUEST['cost']);
		$car_desc	 = $_REQUEST['car_desc'];
		$unavail_datefrm = filter($_REQUEST['unavail_datefrm']);
		$unavail_dateto = filter($_REQUEST['unavail_dateto']);
		$unavail_tmfrm	= filter($_REQUEST['ptime']);
		$unavail_tmto	= filter($_REQUEST['dtime']);
		$pickup  = filter($_REQUEST['pickup']);
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
		$date 	 	 = date("Y-m-d");	
		$respond = $dbObj->insertToDb("tbl_cabs","car_nme = '$car_nme', car_image = '$newfilename', car_desc = '$car_desc', cost = '$cost', unavail_datefrm = '$unavail_datefrm', unavail_tmfrm = '$unavail_tmfrm', unavail_tmto = '$unavail_tmto', unavail_dateto = '$unavail_dateto', no_of_seat = '$no_of_seat', fuel = '$fuel', pickup = '$pickup', created_dte = '$date', status = 1");
		if($respond == 1){
			setMessage("Record Added Successfully","alert alert-success");
		}
	}break;
	
	
	case "updcab":{		
		$id			 = filter($_REQUEST['id']);
		$car_nme 	 = filter($_REQUEST['car_nme']);
		$cost		 = filter($_REQUEST['cost']);
		$car_desc	 = $_REQUEST['car_desc'];
		$hdnimg		 = filter($_REQUEST['hdnimg']);
		$unavail_datefrm = filter($_REQUEST['unavail_datefrm']);
		$unavail_tmfrm	= filter($_REQUEST['ptime']);
		$unavail_tmto	= filter($_REQUEST['dtime']);
		$unavail_dateto = filter($_REQUEST['unavail_dateto']);
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
		$date 	 	 = date("Y-m-d");	
		if(move_uploaded_file($car_image_temp,"../uploadedDocument/cab/".$newfilename)){
		unlink("../uploadedDocument/cab/".$hdnimg);
			$respond = $dbObj->updateToDb("tbl_cabs","car_nme = '$car_nme', car_image = '$newfilename', car_desc = '$car_desc', cost = '$cost', unavail_datefrm = '$unavail_datefrm', unavail_tmfrm = '$unavail_tmfrm', unavail_tmto = '$unavail_tmto', unavail_dateto = '$unavail_dateto', no_of_seat = '$no_of_seat', fuel = '$fuel', pickup = '$pickup', created_dte = '$date', status = 1","id = $id");
		}else{
			$respond = $dbObj->updateToDb("tbl_cabs","car_nme = '$car_nme', car_desc = '$car_desc', cost = '$cost', unavail_datefrm = '$unavail_datefrm', unavail_tmfrm = '$unavail_tmfrm', unavail_tmto = '$unavail_tmto', unavail_dateto = '$unavail_dateto', no_of_seat = '$no_of_seat', fuel = '$fuel', pickup = '$pickup', created_dte = '$date', status = 1","id = $id");
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

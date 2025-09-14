<?php
//facultiesSort.php
session_start();
require_once("../includes/settings.php");
require_once("../includes/database.php");
require_once("../includes/classes/db.cls.php");
require_once("../includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");

loginValidate();
$db = new SiteData();

$mysqli_conn = $db->getConnection();
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}

$act = isset($_REQUEST['q'])?$_REQUEST['q']:"";
switch($act) {
	case "uncheckedHunar": {
		$id = isset($_GET['id'])?$_GET['id']:0;
		$sql = "UPDATE  ".HUNAR." SET new=0 where id='$id'";
		$res = $db->update($sql);
		echo '<font color="#990000">OFF</font>';
		
	}break;
	case "checkedHunar": {
		$id = isset($_GET['id'])?$_GET['id']:0;
		$sql = "UPDATE  ".HUNAR." SET new=1 where id='$id'";
		$res = $db->update($sql);
		echo '<font color="#009966">ON</font>';
	}break;
	
	case "uncheckedAL": {
		$id = isset($_GET['id'])?$_GET['id']:0;
		$sql = "UPDATE  ".ANNOUNCEMENT." SET new =0 where id='$id'";
		$res = $db->update($sql);
		echo '<font color="#990000">OFF</font>';
		
	}break;
	case "checkedAL": {
		$id = isset($_GET['id'])?$_GET['id']:0;
		$sql = "UPDATE  ".ANNOUNCEMENT." SET new =1 where id='$id'";
		$res = $db->update($sql);
		echo '<font color="#009966">ON</font>';
	}break;
	case "uncheckedEL": {
		$id = isset($_GET['id'])?$_GET['id']:0;
		$sql = "UPDATE  ".EVENTS." SET new =0 where id='$id'";
		$res = $db->update($sql);
		echo '<font color="#990000">OFF</font>';
		
	}break;
	case "checkedEL": {
		$id = isset($_GET['id'])?$_GET['id']:0;
		$sql = "UPDATE  ".EVENTS." SET new =1 where id='$id'";
		$res = $db->update($sql);
		echo '<font color="#009966">ON</font>';
	}break;
	case "uncheckedNB": {
		$id = isset($_GET['id'])?$_GET['id']:0;
		$sql = "UPDATE  ".NOTIFICATION." SET new =0 where id='$id'";
		$res = $db->update($sql);
		echo '<font color="#990000">OFF</font>';
		
	}break;
	case "checkedNB": {
		$id = isset($_GET['id'])?$_GET['id']:0;
		$sql = "UPDATE  ".NOTIFICATION." SET new =1 where id='$id'";
		$res = $db->update($sql);
		echo '<font color="#009966">ON</font>';
	}break;
	
	case "uncheckedLN": {
		$id = isset($_GET['id'])?$_GET['id']:0;
		$sql = "UPDATE  ".NEWS." SET new =0 where id='$id'";
		$res = $db->update($sql);
		echo '<font color="#990000">OFF</font>';
		
	}break;
	case "checkedLN": {
		$id = isset($_GET['id'])?$_GET['id']:0;
		$sql = "UPDATE  ".NEWS." SET new =1 where id='$id'";
		$res = $db->update($sql);
		echo '<font color="#009966">ON</font>';
	}break;
}
?>
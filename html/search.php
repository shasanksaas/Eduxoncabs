<?php
session_start();
require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/DBquery.cls.php");
$db = new SiteData();
$dbObj = new dbquery();

$searchTerm = $_GET['term'];
$query = $dbObj->fetch_data("tbl_cabs");
    foreach($query as $key) {
        $data[] = $key['pickup'];
    }
    
    //return json data
    echo json_encode($data);

?>
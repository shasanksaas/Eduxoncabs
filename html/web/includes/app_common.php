<?php
session_start();
require_once("../includes/config.php");
require_once("../includes/database.php");
require_once("../includes/classes/db.cls.php");
require_once("../includes/classes/sitedata.cls.php");
require_once("../includes/classes/admin.cls.php");
require_once("../includes/classes/Faculty.cls.php");
require_once("../includes/classes/Pages.cls.php");
require_once("../includes/classes/Menus.cls.php");
require_once("../includes/classes/News.cls.php");
require_once("../includes/classes/Events.cls.php");
require_once("../includes/classes/Degree.cls.php");
require_once("../includes/classes/Department.cls.php");
require_once("../includes/classes/PhotoGallery.cls.php");
require_once("../includes/classes/NoticeBoard.cls.php");
require_once("../includes/classes/School.cls.php");
require_once("../includes/classes/Scholars.cls.php");
require_once("../includes/classes/Tender.cls.php");

$db=new SiteData();
$pageObj = new Pages();
$menuObj = new Menus();
$noticeObj = new NoticeBoard();
$schoolObj = new School();
$galleryObj = new PhotoGallery();
$scholarsObj = new Scholars();
$tenderObj = new Tender();

require_once("includes/functions/common.php");
?>
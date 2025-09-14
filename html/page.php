<?php
//index.php
session_start();
require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/Pages.cls.php");

$db = new SiteData();
$pageObj = new Pages();
if(isset($_GET['page'])){

$url = filter($_REQUEST['page']);
$res = $pageObj->getPageByUrl($url); 
$total = $res['NO_OF_ITEMS'];
$page_name = stripslashes($res['oDATA'][0]['page_name']);
$page_contents = stripslashes($res['oDATA'][0]['page_contents']);
$page_type = stripslashes($res['oDATA'][0]['page_type']);
$page_title = stripslashes($res['oDATA'][0]['page_title']);
$page_metadesc = stripslashes($res['oDATA'][0]['page_metadesc']);
$page_metakeywords = stripslashes($res['oDATA'][0]['page_metakeywords']);
if($total == 0){redirect(SITE_HOME."index.php");}
}?>
<!DOCTYPE html>
<html>
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Best Self Drive Car Rental in Bhubaneswar - Eduxon Cars </title>
<meta name="keywords" content="<?php echo $page_metakeywords;?>" />
<meta name="description" content="<?php echo $page_metadesc;?>">
<meta name="author" content="Eduxoncabs.com">
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Web Fonts  -->
<?php include("includes/inc-css.php");?>
</head>
<body>
<div class="body">
  <?php include("includes/site-header-inner.php");?>
  <div role="main" class="main">
   
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          
         <?php
									if(strlen($page_contents)>0){
									echo $page_contents;	
									}else{
									echo "&nbsp;";
									}
									if($page_type!="static" && $page_type!="") {
									include("includes/".$page_type.".inc.php");
									}
								?>
          
         
        </div>
        
      </div>
    </div>
  </div>
  
   <?php include("includes/site-footer.php");?>
</div>
<?php include("includes/inc-js.php");?>
</body>
</html>

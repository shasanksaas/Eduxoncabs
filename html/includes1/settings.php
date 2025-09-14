<?php
error_reporting(1);
require_once "WADB.php";
date_default_timezone_set('Asia/Calcutta');
define('SYSTEM_DBHOST', 'localhost');
/*define('SYSTEM_DBUSER', 'eduxonca_buser');
define('SYSTEM_DBPWD', 'Admin@3211');
define('SYSTEM_DBNAME', 'eduxcabdb');*/

define('SYSTEM_DBUSER', 'root');
define('SYSTEM_DBPWD', '');
define('SYSTEM_DBNAME', 'edux_new');


define("SITE_HOME","https://www.eduxoncabs.com/");
define("URL_IMG",SITE_HOME."images/");
define("ADMIN_HOME",SITE_HOME."web/");

define("DIR_HOME","/home/ssst/");
define("DIR_IMAGES",DIR_HOME."images/");

define("ADMIN_EMAIL","eduxonassociates@gmail.com");
define("PAGE_TITLE","Eduxon Cab");
define('PAGE_LIMIT', 30);
define('SES', 'BB');
?>
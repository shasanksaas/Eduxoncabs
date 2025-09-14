<?php
session_start();
require_once("../includes/settings.php");
require_once("../includes/database.php");
require_once("../includes/classes/db.cls.php");
require_once("../includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("../includes/classes/Admin.cls.php");
$db = new SiteData();
$adminObj = new Admin();
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?=PAGE_TITLE?> :: ADMIN PANEL</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery.min.js"> </script>
<script src="js/bootstrap.min.js"> </script>
<script type='text/javascript' src='js/common.js'></script>
</head>
<body onLoad="document.frm.uname.focus();">
	<div class="login">
		<h1><a href="javascript:void(0);"><img src="images/logo.png"  border="0" alt="Logo" title="eduxoncabs" height="98px"/> </a></h1>
		<div class="login-bottom">
			<h2 style="text-align:center">Login</h2>
			<form name="frm" action="LoginAction.php" method="post">
            <input type="hidden" name="act" value="login">
            <div class="col-md-2"></div>
			<div class="col-md-8 login-do">
            <?php getMessage();?>
				<div class="login-mail">
					<input type="text" name="uname" id="uname"  placeholder="Email/Username" required="">
					<i class="fa fa-user"></i>
				</div>
				<div class="login-mail">
					<input type="password" name="pass" placeholder="Password" required="">
					<i class="fa fa-lock"></i>
				</div>
                 <!--<p><a href="forgot-pass.php" style="color:#000000; text-align:left;">Forgot Password?</a></p>-->
				   <label class="hvr-shutter-in-horizontal login-sub">
					<input type="submit" value="login">
					</label>
                    <!--<p>Do not have an account?</p>
                    <label class="hvr-shutter-in-horizontal login-sub">
						
						<a href="signup.php" class="hvr-shutter-in-horizontal">Signup</a>
					</label>-->			
			</div>
            <div class="col-md-2"></div>
			

			
			<div class="clearfix"> </div>
			</form>
		</div>
	</div>
		<!---->
<div class="copy-right">
            <p> &nbsp; &nbsp;Copyright <?php echo date('Y') ?> Eduxon Cab</p>	    </div>  
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
</body>
</html>


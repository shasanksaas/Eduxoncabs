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
<script type='text/javascript' src='js/custom.js'></script>
</head>
<body onLoad="document.frm.uname.focus();">
	<div class="login">
		<h1><a href="javascript:void(0);"><img src="images/logo.png"  border="0" alt="Logo" title="IHM" height="98px"/> </a></h1>
		<div class="login-bottom">
			<h2 style="text-align:center">Register Here</h2>
            <?php getMessage();?>
			<form name="frm" action="UserAction.php" method="post" onSubmit="return user_valid();" enctype="multipart/form-data">
            <input type="hidden" name="act" value="add_user">
            <div id="validation_div" class="validation_error" align="center"></div>
            
			<div class="col-md-6 login-do">
            
				<div class="login-mail">
					<input type="text" name="uname" id="uname"  placeholder="Email" >
					<i class="fa fa-envelope"></i>
				</div>
				<div class="login-mail">
					<input type="password" name="pass" id="pass" placeholder="Password" >
					<i class="fa fa-lock"></i>
				</div>
                <div class="login-mail">
					<input type="password" name="repass" id="repass" placeholder="Confirm Password" >
					<i class="fa fa-lock"></i>
				</div>
                
                <div class="login-mail">
					<input type="text" name="contact" id="contact" placeholder="Contact Number" >
					<i class="fa fa-phone"></i>
				</div>
                
                <div class="login-mail">
					<input type="text" name="organisation" id="organisation" placeholder="Name Of The Organisation" >
					<i class="fa fa-bank"></i>
				</div>
                <div class="login-mail">
					<input type="text" name="website" id="website" placeholder="Website(if any)" >
					<i class="fa fa-globe"></i>
				</div>
                
                <div class="login-mail">
					<input type="text" name="cperson" id="cperson" placeholder="Contact Person Name" >
					<i class="fa fa-user"></i>
				</div>
             </div>
             <div class="col-md-6 login-do">   
                
                <div class="login-mail">
					<input type="text" name="nemp" id="nemp" placeholder="Number Of Employee/Worker" >
					<i class="fa fa-users"></i>
				</div>
                
                <div class="login-mail">
					<input type="text" name="atover" id="atover" placeholder="Annual Turn Over" >
					<i class="fa fa-money"></i>
				</div>
                
                <div class="login-mail">
					<input type="text" name="perno" id="perno" placeholder="PF/ESI Registration Number" >
					<i class="fa fa-registered"></i>
				</div>
                
                <div class="login-mail">
					<input type="text" name="syear" id="syear" placeholder="In Business Since Year" >
					<i class="fa fa-bullseye"></i>
				</div>
                
                <div class="login-mail">
					<input type="file" name="ppic" id="ppic" accept="image/*" />
				</div>
                
                <div class="login-mail">
					<input type="text" name="social" id="social" placeholder="Facebook Or LinkedIn ID" >
					<i class="fa fa-lock"></i>
				</div>
                
                
                 
				   <label class="hvr-shutter-in-horizontal login-sub">
					<input type="submit" value="Signup">
					</label>
                    <p>Already have an account?</p>
                    <label class="hvr-shutter-in-horizontal login-sub">
						
						<a href="login.php" class="hvr-shutter-in-horizontal">Login Here</a>
					</label>			
			</div>
           
			

			
			<div class="clearfix"> </div>
			</form>
		</div>
	</div>
		<!---->
<div class="copy-right">
            <p> &nbsp; &nbsp;Copyright <?php echo date('Y') ?> <?php echo PAGE_TITLE;?></p>	    </div>  
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
</body>
</html>


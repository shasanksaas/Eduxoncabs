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

echo "<pre>";
print_r($_REQUEST);
exit;

if ($pdate != '' || $ptime != '' || $ddate != '' || $dtime != '') {
    ?>

    <!DOCTYPE html>

    <html>

        <head>

            <!-- Basic -->

            <meta charset="utf-8">

            <meta http-equiv="X-UA-Compatible" content="IE=edge">

            <title>Checkout | Eduxoncabs.com</title>

            <meta name="keywords" content="Eduxoncabs.com" />

            <meta name="description" content="Eduxoncabs.com">

            <meta name="author" content="Eduxoncabs.com">

            <!-- Favicon -->

            <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

            <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

            <!-- Mobile Metas -->

            <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

            <!-- Web Fonts  -->

            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

            <!-- Vendor CSS -->

    <?php include("includes/inc-css.php"); ?>

        </head>

        <body>

            <div class="body">

    <?php include("includes/site-header-inner.php"); ?>

                <div role="main" class="main">

                    <div class="container">

                        <div class="row">

                            <div class="col-md-8">


                                <h4 class="mb-sm mt-sm"><strong>Information for Booking</strong></h4>

                                <form action="pay.php" method="POST" style="margin-top:20px;">

                                    <input type="hidden" name="car_id" id="car_id" value="<?php echo $get_car_dta[0]['id']; ?>"/>

                                    <input type="hidden" name="csrf"  value="<?php echo $_SESSION["token"]; ?>" />
  

                                </form>

                            </div>                    

                        </div>

                    </div>

                </div>



    <?php include("includes/site-footer.php"); ?>

            </div>

    <?php include("includes/inc-js.php"); ?>

        </body>

    </html>



    <?php
} else {

    header("location:index.php");
}
?>


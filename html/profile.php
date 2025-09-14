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

$mysqli_conn = new mysqli(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
}

$msg ="";
if(isset($_POST['upload'])){

    $allowed =  array('jpg','JPG','JPEG','jpeg' ,'png','PNG');
    $license_image = $_FILES['license']['name'];
    $temp_name = $_FILES['license']['tmp_name'];
    $check = pathinfo($license_image, PATHINFO_EXTENSION);
    if(!in_array($check,$allowed) ) {
	die("Sorry !!! upload an Image file");
  } else {
	$temp = explode(".", $license_image);
	$newfilename =  "license".round(microtime(true)) . '.' . end($temp); 
        $target = "uploadedDocument/customerlicense/".$newfilename;
	$res = move_uploaded_file($temp_name,$target);
        if($res){

         $id = filter($_POST['cust_id'],$mysqli_conn);	
	 $result = $dbObj->updateToDb("tbl_customer","license ='$target'","cust_id = '$id'");
         if($res){
          $msg = "file uploaded sucessfully";
         }
      
     }
  }		
}
?>
<!DOCTYPE html>
<html>
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Profile | Eduxon Cars</title>
<meta name="keywords" content="Eduxoncabs.com" />
<meta name="description" content="Eduxon Cars, established in 2016, offers self-drive car rentals in Bhubaneswar with a fleet of over 30 models, unlimited kilometers, and 24/7 roadside assistance."/>
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
           <div class="col-md-12"></div>

<div class="col-md-12" style='margin-left:40%'> <form action ='' method='post' >
        <input type='text' name='customer' placeholder='Phone number' /> 
        <input type='submit' name='search' value='Search' style="padding:6px 17px 7px 16px;background:#cf9d20;border-radius:8px;font-size:18px;" /> 
    </form>
</div>

<div class="col-md-12 ">



    <div class="col-md-12 top-content" >

        <section id="no-more-tables">


            <?php
                  echo $msg;
            if (isset($_POST['search']) && $_POST['customer'] != "") {
                $phone = $_POST['customer']; 

                $getcustomer = $dbObj->fetch_data("tbl_customer", "phone_number='$phone'", "");
                $cust_id = $getcustomer [0]['cust_id'];
                if($cust_id){

                $getdta = $dbObj->fetch_data("tbl_order", "customer_id='$cust_id' and status='Completed'", " submit_dte DESC");
                $count = $dbObj->countRec("tbl_order", "phone='$phone' and status='Completed'", " submit_dte DESC");

                 if($count>0){
                ?>
                <div class="col-md-12"> Name  :<?php echo $getdta[0]['buyer_name']; ?> </div>
                <div class="col-md-12"> Phone :<?php echo $getdta[0]['phone']; ?> </div>
                <div class="col-md-12"> Email :<?php echo $getdta[0]['email']; ?>  </div>
                
                <!--<div style="float:right">
                   <form action="" method="post" enctype="multipart/form-data">
                      <div class="col-md-16">
                          Upload License Copy<input type='file' name='license' />
                          <div class="col-md-12"></div>
                          <input type='hidden' name='cust_id' value='<?php echo $cust_id; ?>' />
                          <button class="btn-primary btn" name="upload">Upload</button>
                      </div>
                    </form>
                </div>-->

                <table class="table-bordered table-striped table-condensed cf">

                    <thead>

                        <tr>

                            <th>S.N.</th>

                            <th>Vehicle</th>
                            <th>Amount</th>
                            <th>From date & time</th>
                            <th>To date & time</th>
                            <th>Invoice</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        $i = 1;
                        
                            foreach ($getdta as $key) {
                                ?>

                                <tr>

                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $key['booked_car']; ?></td>
                                    <td><?php echo $key['amount']; ?></td>
                                    <td><?php echo $key['booked_dte']." ".$key['booked_tme'];
                    ?></td>
                                    <td><?php echo $key['returned_dte']." ".$key['return_tme'];
                                ?></td>
                                <?php $fileInv = 'invoice/'.$key['payment_id'].'.pdf';?>
                                 <td><?php if(file_exists($fileInv)){?><a href="<?php echo $fileInv;?>" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a><?php }else{ echo "Sorry !!! Not generated";}?></td>



                                </tr>

                                <?php
                                $i++;
                            }
                        
                            ?>

                            <!--<tr><td colspan="5">Sorry No Record Found!!!</td></tr>-->

    <?php }else{   echo "Sorry No Record Found!!!"; } ?>  

                    </tbody>

                </table>

    <?php
} else{
echo "<span>Sorry No Record Found!!!</span>";
}
}
?>









        </section>

    </div>



</div>


    </div>
  </div>
  
   <?php include("includes/site-footer.php");?>
</div>
<?php include("includes/inc-js.php");?>
</body>
</html>

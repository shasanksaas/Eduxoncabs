<?php
$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
if (!$mysqli_conn) {
            die("Database Connection Failed: " . $mysqli_conn->connect_error);
        }

$required = "<font color='#FF0000' size='1'>*</font>";
$fdata = array();

/*************************************/
if ($_POST['stage'] == 2) {
    $date = date("Y-m-d", strtotime($_POST['dob']));
    if ($_FILES['img']['name'] != "") {
		$isbanner = (isset($_POST['isbanner']))?$_POST['isbanner']:0;
        $path2 = "../uploadedDocument/banner";
        $delpath = $path2 . "/" . $_POST['T2'];

        @unlink($delpath);

        $s1 = rand();
        $realname = $_FILES['img']['name'];
        $realname = $s1 . "_" . $realname;
        $dest = $path2 . "/" . $realname;
        move_uploaded_file($_FILES['img']['tmp_name'], $dest);
        $img_name = trim($realname);
        $img = $img_name;
    } else {
        $img = trim($_POST['T2']);
    }
    $sql = "insert into  tbl_banner set 
		banner_name='" . str_replace("'", "&#39;", $_POST['txtname']) . "',          
		banner_image		=	'" . str_replace("'", "&#39;", $img) . "',
		banner_desc		=	'" . str_replace("'", "&#39;", $_POST['txadesc']) . "',
		banner_sequence='" . str_replace("'", "&#39;", $_POST['txtsequence']) . "',isbanner = '$isbanner'";

    // print $sql;exit;
    $rs = mysqli_query($mysqli_conn,$sql);
    $msg = "Banner Added Successfully";
	setMessage($msg, 'alert alert-success');?>
	<script>window.location = 'managebanner.php';</script>
<?php }


?>

<div class="col-md-12"><a href="<?=$_curpage?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>

	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form name="form1" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validate();" method="post">
                             <?php
							if ($res['id'] == "") {
								?>
								<input type="hidden" name="stage" value="2">
								<?php
							} else {
								?>
								<input type="hidden" name="stage" value="3">
								<input type="hidden" name="id" value="<?php print $res['id'] ?>">
								<?php
							}
							?>
                             <div id="validation_div" class="validation_error" align="center"></div>
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Image Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="txtname" name="txtname" placeholder="Enter Name">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Upload Image</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control1" name="img" />
       													<input type="hidden" name="T2" value="<?php print $res['image']; ?>">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Image Description</label>
                                                    <div class="col-sm-8">
                                                       
                                                        <textarea row="5" class="form-control" cols="50" id="txadesc" name="txadesc" ></textarea>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Image Sequence</label>
                                                    <div class="col-sm-8">
                                                        
                                                        <input type="text" class="form-control1" name="txtsequence" value="" size="5" placeholder="Like 1, 2, 3"/>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Is Banner Image</label>
                                                    <div class="col-sm-8">
                                                        <input type="checkbox" name="isbanner" id="isbanner" value="1"/>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                

                                                
                                                <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn">Add Image</button>
                                
                                <button class="btn-inverse btn">Reset</button>
                            </div>
                        </div>
                     </div>
                                            </form>                
                        </div>
      			</div>
			</div>
	</div>





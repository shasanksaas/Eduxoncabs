<?php

	$id = filter($_REQUEST['id']);

        $get_cnt_dates = $dbObj->countRec("master_gv","id= $id");

	$get_coupondetl = $dbObj->fetch_data("master_gv","id = $id");

	

?>
<div class="col-md-12"><a href="<?=$_curpage?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>

	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" name="frm" action="couponAction.php" method="post" enctype="multipart/form-data">
                             <input type="hidden" name="act" value="editcoupon" />

                             <input type="hidden" name="id" value="<?php echo $id;?>"/>
                             
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Coupon </label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control1" id="coupon" name="coupon" value="<?php echo $get_coupondetl[0]['gv_code'];?>" required>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Coupon Percentage</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control1" id="couponpercent" name="couponpercent" value="<?php echo $get_coupondetl[0]['gv_percent'];?>" required>
                                                        
                                                    </div>
                                                    
                                                </div>
                                               <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">From date </label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="" min="<?php //echo date("Y-m-d"); ?>" name="fromdate" value="<?php echo substr($get_coupondetl[0]['from_date'],0,10);?>" />
                                                        
                                                    </div>
                                                    
                                                </div>
                                               <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">To date </label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="" min="<?php //echo date("Y-m-d"); ?>" name="todate" value="<?php echo substr($get_coupondetl[0]['to_date'],0,10);?>" />
                                                        
                                                    </div>
                                                    
                                                </div>
                                               <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Issue Date </label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="" min="<?php //echo date("Y-m-d"); ?>" name="issuedate" value="<?php echo $get_coupondetl[0]['issue_date'];?>" />
                                                        
                                                    </div>
                                                    
                                                </div>
                                               <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Expire Date </label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="" min="<?php //echo date("Y-m-d"); ?>" name="expdate" value="<?php echo $get_coupondetl[0]['expiry_date'];?>" />
                                                        
                                                    </div>
                                                    
                                                </div>
                                               
                                                
                                                
                                                
                                                <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn">Submit</button>
                                
                                <input type="reset" class="btn-inverse btn"/>
                            </div>
                        </div>
                     </div>
                                            </form>                
                        </div>
      			</div>
			</div>
	</div>



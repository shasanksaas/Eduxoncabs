<?php
	$id = filter($_REQUEST['id']);
	$get_loc = $dbObj->fetch_data("tbl_industry","id = $id");
?>

<div class="col-md-12"><a href="<?=$_curpage?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>

	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" name="frm" action="IndustryAction.php" method="post" onsubmit="return addadmin_valid();">
                             <input type="hidden" name="act" value="updind" />
                             <input type="hidden" name="id" value="<?php echo $id;?>"/>
                             
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Industry Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="industry" name="industry" placeholder="Enter Trade" value="<?php echo $get_loc[0]['industry'];?>" required>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                
                                             
                                                
                                                <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn">Update</button>
                                <button class="btn-inverse btn">Reset</button>
                            </div>
                        </div>
                     </div>
                                            </form>                
                        </div>
      			</div>
			</div>
	</div>





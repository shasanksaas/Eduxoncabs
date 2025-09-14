<?php
$id=$_REQUEST['id'];
$res = $adminObj->getAdminUserById($id);
//echo $res['oDATA'][0]['admin_id'];
//echo $res['oDATA'][0]['admin_user'];
$admin_id = md5($res['oDATA'][0]['admin_id']);
$admin_user = stripslashes($res['oDATA'][0]['admin_user']);
//echo $admin_id;
//echo $admin_user;
?>

<div class="col-md-12"><a href="<?=$_curpage?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>

	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" name="frm" action="AdminAction.php" method="post" onsubmit="return changepass_valid();">
    <input type="hidden" name="act" value="changeadminpass" />
    <input type="hidden" name="id" value="<?=$admin_id?>" />
                             <div id="validation_div" class="validation_error" align="center"></div>
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">New Password </label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control1" id="npass" name="npass" placeholder="Enter New Password">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Confirm Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control1" id="cpass" name="cpass" placeholder="Re enter password">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                
                                                
                                                

                                                
                                                <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn">Update</button>
                                <button class="btn-default btn">Cancel</button>
                                <button class="btn-inverse btn">Reset</button>
                            </div>
                        </div>
                     </div>
                                            </form>                
                        </div>
      			</div>
			</div>
	</div>





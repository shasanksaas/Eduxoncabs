<?php
$required = "<font color='#FF0000' size='1'>*</font>";
//echo "Session Value :". $_SESSION[SES]['admin']['admin_id'];
$admin_id=md5($_SESSION[SES]['admin']['admin_id']);
//echo "Admin Id:".$admin_id;

$res = $adminObj->getAdminUserById($admin_id);
$admin_user = outText($res['oDATA'][0]['admin_user']);
$admin_name = outText($res['oDATA'][0]['admin_name']);
$admin_email = outText($res['oDATA'][0]['admin_email']);
$admin_phone = outText($res['oDATA'][0]['admin_phone']);
?>

	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                    <?php getMessage();?>
                             <form class="form-horizontal" action="AdminAction.php" method="post"  onsubmit = "return changepass_valid()" name="frm">
                              <input type="hidden" name="act" value="changepass" />
                              <input type="hidden" name="id" value="<?=$admin_id?>" />
                             <div id="validation_div" class="validation_error" align="center"></div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">New Password </label>
                                                    <div class="col-sm-8">
                                                        <input type="password" name="npass" class="form-control1">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Confirm Password </label>
                                                    <div class="col-sm-8">
                                                        <input type="password" name="cpass" class="form-control1">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                

                                                
                                                <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn">Update Password</button>
                                
                                <button class="btn-inverse btn">Reset</button>
                            </div>
                        </div>
                     </div>
                                            </form>                
                        </div>
      			</div>
			</div>
	</div>
    
    
    <div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" action="AdminAction.php" method="post"  onsubmit = "return validProfile(this)">
                              <input type="hidden" name="act" value="changeadminprofile" />
                              <input type="hidden" name="admin_id" value="<?=$admin_id?>" />
                             <div id="validation_div" class="validation_error" align="center"></div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Username </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="admin_user" value="<?=$admin_user?>" class="form-control1">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Name </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="admin_name" value="<?=$admin_name?>" class="form-control1">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Email </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="admin_email" value="<?=$admin_email?>" class="form-control1">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Phone </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="phone" size="30" value="<?=$admin_phone?>" class="form-control1">
                                                        
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





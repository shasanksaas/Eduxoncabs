<div class="col-md-12"><a href="<?=$_curpage?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>

	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" name="frm" action="AdminAction.php" method="post" onsubmit="return addadmin_valid();">
                             <input type="hidden" name="act" value="addadmin" />
                             <div id="validation_div" class="validation_error" align="center"></div>
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="name" name="name" placeholder="Enter Name">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">User Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="uname" name="uname" placeholder="Enter Username">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control1" id="pass" name="pass" placeholder="Enter Password">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Re Enter Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control1" id="repass" name="repass" placeholder="Re Enter Password">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Email Address</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="email" name="email" placeholder="Enter Email">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Phone Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="phone" name="phone" placeholder="Enter Phone">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Select Admin Type</label>
                                                    <div class="col-sm-8">
                                                        
                                                        <select class="form-control1" name="admin_type">
                                                        	<option value="2">Admin</option>
              												<option value="3">Employee</option>
                                                        </select>
                                                        
                                                    </div>
                                                    
                                                </div>

                                                
                                                <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn">Submit</button>
                                <button class="btn-inverse btn">Reset</button>
                            </div>
                        </div>
                     </div>
                                            </form>                
                        </div>
      			</div>
			</div>
	</div>





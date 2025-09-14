	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" name="frm" action="exportAction.php" method="post" enctype="multipart/form-data">
                             <input type="hidden" name="act" value="getContact" />
                             
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Select Location</label>
                                                    <div class="col-sm-4">
                                                        <select name='city' id='city' class="form-control1" required>
                                                        <option value="">Select Location</option>
                                                            <?php
                                                                $getdta = $dbObj->selectFromDb("tbl_order","DISTINCT city");
                                                                foreach($getdta as $val){
                                                            ?>
                                                            <option value='<?=$val["city"]?>'><?=$val["city"]?></option>
                                                            <?php } ?>
                                                        </select>
                                                        
                                                    </div>
                                                    
                                                </div>
                                              
                                            
                                              
                                                
                                                <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn">Generate Excel</button>
                            </div>
                        </div>
                     </div>
                                            </form>                
                        </div>
      			</div>
			</div>
	</div>

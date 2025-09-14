<div class="col-md-12"><a href="<?=$_curpage?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>

	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" name="frm" action="locationAction.php" method="post" enctype="multipart/form-data">
                             <input type="hidden" name="act" value="addlocation" />
                             
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">City </label>
                                                    <div class="col-sm-4">
                                                        <select name='city' id='city' class="form-control1">
                                                            <?php
                                                                $getdta = $dbObj->fetch_data("tbl_city","status='1'","id ASC");
                                                                $count = $dbObj->countRec("tbl_city");
                                                                if($count > 0){
                                                                foreach($getdta as $val){
                                                            ?>
                                                            <option value='<?=$val["id"]?>'><?=$val["city"]?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">pickup point</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="pick_point" name="pick_point" required>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Drop point</label>
                                                    <div class="col-sm-8">
                                                        
                                                        <input type="text" class="form-control1" id="drop_point" name="drop_point" required/>
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



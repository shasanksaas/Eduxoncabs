<div class="col-md-12"><a href="<?=$_curpage?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>

	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" name="frm" action="CabsAction.php" method="post" enctype="multipart/form-data">
                             <input type="hidden" name="act" value="addcab" />
                             
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">City Location</label>
                                                    <div class="col-sm-4">
                                                        <select name='city' id='city' class="form-control1">
                                                            <?php
                                                                $getdta = $dbObj->fetch_data("location","status='1'","id ASC");
                                                                $count = $dbObj->countRec("location");
                                                                if($count > 0){
                                                                foreach($getdta as $val){
                                                            ?>
                                                            <option value='<?=$val["id"]?>'><?=$val["pickup_point"]?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Car Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="car_nme" name="car_nme" required>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Car Image</label>
                                                    <div class="col-sm-8">
                                                        
                                                        <input type="file" class="form-control1" id="car_image" name="car_image" required/>
                                                    </div>
                                                    
                                                </div>
                                                
                                                
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Cost/24 Hr.</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="cost" onkeypress="return isNumber(event)" maxlength="5" name="cost" required>
                                                        
                                                    </div>
                                                    
                                                </div>
						<div class="form-group">

                                                     <label for="focusedinput" class="col-sm-2 control-label">Weekend Cost/24 Hr.</label>

                                                       <div class="col-sm-8">
								<input type="text" class="form-control1" id="weekendcost"  onkeypress="return isNumber(event)" maxlength="5" name="weekendcost" required>
							</div>
						</div>
                                            <div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Offers</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="car_ofr" name="car_ofr" > 
                                                    </div>

                                                </div>
                                                
                                                <!--<div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Unavailable Date From</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control1 datepicker" id="unavail_datefrm" name="unavail_datefrm">
                                                        
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                      <select class="form-control" name="ptime" id="ptime" >
                            							<option value="">Select Time</option>
														<?php
                        
                                                        for ($i = 0; $i < 24; $i++) {
                                                            $num = $i > 23 ? $i - 24 : $i;
                                                            //$num = $num < 10 ? "0$num" : $num;
                                                            $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
                                                            //if($ptime == $num){ $sel  = 'selected'; }else{ $sel  = '';}
                                                            echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";
                                                            
                                                        }
                                                        
                                                        ?>
                            						</select>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Unavailable Date To</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control1 datepicker" id="unavail_dateto" name="unavail_dateto">
                                                        
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                      <select class="form-control" name="dtime" id="dtime" >
                                                        <option value="">Select Time</option>
                                                        <?php
                        
                                                        for ($i = 6; $i < 30; $i++) {
                                                            $num = $i > 23 ? $i - 24 : $i;
                                                            //$num = $num < 10 ? "0$num" : $num;
                                                            $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
                                                            //if($dtime == $num){ $sel  = 'selected'; }else{ $sel  = '';}
                                                            //$select = 
                                                            echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";
                                                            
                                                        }
                                                        
                                                        ?>
                                                    </select>
                                                        
                                                    </div>
                                                    
                                                </div>-->
                                                <div class="form-group">
                                                    <a href="javascript:void(0)" class="btn btn-success" onclick="return addRow('dataTable');">Add more</a>
                                                    <a href="javascript:void(0)" class="btn btn-danger" onclick="return deleteRow('dataTable');">Remove row</a>
													
                                                    <table id="dataTable" class="table-bordered table-striped table-condensed cf">
                                                         <tbody>
                                                           <tr>
                                                             <p>
                                                               <td><input type="checkbox" name="chk[]" /></td>
                                                                <td>Unavailable Date from <br /><input type="date" class="" min="<?php echo date("Y-m-d"); ?>" name="unavail_datefrm[]"></td>
                                                                <td>Time<br /> <select class="" name="ptime[]" id="ptime" >
                                                                            <option value="">Select Time</option>
                                                                            <?php
                                            
                                                                            for ($i = 0; $i < 24; $i++) {
                                                                                $num = $i > 23 ? $i - 24 : $i;
                                                                                //$num = $num < 10 ? "0$num" : $num;
                                                                                $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
                                                                                //if($ptime == $num){ $sel  = 'selected'; }else{ $sel  = '';}
                                                                                echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";
                                                                                
                                                                            }
                                                                            
                                                                            ?>
                                                                        </select>
                                                    		</td> 
                                                            	<td>Unavailable Date to<br /> <input type="date" class="" min="<?php echo date("Y-m-d"); ?>" name="unavail_dateto[]"></td>
                                                                <td>Time<br /> <select class="" name="dtime[]" id="ptime" >
                                                                            <option value="">Select Time</option>
                                                                            <?php
                                            
                                                                            for ($i = 0; $i < 24; $i++) {
                                                                                $num = $i > 23 ? $i - 24 : $i;
                                                                                //$num = $num < 10 ? "0$num" : $num;
                                                                                $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
                                                                                //if($ptime == $num){ $sel  = 'selected'; }else{ $sel  = '';}
                                                                                echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";
                                                                                
                                                                            }
                                                                            
                                                                            ?>
                                                                        </select>
                                                    		</td>                   
                                                            </p>
                                                          </tr>
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Seat</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="no_of_seat" name="no_of_seat" required>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Fuel</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control1" id="fuel" name="fuel" required>
                                                            <option value="Diesel">Diesel</option>
                                                            <option value="Petrol">Petrol</option>
                                                        </select>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Security Fees</label>
                                                    <div class="col-sm-8">
                                                    <input type="text" class="form-control1" id="security" name="security" required>
                                                        
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                 <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Pick Up Location</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" id="pickup" name="pickup" value="Sishubhaban Squre, Jindal office, Bhubaneswar" required>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Description</label>
                                                    <div class="col-sm-8">
																<?php
																	include_once("includes/fckeditor/fckeditor.php") ;
																	echo "\n";
																	$cntdesc = $car_desc;
																	$ctrl_name = 'car_desc';
																	$sBasePath = 'includes/fckeditor/';
																	$oFCKeditor = new FCKeditor($ctrl_name);
																	$oFCKeditor->Height = "400px";
																	$oFCKeditor->Width = "100%";
																	$oFCKeditor->BasePath = $sBasePath;
																	$oFCKeditor->Value =$cntdesc;
																	$oFCKeditor->Create();
                                                         		?>
          												
          
                                                        
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


<script>
function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length; //count the number of rows
	//alert(rowCount);
		var row = table.insertRow(rowCount); //row to insert
		var colCount = table.rows[0].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
			}
}

function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			if(rowCount <= 1) { 						// limit the user from removing all the fields
				alert("Cannot Remove all the Records.");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
}
</script>
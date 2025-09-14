<?php

	$id = filter($_REQUEST['id'],$mysqli_conn);

	$get_loc = $dbObj->fetch_data("tbl_bikes","id = $id");

	$get_cnt_dates = $dbObj->countRec("tbl_unavail_dtes","bike_id = $id");

	$get_dates = $dbObj->fetch_data("tbl_unavail_dtes","bike_id = $id");

//echo "<pre>";
//	print_r($get_loc);exit;

?>



<div class="col-md-12"><a href="<?=$_curpage?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>



	<div class="col-md-12 ">

			<div class="col-md-12 top-content">.

                <div class="grid-form1">

  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">

                             <form class="form-horizontal" name="frm" action="bikeAction.php" method="post" enctype="multipart/form-data">

                             <input type="hidden" name="act" value="updatebike" />

                             <input type="hidden" name="id" value="<?php echo $id;?>"/>

                             <input type="hidden" name="hdnimg" value="<?php echo $get_loc[0]['bike_image'];?>"/>

                             
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">City location</label>
                                                  
                                                    <div class="col-sm-4">
                                                        <select name='city' id='city' class="form-control1">
                                                            <?php

                                                                 $city_id = $get_loc[0]['city'];
                                                                

                                                                $getdta = $dbObj->fetch_data("location","status='1'","id ASC");
                                                               
                                                                foreach($getdta as $val){
                                                                    //print_r($val); exit;

                                                                    if($city_id == $val['id'])
                                                                    {
                                                                        
                                                                        $selected="selected='selected'";
                                                                    }else{
                                                                         $selected=""; 
                                                                        
                                                                    }
                                                            ?>
                                                            <option <?php echo $selected; ?> value='<?=$val["id"]?>'><?=$val["pickup_point"]?></option>
                                                            <?php 
                                                                    
                                                                } 
                                                            ?>
                                                        </select>
                                                        
                                                    </div>
                                                    
                                                </div>


                                                <div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Bike Name</label>

                                                    <div class="col-sm-8">

                                                        <input type="text" class="form-control1" id="bike_nme" name="bike_nme" value="<?php echo $get_loc[0]['bike_name'];?>" required>

                                                        

                                                    </div>

                                                    

                                                </div>

                                                

                                                <div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Bike Image</label>

                                                    <div class="col-sm-8">

                                                        

                                                        <input type="file" class="form-control1" id="bike_image" name="bike_image"/> <span><img src="../uploadedDocument/bikes/<?php echo $get_loc[0]['bike_image'];?>" width="200" height="100" /></span>

                                                    </div>

                                                    

                                                </div>

                                                

                                                

                                                

                                                <div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Cost/24 Hr.</label>

                                                    <div class="col-sm-8">

                                                        <input type="text" class="form-control1" id="cost" value="<?php echo $get_loc[0]['cost'];?>" onkeypress="return isNumber(event)" maxlength="5" name="cost" required>

                                                        

                                                    </div>

                                                    

                                                </div>

						<div class="form-group">

                                                               <label for="focusedinput" class="col-sm-2 control-label">Weekend Cost/24 Hr.</label>

                                                               <div class="col-sm-8">

                                                                   <input type="text" class="form-control1" id="weekendcost" value="<?php echo $get_loc[0]['weekend_cost'];?>" onkeypress="return isNumber(event)" maxlength="5" name="weekendcost" required>



                                                               </div>



                                                           </div>

                                                           <div class="form-group">

                                                                <label for="focusedinput" class="col-sm-2 control-label">Offers</label>

                                                                <div class="col-sm-8">

                                                                    <input type="text" class="form-control1" id="bike_ofr" name="bike_ofr" value="<?php echo $get_loc[0]['offers'];?>" >

                                                                    
                                                                </div>

                                                                
                                                            </div>

                                        

                                                

                                                 <!--<div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Unavailable Date From</label>

                                                    <div class="col-sm-4">

                                                        <input type="text" class="form-control1 datepicker" value="<?php echo $get_loc[0]['unavail_datefrm'];?>" id="unavail_datefrm" name="unavail_datefrm">

                                                        

                                                    </div>

                                                    

                                                     <div class="col-sm-4">

                                                      <select class="form-control" name="ptime" id="ptime" >

                            							<option value="">Select Time</option>

														<?php

                        

                                                        for ($i = 0; $i < 24; $i++) {

                                                            $num = $i > 23 ? $i - 24 : $i;

                                                            //$num = $num < 10 ? "0$num" : $num;

                                                            $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';

                                                            if($get_loc[0]['unavail_tmfrm'] == $num){ $sel  = 'selected'; }else{ $sel  = '';}

                                                            echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";

                                                            

                                                        }

                                                        

                                                        ?>

                            						</select>

                                                        

                                                    </div>

                                                    

                                                </div>

                                                

                                                <div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Unavailable Date To</label>

                                                    <div class="col-sm-4">

                                                        <input type="text" class="form-control1 datepicker" value="<?php echo $get_loc[0]['unavail_dateto'];?>" id="unavail_dateto" name="unavail_dateto">

                                                        

                                                    </div>

                                                    

                                                    <div class="col-sm-4">

                                                      <select class="form-control" name="dtime" id="dtime" >

                                                        <option value="">Select Time</option>

                                                        <?php

                        

                                                        for ($i = 6; $i < 30; $i++) {

                                                            $num = $i > 23 ? $i - 24 : $i;

                                                            //$num = $num < 10 ? "0$num" : $num;

                                                            $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';

                                                            if($get_loc[0]['unavail_tmto'] == $num){ $sel  = 'selected'; }else{ $sel  = '';}

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

                                                         <?php if($get_cnt_dates >0){

														 	for($z = 0; $z<$get_cnt_dates;$z++){

															//print_r($get_dates[$z]['unavail_dte_to']);

														 ?>

                                                         

                                                           <tr>

                                                             <p>

                                                               <td><input type="checkbox" name="chk[]" /></td>

                                                                <td>Unavailable Date from <br /><input type="date" class="" min="<?php echo date("Y-m-d"); ?>" name="unavail_datefrm[]" value="<?php echo date('Y-m-d',strtotime($get_dates[$z]['unavail_dte']));?>"><?php //echo date('H:i',strtotime($get_dates[$z]['unavail_dte_to']));//echo date("H:i",strtotime("$get_dates[$z]['unavail_dte_to']"));?></td>

                                                                <td>Time<br /> <select class="" name="ptime[]" id="ptime" >

                                                                            <option value="">Select Time</option>

                                                                            <?php

                                            

                                                                            for ($i = 0; $i < 24; $i++) {

                                                                                $num = $i > 23 ? $i - 24 : $i;

                                                                                //$num = $num < 10 ? "0$num" : $num;

                                                                                $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';

                                                                                if(date('H',strtotime($get_dates[$z]['unavail_dte'])) == $num){ $sel  = 'selected'; }else{ $sel  = '';}

                                                                                echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";

                                                                                

                                                                            }

                                                                            

                                                                            ?>

                                                                        </select>

                                                    		</td> 

                                                            	<td>Unavailable Date to<br /> <input type="date" class="" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date('Y-m-d',strtotime($get_dates[$z]['unavail_dte_to']));?>" name="unavail_dateto[]"></td>

                                                                <td>Time<br /> <select class="" name="dtime[]" id="ptime" >

                                                                            <option value="">Select Time</option>

                                                                            <?php

                                            

                                                                            for ($i = 0; $i < 24; $i++) {

                                                                                $num = $i > 23 ? $i - 24 : $i;

                                                                                //$num = $num < 10 ? "0$num" : $num;

                                                                                $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';

                                                                                if(date('H',strtotime($get_dates[$z]['unavail_dte_to'])) == $num){ $sel  = 'selected'; }else{ $sel  = '';}

                                                                                echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";

                                                                                

                                                                            }

                                                                            

                                                                            ?>

                                                                        </select>

                                                    		</td>                   

                                                            </p>

                                                          </tr>

                                                          <?php }}else{?>

                                                          	<tr>

                                                             <p>

                                                               <td><input type="checkbox" name="chk[]" /></td>

                                                                <td>Unavailable Date from <br /><input type="date" class="" min="<?php echo date("Y-m-d"); ?>" name="unavail_datefrm[]" ></td>

                                                                <td>Time<br /> <select class="" name="ptime[]" id="ptime" >

                                                                            <option value="">Select Time</option>

                                                                            <?php

                                            

                                                                            for ($i = 0; $i < 24; $i++) {

                                                                                $num = $i > 23 ? $i - 24 : $i;

                                                                                //$num = $num < 10 ? "0$num" : $num;

                                                                                $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';

                                                                                //if($get_dates[$z]['unavail_tme'] == $num){ $sel  = 'selected'; }else{ $sel  = '';}

                                                                                echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";

                                                                                

                                                                            }

                                                                            

                                                                            ?>

                                                                        </select>

                                                    		</td> 

                                                            	<td>Unavailable Date to<br /> <input type="date" class="" min="<?php echo date("Y-m-d"); ?>"  name="unavail_dateto[]"></td>

                                                                <td>Time<br /> <select class="" name="dtime[]" id="ptime" >

                                                                            <option value="">Select Time</option>

                                                                            <?php

                                            

                                                                            for ($i = 0; $i < 24; $i++) {

                                                                                $num = $i > 23 ? $i - 24 : $i;

                                                                                //$num = $num < 10 ? "0$num" : $num;

                                                                                $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';

                                                                                //if($get_dates[$z]['unavail_to_tme'] == $num){ $sel  = 'selected'; }else{ $sel  = '';}

                                                                                echo "<option value=\"$num:00\" $sel> $num:00 $ampm</option>\n";

                                                                                

                                                                            }

                                                                            

                                                                            ?>

                                                                        </select>

                                                    		</td>                   

                                                            </p>

                                                          </tr>

                                                          <?php }?>

                                                        </tbody>

                                                    </table>

                                                    

                                                </div>

                                                

                                                <div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Seat</label>

                                                    <div class="col-sm-8">

                                                        <input type="text" class="form-control1" id="no_of_seat" name="no_of_seat" value="<?php echo $get_loc[0]['no_of_seat'];?>" required>

                                                        

                                                    </div>

                                                    

                                                </div>

                                                

                                                <div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Fuel</label>

                                                    <div class="col-sm-8">

                                                        <select class="form-control1 datepicker" id="fuel" name="fuel" required>

                                                            <option value="Diesel" <?php if($get_loc[0]['fuel'] == 'Diesel'){?> selected="selected" <?php }?>>Diesel</option>

                                                            <option value="Petrol" <?php if($get_loc[0]['fuel'] == 'Petrol'){?> selected="selected" <?php }?>>Petrol</option>

                                                        </select>

                                                        

                                                    </div>

                                                    

                                                </div>

                                                

                                                <div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Security Fees</label>

                                                    <div class="col-sm-8">

                                                    <input type="text" class="form-control1" id="security" name="security" value="<?php echo $get_loc[0]['security'];?>" required>

                                                        

                                                        

                                                    </div>

                                                </div>

                                                

                                                 <div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Pick Up Location</label>

                                                    <div class="col-sm-8">

                                                        <input type="text" class="form-control1" id="pickup" name="pickup" value="<?php echo $get_loc[0]['pickup'];?>" required>

                                                        

                                                    </div>

                                                    

                                                </div>

                                                

                                                <div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Description</label>

                                                    <div class="col-sm-8">

																<?php

																	include_once("includes/fckeditor/fckeditor.php") ;

																	echo "\n";

																	$cntdesc = $get_loc[0]['bike_desc'];

																	$ctrl_name = 'bike_desc';

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

                                <button class="btn-primary btn">Update</button>

                                

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


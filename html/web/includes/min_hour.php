<div class="col-md-12"><a href="<?=$_curpage?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>



	<div class="col-md-12 ">

			<div class="col-md-12 top-content">

                <div class="grid-form1">

  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">

                             <form class="form-horizontal" name="frm" action="locationAction.php" method="post" enctype="multipart/form-data">

                             <input type="hidden" name="act" value="editminHour" />

                                                <div class="form-group">

                                                    <label for="focusedinput" class="col-sm-2 control-label">Min Hours</label>

                                                    <div class="col-sm-8">

                                                        <select name='minHour' id='minHour' class="form-control1">
                                                            <?php
                                                                 $get_res = $dbObj->fetch_data("tbl_min_hour","");
                                                                 $min_hour_val = $get_res[0]['hours'];
                                                                 if($min_hour_val == 12){ $select12 = "selected";}
                                                                 else{ $select24 = "selected"; }
                                                            ?>
                                                            <option <?php echo $select12; ?> value='12'>12</option>
                                                            <option <?php echo $select24; ?> value='24'>24</option>
                  
                                                        </select>

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







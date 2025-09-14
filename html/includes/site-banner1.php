<!--<section style="background:url(img/background-min.jpg); padding:0px; margin:5px;" class="section"  >-->
<section style="background:url(img/background-min.jpg); padding:0px; margin:5px;" class="section"  >
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <div class="col-md-1">
          </div>
          <div class="col-md-5 mt-none mb-none" style="margin-top:50px;">
          <p style="font-weight:bold; font-size:20px; color:#000;"><span class="word-rotate" data-plugin-options="{'delay': 3000, 'animDelay': 600}">
											<span class="word-rotate-items">
												<span> 24*7 Service</span></p>
                                                  
                                                    <p style="font-weight:bold; font-size:20px; color:#000;"><span class="word-rotate" data-plugin-options="{'delay': 10000, 'animDelay': 5600}">
											<span class="word-rotate-items">
												<span>Lowest Price</span></p>
                                                <p style="font-weight:bold; font-size:20px; color:#000;"><span class="word-rotate" data-plugin-options="{'delay': 9000, 'animDelay': 6600}">
											<span class="word-rotate-items">
												<span>Free Insurance</span></p>
                                                <p style="font-weight:bold; font-size:20px; color:#000;"><span class="word-rotate" data-plugin-options="{'delay': 7000, 'animDelay': 4400}">
											<span class="word-rotate-items">
												<span>Phone Booking</span></p>
                                                <p style="font-weight:bold; font-size:20px; color:#000;"><span class="word-rotate" data-plugin-options="{'delay': 2000, 'animDelay': 1500}">
											<span class="word-rotate-items">
												<span>Varities of Cars</span></p>
                                                <p style="font-weight:bold; font-size:20px; color:#000;"><span class="word-rotate" data-plugin-options="{'delay': 2000, 'animDelay': 1300}">
											
											<span class="word-rotate-items">
												<span>Starting @60/Hour</span></p>
                                                <p style="font-weight:bold; font-size:20px; color:#000;"><span class="word-rotate" data-plugin-options="{'delay': 8000, 'animDelay': 9000}">
                                                  <span class="word-rotate-items">
												<span>Door Step Delievery</span></p>
                                                <p style="font-weight:bold; font-size:20px; color:#000;"><span class="word-rotate" data-plugin-options="{'delay': 7000, 'animDelay': 1400}">
											<span class="word-rotate-items">
												<span>Unlimited Kilometeres/Free Fuel</span></p>
                                                
                                                <a href="https://play.google.com/store/apps/details?id=www.eduxoncabs.com.eduxoncabs" target="_blank"><img src="img/download_android.png" /></a>
                                               
                                                
                                                
                                                
                                                
                                                
												
         
          </div>
          
          <div class="col-md-6">
              <div class="featured-boxes mt-none mb-none">
                <div class="featured-box featured-box-primary mt-xl">
                  <div class="box-content">
                    <h4 class="mb-none">Search For Self Drive Car Rentals </h4>
                    <form method="" name='search-form' id='search-form' action="all-cars-for-self-drive-bhubaneswar.php" style="margin-top:20px;">
                    <input type="hidden" name="act" value="searchcabs"/>
                      <div class="row">
                        <div class="form-group">

                          <div class="col-md-12">
                            <label style="font-size:12pt;">Vehicle type*</label>                    
                            <select class="form-control" name="vehicle" id="vehicle" required>
                              
                                <option value="1">Cars</option>
                                <option value="2">Bikes</option>
                            </select>
                          </div>

                          <div class="col-md-12">
                            <label style="font-size:12pt;">City*</label>                    
                            <select class="form-control" name="city" id="city" required>
                            	<?php 
$city_data1 = $dbObj->fetch_data("tbl_city", "status= '1' order by city");
foreach ($city_data1 as $data) {
    
                                 ?>
                                <option value="<?=$data['id']?>"><?=$data['city']?></option>
                                <?php } ?>
                            </select>
                          </div>
                          <div class="col-md-12">
                            
                            <label style="font-size:12pt;">Pick Up Location *</label>

                            <select class="form-control" name="pickuploc" id="pickuploc" required>
                              <option value="">select</option>
                                <?php 
$get_location_data1 = $dbObj->fetch_data("location", "city_id = '1'");
foreach ($get_location_data1 as $data1) {
    $pic_Point = $data1['pickup_point'];
                                 ?>
                                <option value="<?=$data1['id']?>"><?=$pic_Point?></option>
<?php 
}
?>
                            </select>
                          </div>
                          <div class="col-md-12">
                            <label style="font-size:12pt;">Drop-off Location *</label>

                            <select class="form-control" name="droploc" id="droploc" required>
                            	<option value="">select</option>
                               <?php 
$get_location_data1 = $dbObj->fetch_data("location", "city_id = '1'");
foreach ($get_location_data1 as $data1) {
    $drp_Point = $data1['drop_point'];
?>
                                <option value="<?=$data1['id'];?>"><?=$drp_Point;?></option>
<?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group">
                          <div class="col-md-7">
                             <label style="font-size:12pt;"> Pickup Date *</label>
                            <input type="text" value="" maxlength="100" class="form-control" name="pdate" id="pdate" required autocomplete="off" onChange="return calculateTime($('#dtime').val(),this.value,$('#ptime').val(),$('#ddate').val());">
                          </div>
                          <div class="col-md-5">
                             <label style="font-size:12pt;"> Pickup Time*</label>
                            <select class="form-control" name="ptime" id="ptime" required onChange="return calculateTime($('#dtime').val(),$('#pdate').val(),this.value,$('#ddate').val());">
                            	<option value="">Select Time</option>
                            	<?php

								for ($i = 6; $i < 24; $i++) {
									$num = $i > 23 ? $i - 24 : $i;
									//$num = $num < 10 ? "0$num" : $num;
									$ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
									//$select = 
									echo "<option value=\"$num:00\"> $num:00 $ampm</option>\n";
									
								}
								
								?>
                            </select>
                           
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group">
                          <div class="col-md-7">
                              <label style="font-size:12pt;"> Drop-off Date *</label>
                            <input type="text" value="" maxlength="100" class="form-control" name="ddate" id="ddate" required autocomplete="off" onBlur="return calculateTime($('#dtime').val(),$('#pdate').val(),$('#ptime').val(),this.value);">
                          </div>
                          <div class="col-md-5">
                             <label style="font-size:12pt;"> Drop-off Time*</label>
                            <select class="form-control" name="dtime" id="dtime" required onChange="return calculateTime(this.value,$('#pdate').val(),$('#ptime').val(),$('#ddate').val());">
                            	<option value="">Select Time</option>
                            	<?php

								for ($i = 6; $i < 24; $i++) {
									$num = $i > 23 ? $i - 24 : $i;
									//$num = $num < 10 ? "0$num" : $num;
									$ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
									//$select = 
									echo "<option value=\"$num:00\"> $num:00 $ampm</option>\n";
									
								}
								
								?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin:15px;">
                        <div class="col-md-4"></div>
                        <div class="d-col-m4">
                          <input type="submit" value="SEARCH" class="btn btn-primary mb-xl" data-loading-text="Loading...">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
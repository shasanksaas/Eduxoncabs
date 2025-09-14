<header>
          <div class="r-header r-header-inner r-header-strip-01">
            <div class="r-header-strip r-header-strip-01">
              <div class="container">
                <div class="row clearfix">
                  <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="r-logo">
                      <a href="#" class="d-inline-block"><img src="img/Eduxoncabs.png" style="height:40px; width:101px; margin-left:10px;" class="img-fluid d-block" alt="Eduxoncabs"></a>
                    </div>
                    <a href="javaScript:void(0)" class="menu-icon"> <i class="fa fa-bars"></i> </a>
                  </div>
                  <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 col-xs-12 pr-0">
                    
                    <div class="r-nav-section float-right">
                      <nav>
                        <ul>
                          <!--<li class="r-has-child">
                            <a href="index.html">HOME</a>
                            <ul class="pl-0 ml-0">
                              <li><a href="index.html">Home 01</a></li>
                              <li><a href="index-02.html">Home 02</a></li>
                              <li><a href="index-03.html">Home 03</a></li>
                              <li><a href="index-04.html">Home 04</a></li>
                            </ul>
                          </li>
                          <li class="r-has-child">
                            <a href="about.html">ABOUT US</a>
                            <ul class="pl-0 ml-0">
                              <li><a href="faq.html">Faq</a></li>
                            </ul>
                          </li>
                          <li class="r-has-child">
                            <a href="car-listing.html">VEHICLES</a>
                            <ul class="pl-0 ml-0">
                              <li><a href="car-list-map.html">Car List Map</a></li>
                              <li><a href="car-booking.html">Car Booking</a></li>
                            </ul>
                          </li>
                          <li><a href="gallery.html">GALLERY</a></li>
                          <li><a href="drivers.html">DRIVERS</a></li>
                          <li><a href="contact.php">CONTACT US</a></li>-->

                          <li > <a class="" href="/"> Home </a> </li>
                      	  <!--<li class=""> <a href="about-self-drive-car-rental.php"> About Us </a> </li>-->
                      	  <li class=""> <a href="about-us.php"> About Us </a> </li>
                          <li class="r-has-child">
                            <a href="all-cars-for-self-drive-bhubaneswar.php">All Cars</a>
                            <ul class="pl-0 ml-0">
                              <li><a href="self-drive-car-rental-bhubaneswar-airport.php">Airport Location</a></li>
                              <!--<li><a href="allcars-self-drive-car.php?city=3">Patia Location</a></li>-->
                            </ul>
                          </li>
                          <li class=""> <a href="all-bikes-bike-for-rental-bhubaneswar.php"> All Bikes </a> </li>
                          <li class=""> <a href="contact-us.php"> Contact </a> </li>
                          <li class=""> <a href="faq.php"> FAQ </a> </li>
                          <li class=""> <a href="profile.php"> User Profile </a> </li>
                          <!--<li > <a  href="https://www.instamojo.com/@eduxon116/" target="_blank"> Pay Now </a> </li>-->
                          <li > <a href="https://razorpay.me/@eduxoncars" target="_blank" rel="noopener noreferrer">Pay Now</a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="r-slider r-slider-02">  
              <div class="r-slider owl-carousel" id="defaultHomeSlider">
              <?php
			  	$getBanner = $dbObj->fetch_data("tbl_banner","isbanner = 1","banner_sequence ASC");
				foreach($getBanner as $key){
			  ?>
                <div class="r-slider-item">
                  <img src="uploadedDocument/banner/<?php echo $key['banner_image'];?>" class="img-fluid d-block m-auto" alt="banner_image" loading="lazy">
                  <div class="container" style="margin-top:30px;">
                    <div class="r-slider-top-content">
                      <?php echo $key['banner_desc'];?>
                      
                      <a href="https://play.google.com/store/apps/details?id=www.eduxoncabs.com.eduxoncabs" 
                         target="_blank" 
                           rel="noopener noreferrer">

                          <img src="img/download_android.png" />
                          </a>
                          
                    </div>
                  </div>
                </div>
              <?php }?>  
              </div>


            </div>
            <div class="r-slider-serach form-search dark" style="margin-top:30px;">
              <form method="" name='search-form' id='search-form' action="all-cars-for-self-drive-bhubaneswar.php" >
              <input type="hidden" name="act" value="searchcabs"/>
                  <div class="form-title form-title-large">
                      <span class="r-form-icon"><img src="assets/images/footer-form-icon.png" alt="footer-form-icon"></span>
                      <h2 style="color:#fff;">Search Your <b>Best Vehicles</b></h2>
                      <small> 20+ CARS TYPE &amp; BRANDS </small>
                  </div>
                  <div class="row row-inputs">
                    <div class="col-sm-12">
                        <div class="form-group has-icon has-label">
                            <label>Vehicle type*</label>
                            <select class="form-control" name="vehicle" id="vehicle" required>
                              
                                <option value="1">Cars</option>
                                <option value="2">Bikes</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row row-inputs">
                    <div class="col-sm-12">
                        <div class="form-group has-icon has-label">
                            <label>City*</label>
                            <select class="form-control" name="city" id="city" required>
                            	<?php 
$city_data1 = $dbObj->fetch_data("tbl_city", "status= '1' order by city");
foreach ($city_data1 as $data) {
    
                                 ?>
                                <option value="<?=$data['id']?>"><?=$data['city']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row row-inputs">
                    <div class="col-sm-12">
                        <div class="form-group has-icon has-label">
                            <label>Pick Up Location *</label>
                            <select class="form-control" name="pickuploc" id="pickuploc" required>
                              <option value="">select</option>
                                <?php 
$get_location_data1 = $dbObj->fetch_data("location", "city_id = '1'");
foreach ($get_location_data1 as $data1) {
    $pic_Point = $data1['pickup_point'];
                                 ?>
                                <option value="<?=$data1['id'];?>"><?=$pic_Point?></option>
<?php 
}
?>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row row-inputs">
                    <div class="col-sm-12">
                        <div class="form-group has-icon has-label">
                            <label>Drop-off Location *</label>
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
                  
                  <div class="row row-inputs">
                    <div class="col-sm-6">
                        <div class="form-group has-icon has-label label" id="datetimepicker2" data-target-input="nearest">
                            <label>Picking Up Date</label>
                            <input type="text" value=""  placeholder="yyyy-mm-dd" maxlength="100" class="form-control" name="pdate" id="pdate" required autocomplete="off" onChange="return calculateTime($('#dtime').val(),this.value,$('#ptime').val(),$('#ddate').val());">
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-icon has-label date" id="datetimepicker3" data-target-input="nearest">
                            <label>Picking Up Hour</label>
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
                            <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                        </div>
                    </div>
                  </div>
                  <div class="row row-inputs">
                    <div class="col-sm-6">
                        <div class="form-group has-icon has-label label" id="datetimepicker4" data-target-input="nearest">
                            <label>Dropping Off Date</label>
                            <input type="text" value="" placeholder="yyyy-mm-dd" maxlength="100" class="form-control" name="ddate" id="ddate" required autocomplete="off" onBlur="return calculateTime($('#dtime').val(),$('#pdate').val(),$('#ptime').val(),this.value);">
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group has-icon has-label date" id="datetimepicker5" data-target-input="nearest">
                            <label>Dropping Off Hour</label>
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
                            <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                        </div>
                    </div>
                  </div>
                  <div class="form-footer">
                    <div class="inner clearfix">
                        <button type="submit" class="btn m-auto d-block btn-full" style="background:#6C0D12; border-radius:4px;">Find Vehicle</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </header>
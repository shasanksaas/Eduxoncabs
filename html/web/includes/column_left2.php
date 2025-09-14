<?php $admin_type = $_SESSION[SES]['admin']['admin_type'];?>
<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
				
                    <li>
                        <a href="index.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                    </li>
                   
                    
					 <li>
                        <a href="my-account.php" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i> <span class="nav-label">My Account</span> </a>
                    </li>
                    
                   <?php if($admin_type==1){?>                  
                   <!--<li>
                        <a href="admin-manager.php" class=" hvr-bounce-to-right"><i class="fa fa-users nav_icon"></i> <span class="nav-label">User Manager</span> </a>
                    </li>-->
                    
                    <?php }?>
                    
                   
                    <?php if($admin_type==1){?>                  
                   <li>
                        <a href="page-management.php" class=" hvr-bounce-to-right"><i class="fa fa-globe nav_icon"></i> <span class="nav-label">Website CMS</span> </a>
                    </li>
                    <li>
                        <a href="contact.php" class=" hvr-bounce-to-right"><i class="fa fa-ticket nav_icon"></i> <span class="nav-label">Manage Newsletter</span> </a>
                    </li>
                    
                    <?php }?>
                   
                    
                   
                    
                     <?php if($admin_type==1){?>                  
                   <li>
                        <a href="cabs.php" class=" hvr-bounce-to-right"><i class="fa fa-taxi nav_icon"></i> <span class="nav-label">Manage Cabs</span> </a>
                    </li>
                    
                    <?php }?>
                    
                    <?php if($admin_type==1){?>                  
                   <li>
                        <a href="book.php" class=" hvr-bounce-to-right"><i class="fa fa-ticket nav_icon"></i> <span class="nav-label">Manage Car Booking</span> </a>
                    </li>
                    
                   <li>
                        <a href="revenue-report.php" class=" hvr-bounce-to-right"><i class="fa fa-bar-chart nav_icon"></i> <span class="nav-label">Car Revenue Report</span></a>
                    </li>
                    
                                     
                   <li>
                        <a href="bikes.php" class=" hvr-bounce-to-right"><i class="fa fa-motorcycle nav_icon"></i> <span class="nav-label">Manage Bikes</span> </a>
                    </li>
                    
                                  
                   <li>
                        <a href="bikebook.php" class=" hvr-bounce-to-right"><i class="fa fa-ticket nav_icon"></i> <span class="nav-label">Manage Bike Booking</span> </a>
                    </li>
                    
                                     
                   <li>
                        <a href="managebanner.php" class=" hvr-bounce-to-right"><i class="fa fa-image nav_icon"></i> <span class="nav-label">Gallery Management</span> </a>
                    </li>
 <li>
                        <a href="coupon.php" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i> <span class="nav-label">Manage Coupon </span> </a>
                    </li>
     <li> <a href="location.php" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i> <span class="nav-label">Locations </span> </a>
                    </li>
                    
                    <?php }
                     if($admin_type==4){ ?>
                    <li>
                        <a href="book.php?q=Cuttack" class=" hvr-bounce-to-right"><i class="fa fa-ticket nav_icon"></i> <span class="nav-label">Manage Car Booking</span> </a>
                    </li>
                    
                                  
                   <li>
                        <a href="bikebook.php?q=Cuttack" class=" hvr-bounce-to-right"><i class="fa fa-ticket nav_icon"></i> <span class="nav-label">Manage Bike Booking</span> </a>
                    </li>
                    
                    
                    <?php } ?>
                    
                    <li>
                        <a href="export-contact.php" class=" hvr-bounce-to-right"><i class="fa fa-ticket nav_icon"></i> <span class="nav-label">Contact Export</span> </a>
                    </li>
                     <li> <a href="blockdl.php" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i> <span class="nav-label">Block DL </span> </a></li>
                     <li> <a href="minhour.php" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i> <span class="nav-label">Manage min hour </span> </a></li>
                    
                </ul>
            </div>
			</div>
<div class="drop-men" >
<?php if(isLoggedin()) { ?>

		        <ul class=" nav_1">
		           
		    		
					<li class="dropdown">
		              <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret">signed in as: <b><?=$_SESSION[SES]['admin']['admin_user']?></b><i class="caret"></i></span><i class="fa fa-user fa-3x"></i></a>
		              <ul class="dropdown-menu " role="menu">
		                <li><a href="logout.php" class="signout"><i class="fa fa-power-off"></i>Signout</a></li>
		                
		              </ul>
		            </li>
		           
		        </ul>
      <?php } else {echo '&nbsp';}?>          
		     </div>
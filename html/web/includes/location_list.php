<script language="javascript">
function deleteMessage(u_id){
	if(confirm("Are you sure to delete?")){
		document.location.href="locationAction.php?act=deletelocation&id="+u_id;
	}
}
function deletecity(c_id){
if(confirm("Are you sure to delete?")){
		document.location.href="locationAction.php?act=deletecity&id="+c_id;
	}
}
</script>

<div class="col-md-12">
<a href="location.php?q=addcity" class="btn btn-success float-right" style="margin-bottom:1%;">Add New City</a>
</div>
<div class="col-md-12 ">
			
				<div class="col-md-12 top-content">
                <section id="no-more-tables">
               
                    <table class="table-bordered table-striped table-condensed cf">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>City</th>
                            
                            <th colspan="3">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php	
							$i = 1;		
							$getdta = $dbObj->fetch_data("tbl_city","");
							$count = $dbObj->countRec("tbl_city","");
							if($count > 0){
							foreach($getdta as $key1){
						?>
                            <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo wordwrap($key1['city'],15,"<br>\n");?></td>
                              
                             
                              <td><a href="<?=$_curpage?>?q=editcity&id=<?php echo $key1['id'];?>"> <img border="0" src="images/edit.png" align="Edit" title="Edit" /></a></td>
                              <td><?php if($key1['status']=="1") {  ?>
                                <a href="locationAction.php?act=disablecity&id=<?php echo $key1['id'];?>"><img src="images/enable.png" border="0" alt="Click to Disable" title="Click to Disable"/></a>
                                <?php
                                } elseif ($key1['status']=="0") { ?>
                                <a href="locationAction.php?act=enablecity&id=<?php echo $key1['id'];?>"><img src="images/disable.png" border="0" alt="Enable" title="Click to Enable"/></a>
                                <?php
                                } ?>
                              </td>

                              <td><a href="javascript:void(0)"><img border="0" src="images/delete.png" align="Delete" title="Delete" onClick="deletecity(<?php echo $key1['id'];?>)" /></a> </td>
                          </tr>
                        <?php $i++; } } else{ ?>
                        	<tr><td colspan="6">Sorry No Record Found!!!</td></tr>
                        <?php }?>  
                        </tbody>
                    </table>
                    
                      
                   
				</section>
				</div>
			
	</div>
<br>

<div class="col-md-12">
<a href="location.php?q=add" class="btn btn-success float-right" style="margin-bottom:1%;margin-top:2%;">Add New Location</a>
</div>


	<div class="col-md-12 ">
			
				<div class="col-md-12 top-content">
                <section id="no-more-tables">
               
                    <table class="table-bordered table-striped table-condensed cf">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>pickup</th>
                            <th>Drop</th>
                            <th>City</th>
                            <th colspan="3">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php	
							$i = 1;		
							$getdta = $dbObj->fetch_data("location","");
							$count = $dbObj->countRec("location","");
							if($count > 0){
							foreach($getdta as $key){
						?>
                            <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo wordwrap($key['pickup_point'],15,"<br>\n");?></td>
                              <td><?php echo wordwrap($key['drop_point'],10,"<br>\n");?></td>
                              <td><?php echo $key['city_location'];?></td>
                             
                              <td><a href="<?=$_curpage?>?q=edit&id=<?php echo $key['id'];?>"> <img border="0" src="images/edit.png" align="Edit" title="Edit" /></a></td>
                              <td><?php if($key['status']=="1") {  ?>
                                <a href="locationAction.php?act=disable&id=<?php echo $key['id'];?>"><img src="images/enable.png" border="0" alt="Click to Disable" title="Click to Disable"/></a>
                                <?php
                                } elseif ($key['status']=="0") { ?>
                                <a href="locationAction.php?act=enable&id=<?php echo $key['id'];?>"><img src="images/disable.png" border="0" alt="Enable" title="Click to Enable"/></a>
                                <?php
                                } ?>
                              </td>

                              <td><a href="javascript:void(0)"><img border="0" src="images/delete.png" align="Delete" title="Delete" onClick="deleteMessage(<?php echo $key['id'];?>)" /></a> </td>
                          </tr>
                        <?php $i++; } } else{ ?>
                        	<tr><td colspan="6">Sorry No Record Found!!!</td></tr>
                        <?php }?>  
                        </tbody>
                    </table>
                    
                      
                   
				</section>
				</div>
			
	</div>

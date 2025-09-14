<script language="javascript">
function deleteMessage(u_id){
	if(confirm("Are you sure to delete?")){
		document.location.href="CabsAction.php?act=deletecab&id="+u_id;
	}
}
</script>
<div class="col-md-12"><a href="cabs.php?q=add" class="btn btn-success float-right" style="margin-bottom:1%;">Add New Cab</a></div>

	<div class="col-md-12 ">
			
				<div class="col-md-12 top-content">
                <section id="no-more-tables">
               
                    <table class="table-bordered table-striped table-condensed cf">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Car Name</th>
                            <th>Cost/24 Hr.</th>
                            <th>Image</th>
                            <th colspan="3">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php	
							$i = 1;		
							$getdta = $dbObj->fetch_data("tbl_cabs","","cost ASC");
							$count = $dbObj->countRec("tbl_cabs","","cost ASC");
							if($count > 0){
							foreach($getdta as $key){
						?>
                            <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $key['car_nme'];?></td>
                              <td><?php echo $key['cost'];?></td>
                              <td><img src="../uploadedDocument/cab/<?php echo $key['car_image'];?>" width="200" /></td>
                              <!--<td><?php if($key['unavail_datefrm'] == '0000-00-00' || $key['unavail_dateto'] == '0000-00-00'){ echo "-----"; }else{ echo date('d-M-Y',strtotime($key['unavail_datefrm']))." to ".date('d-M-Y',strtotime($key['unavail_dateto'])); }?></td>-->
                              <td><a href="<?=$_curpage?>?q=edit&id=<?php echo $key['id'];?>"> <img border="0" src="images/edit.png" align="Edit" title="Edit" /></a></td>
                              <td><?php if($key['status']=="1") {  ?>
                                <a href="CabsAction.php?act=disable&id=<?php echo $key['id'];?>"><img src="images/enable.png" border="0" alt="Click to Disable" title="Click to Disable"/></a>
                                <?php
                                } elseif ($key['status']=="0") { ?>
                                <a href="CabsAction.php?act=enable&id=<?php echo $key['id'];?>"><img src="images/disable.png" border="0" alt="Enable" title="Click to Enable"/></a>
                                <?php
                                } ?>
                              </td>
                              
                              <td><a href="javascript:void(0)"><img border="0" src="images/delete.png" align="Delete" title="Delete" onClick="deleteMessage(<?php echo $key['id'];?>)" /></a> </td>
                          </tr>
                        <?php $i++; } }else{ ?>
                        	<tr><td colspan="6">Sorry No Record Found!!!</td></tr>
                        <?php }?>  
                        </tbody>
                    </table>
                    
                      
                   
				</section>
				</div>
			
	</div>

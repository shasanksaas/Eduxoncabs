<script language="javascript">

function deletecoupon(c_id){
if(confirm("Are you sure to delete?")){
		document.location.href="couponAction.php?act=deletecoupon&id="+c_id;
	}
}
</script>

<div class="col-md-12">
<a href="coupon.php?q=add" class="btn btn-success float-right" style="margin-bottom:1%;">Add New Coupon</a>
</div>
<div class="col-md-12 ">
			
				<div class="col-md-12 top-content">
                <section id="no-more-tables">
               
                    <table class="table-bordered table-striped table-condensed cf">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Coupon</th>
                            <th>Percent</th>
                             <th>From</th>
                             <th>To</th>
                            
                            <th colspan="3">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php	
							$i = 1;		
							$getdta = $dbObj->fetch_data("master_gv","");
							$count = $dbObj->countRec("master_gv","");
							if($count > 0){
							foreach($getdta as $key1){
						?>
                            <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $key1['gv_code'];?></td>
                              <td><?php echo $key1['gv_percent'];?>%</td>
                              <td><?php echo substr($key1['from_date'],0,10);?></td>
                              <td><?php echo substr($key1['to_date'],0,10);?></td>
                              
                             
                              <td><a href="<?=$_curpage?>?q=edit&id=<?php echo $key1['id'];?>"> <img border="0" src="images/edit.png" align="Edit" title="Edit" /></a></td>
                              <td><?php if($key1['status']=="1") {  ?>
                                <a href="couponAction.php?act=disable&id=<?php echo $key1['id'];?>"><img src="images/enable.png" border="0" alt="Click to Disable" title="Click to Disable"/></a>
                                <?php
                                } elseif ($key1['status']=="0") { ?>
                                <a href="couponAction.php?act=enable&id=<?php echo $key1['id'];?>"><img src="images/disable.png" border="0" alt="Enable" title="Click to Enable"/></a>
                                <?php
                                } ?>
                              </td>

                              <td><a href="javascript:void(0)"><img border="0" src="images/delete.png" align="Delete" title="Delete" onClick="deletecoupon(<?php echo $key1['id'];?>)" /></a> </td>
                          </tr>
                        <?php $i++; } } else{ ?>
                        	<tr><td colspan="6">Sorry No Record Found!!!</td></tr>
                        <?php }?>  
                        </tbody>
                    </table>
                    
                      
                   
				</section>
				</div>
			
	</div>




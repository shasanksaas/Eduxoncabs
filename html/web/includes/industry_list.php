<script language="javascript">
function deleteMessage(u_id){
	if(confirm("Are you sure to delete?")){
		document.location.href="IndustryAction.php?act=deleteind&id="+u_id;
	}
}
</script>
<div class="col-md-12"><a href="industry.php?q=add" class="btn btn-success float-right" style="margin-bottom:1%;">Add New Industry</a></div>

	<div class="col-md-12 ">
			
				<div class="col-md-12 top-content">
                <section id="no-more-tables">
               
                    <table class="table-bordered table-striped table-condensed cf">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Industry</th>
                            <th colspan="3">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php	
							$i = 1;		
							$getdta = $dbObj->fetch_data("tbl_industry");
							$count = $dbObj->countRec("tbl_industry");
							if($count > 0){
							foreach($getdta as $key){
						?>
                            <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $key['industry'];?></td>
                              <td><a href="<?=$_curpage?>?q=edit&id=<?php echo $key['id'];?>"> <img border="0" src="images/edit.png" align="Edit" title="Edit" /></a></td>
                              <td><?php if($key['status']=="1") {  ?>
                                <a href="IndustryAction.php?act=disable&id=<?php echo $key['id'];?>"><img src="images/enable.png" border="0" alt="Click to Disable" title="Disable"/></a>
                                <?php
                                } elseif ($key['status']=="0") { ?>
                                <a href="IndustryAction.php?act=enable&id=<?php echo $key['id'];?>"><img src="images/disable.png" border="0" alt="Enable" title="Click to Enable"/></a>
                                <?php
                                } ?>
                              </td>
                              
                              <td><a href="javascript:void(0)"><img border="0" src="images/delete.png" align="Delete" title="Delete" onClick="deleteMessage(<?php echo $key['id'];?>)" /></a> </td>
                          </tr>
                        <?php $i++; } }else{ ?>
                        	<tr><td colspan="5">Sorry No Record Found!!!</td></tr>
                        <?php }?>  
                        </tbody>
                    </table>
                    
                      
                   
				</section>
				</div>
			
	</div>

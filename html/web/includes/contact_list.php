<script language="javascript">
function deleteMessage(u_id){
	if(confirm("Are you sure to delete?")){
		document.location.href="ContactAction.php?act=deletecon&id="+u_id;
	}
}
</script>

	<div class="col-md-12 ">
			
				<div class="col-md-12 top-content">
                <section id="no-more-tables">
                    <table class="table-bordered table-striped table-condensed cf">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            
                            <th>phone</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php	
							$getdta = $dbObj->fetch_data("tbl_customer","customer_name='Subscriber'");
							$count = $dbObj->countRec("tbl_customer","customer_name='Subscriber'");
							if($count > 0){
							$i = 1;
							foreach($getdta as $key){
						?>
                            <tr>
                              <td><?php echo $i;?></td>
                              
                              <td><?php echo $key['phone_number'];?></td>
                              <td><a href="javascript:void(0)"><img border="0" src="images/delete.png" align="Delete" title="Delete" onClick="deleteMessage(<?php echo $key['cust_id'];?>)" /></a> </td>
                          </tr>
                        <?php $i++; }
 }else{ ?>
                        	<tr><td colspan="5">Sorry No Record Found!!!</td></tr>
                        <?php }?>  
                        </tbody>
                    </table>
                    
                      
                   
				</section>
				</div>
			
	</div>

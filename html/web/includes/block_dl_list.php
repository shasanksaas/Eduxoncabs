<script language="javascript">
function deletedl(c_id){
if(confirm("Are you sure to delete?")){
		document.location.href="blockdlAction.php?act=deletedl&id="+c_id;
	}
}
</script>
<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" name="frm" action="blockdlAction.php" method="post" enctype="multipart/form-data">
                             <input type="hidden" name="act" value="blockDL" />
                             
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-4 control-label">Enter DL Number</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control1" id="txtDLnumber" name="txtDLnumber" placeholder="DL Number">
                                        
                                    </div>
                                    <div class="col-sm-4">
                                            <button class="btn-primary btn" >Block</button>
                                        </div>
                                    
                                </div>
                              
                            
                              
                                
                               
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                             <table class="table-bordered table-striped table-condensed cf">
                                                <thead>
                                                  <tr>
                                                    <th>S.N.</th>
                                                    <th>DL Number</th>
                                                    
                                                    <th >Actions</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                <?php	
                        							$i = 1;		
                        							$getdta = $dbObj->fetch_data("blocked_dl","");
                        							$count = $dbObj->countRec("blocked_dl","");
                        							if($count > 0){
                        							foreach($getdta as $key1){
                        						?>
                                                    <tr>
                                                      <td><?php echo $i;?></td>
                                                      <td><?php echo $key1['dl_number'];?></td>
                                                    
                        
                                                      <td><a href="javascript:void(0)"><img border="0" src="images/delete.png" align="Delete" title="Delete" onClick="deletedl(<?php echo $key1['id'];?>)" /></a> </td>
                                                  </tr>
                                                <?php $i++; } } else{ ?>
                                                	<tr><td colspan="3">Sorry No Record Found!!!</td></tr>
                                                <?php }?>  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                
                            </form>                
                        </div>
      			</div>
			</div>
	</div>

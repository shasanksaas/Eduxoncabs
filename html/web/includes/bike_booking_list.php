<script language="javascript">
function deleteMessage(u_id){
	if(confirm("Are you sure to delete?")){
		document.location.href="BookAction.php?act=deletecon&id="+u_id;
	}
}
</script>

	<div class="col-md-12 ">
			
				<div class="col-md-12 top-content">
                <section id="no-more-tables">
                    <?php
                                                        
                             if($_GET['q']=='Cuttack'){
                             $city = "Cuttack";
                             $ctk_clr = "color:red";
                             }
                             elseif($_GET['q']=='Bhubaneswar'){
                             $city = "Bhubaneswar";
                             $bbsr_clr = "color:red";
                            }else{
                              $city = "Bhubaneswar";
                             $bbsr_clr = "color:red;";
                            }  
                          $qr = "AND city='$city'";
                     ?>
                     <div>
                           <?php if($admin_type==1){?>
                           <a  href='bikebook.php?q=Bhubaneswar'><span style="<?=$bbsr_clr;?>"> Bhubaneswar</span></a>
                           &nbsp;&nbsp;&nbsp;&nbsp;
                          <a style="margin-right: 150px;" href='bikebook.php?q=Cuttack '> <span style="<?=$ctk_clr;?>"> Cuttack </span></a>
                          <?php }if($admin_type==4){ ?>
                          <a style="margin-right: 150px;" href='bikebook.php?q=Cuttack '> <span style="<?=$ctk_clr;?>"> Cuttack </span></a>
                          <?php } ?>
                     </div>
                    <table class="table-bordered table-striped table-condensed cf">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <!--<th>Booked Car</th>
                            <th>Status</th>
                            <th>Book Date</th>
                            <th>Return Date</th>-->
                            <th colspan="2">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php	
                                                        

							$i = 1;		
							$getdta = $dbObj->fetch_data("tbl_order","status='Completed ' AND vehicle_type='2' $qr ","id DESC limit 0,50");
							$count = $dbObj->countRec("tbl_order");
							if($count > 0){
							foreach($getdta as $key){
						?>
                            <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $key['buyer_name'];?></td>
                              <td><?php echo $key['email'];?></td>
                              <td><?php echo $key['phone'];?></td>
                              <td><?php echo $key['amount'];?></td>
                              <!--<td><?php echo $key['booked_car'];?></td>
                              <td><?php echo $key['status'];?></td>
                              <td><?php echo date("d M Y",strtotime($key['booked_dte']))." ".$key['booked_tme'];?></td>
                              <td><?php echo date("d M Y",strtotime($key['returned_dte']))." ".$key['return_tme'];?></td>-->
                              <td><a href="javascript:void(0)"><img border="0" src="images/delete.png" align="Delete" title="Delete" onClick="deleteMessage(<?php echo $key['id'];?>)" /></a> </td>
                              <td><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal<?php echo $i;?>"><img src="images/resume.png" title="Details" /></a><div class="modal fade" id="myModal<?php echo $i;?>" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Booking Details</h4>
                                    </div>
                                    <div class="modal-body">
                                      <table border="1">
                                      	<tr><td>Name</td><td><?php echo $key['buyer_name'];?></td></tr>
                                        <tr><td>Email</td><td><?php echo $key['email'];?></td></tr>
                                        <tr><td>Phone</td><td><?php echo $key['phone'];?></td></tr>
                                        <tr><td>DOB</td><td><?php echo $key['customer_dob'];?></td></tr>
                                        <tr><td>Amount</td><td><?php echo $key['amount'];?></td></tr>
                                        <tr><td>Booked Vehicle</td><td><?php echo $key['booked_car'];?></td></tr>
                                        <tr><td>Status</td><td><?php echo $key['status'];?></td></tr>
                                        <tr><td>Book Date</td><td><?php echo date("d M Y",strtotime($key['booked_dte']))." ".$key['booked_tme'];?></td></tr>
                                        <tr><td>Return Date</td><td><?php echo date("d M Y",strtotime($key['returned_dte']))." ".$key['return_tme'];?></td></tr>
                                        <tr><td>Security Fees Payment type</td><td><?php if($key['secur_pay_type'] == 1){ echo "Online Paid";}else if($key['secur_pay_type'] == 2){ echo "Cash Payment";}else{ echo "Old Data or not mentioned";}?></td></tr>
                                        <?php 
$getdta = $dbObj->fetch_data("tbl_customer","phone_number='".$key['phone']."'","");
							foreach($getdta as $key){ if($key['license'] != ''){?>

                                        <tr><td colspan='2' align='center'><a href="../uploadedDocument/customerlicense/<?php echo $key['license'];?>" target="_blank">Click to view licence</a></td></tr>
<?php } } ?>
                                      </table>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div></td>
                              
                          </tr>
                        <?php $i++; } }else{ ?>
                        	<tr><td colspan="10">Sorry No Record Found!!!</td></tr>
                        <?php }?>  
                        </tbody>
                    </table>
                    
                      
                   
				</section>
				</div>
			
	</div>
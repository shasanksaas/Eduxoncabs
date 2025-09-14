<script language="javascript">
function deleteMessage(u_id){
	if(confirm("Are you sure to delete this account?")){
		document.location.href="AdminAction.php?act=deleteadmin&id="+u_id;
	}
}
</script>
<div class="col-md-12"><!--<a href="admin-manager.php?q=add" class="btn btn-success float-right" style="margin-bottom:1%;">Add New Admin</a>--></div>

	<div class="col-md-12 ">
			
				<div class="col-md-12 top-content">
                <section id="no-more-tables">
                <?php
                    $res = $adminObj->getAdminUser();
                    $total = $res['NO_OF_ITEMS'];
                    if($total>0) {
                ?>
                    <table class="table-bordered table-striped table-condensed cf">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>User Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Admin Type</th>
                            <th colspan="4">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php			
							for($i=0;$i<$total;$i++) { 
							$admin_id = $res['oDATA'][$i]['admin_id'];
							$admin_user = outText($res['oDATA'][$i]['admin_user']);
							$admin_name = outText($res['oDATA'][$i]['admin_name']);
							$admin_email = outText($res['oDATA'][$i]['admin_email']);
							$admin_phone = outText($res['oDATA'][$i]['admin_phone']);
							$admin_type = outText($res['oDATA'][$i]['admin_type']);
							$status = outText($res['oDATA'][$i]['admin_status']);
							if($admin_type==1) { $type="Superadmin"; } else { $type="Admin"; }
						?>
                          <tr>
                              <td><?=($i+1)?></td>
                              <td><?=$admin_user?></td>
                              <td><?=$admin_name?></td>
                              <td><a href="mailto:<?=$admin_email?>">
                                <?=$admin_email?>
                                </a></td>
                              <td><?=$admin_phone?></td>
                              <td><?=$type?></td>
                              <td><a href="<?=$_curpage?>?q=edit&id=<?=md5($admin_id)?>"> <img border="0" src="images/edit.png" align="Edit" title="Edit" /></a></td>
                              <td><?php if($status=="1") {  ?>
                                <a href="AdminAction.php?act=disable&id=<?=$admin_id?>"><img src="images/enable.png" border="0" alt="Click to Disable" title="Disable"/></a>
                                <?php
                                } elseif ($status=="0") { ?>
                                <a href="AdminAction.php?act=enable&id=<?=$admin_id?>"><img src="images/disable.png" border="0" alt="Enable" title="Click to Enable"/></a>
                                <?php
                                } ?>
                              </td>
                              <td><a href="<?=$_curpage?>?q=changepass&id=<?=md5($admin_id)?>"><img border="0" src="images/password.png" align="Change Password" title="Change Password" /></a></td>
                              <td><a href="javascript:void(0)"><img border="0" src="images/delete.png" align="Delete" title="Delete" onClick="deleteMessage(<?=$admin_id?>)" /></a> </td>
                          </tr>
                        <?php } ?>  
                        </tbody>
                    </table>
                <?php } ?>    
                      
                   
				</section>
				</div>
			
	</div>

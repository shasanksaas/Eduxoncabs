<script language="javascript">
function deleteMessage(u_id){
	if(confirm("Are you sure to delete this ?")){
		document.location.href="NewsAction.php?act=del&id="+u_id;
	}
}
</script>
 <?php
$total_page = $newsObj->getTotalPages(); 
$page = isset($_GET['page'])?(int)$_GET['page']:0;
$orderby = isset($_SESSION[SES]['news']['orderby'])?$_SESSION[SES]['news']['orderby']:"id";
$order = isset($_SESSION[SES]['news']['order'])?$_SESSION[SES]['news']['order']:"desc";
$res = $newsObj->getAllNews($page*PAGE_LIMIT,$orderby, $order); 
$total = $res['NO_OF_ITEMS'];
?>
<div class="col-md-12"><a href="news.php?q=add" class="btn btn-success float-right" style="margin-bottom:1%;">Add New News</a></div>

	<div class="col-md-12 ">
			
				<div class="col-md-12 top-content">
                <section id="no-more-tables">
                
                    <table class="table-bordered table-striped table-condensed cf">
                        <thead>
                          <tr>
                              <th>S.N.</th>
                              <th>Publish Date</th>
                              <th>Title</th>
                              <th colspan="3">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                       <?php			
						for($i=0;$i<$total;$i++) { 
						$id = $res['oDATA'][$i]['id'];
						$publish_date = outText($res['oDATA'][$i]['publish_date']);
						$title = outText($res['oDATA'][$i]['title']);
						$status = outText($res['oDATA'][$i]['status']);
						$new = outText($res['oDATA'][$i]['new']);
						$sort_order = outText($res['oDATA'][$i]['sort_order']);
						?>
                          <tr>
                              <td><?=($page*PAGE_LIMIT)+$i+1?></td>
                              <td><?=$publish_date?></td>
                              <td><?=$title?></td>
                              <td><a href="<?=$_curpage?>?q=edit&id=<?=md5($id)?>"> <img border="0" src="images/edit.png" align="Edit" title="Edit" /></a></td>
                              <td><?php if($status=="1") {  ?>
                                <a href="NewsAction.php?act=disable&id=<?=$id?>"><img src="images/enable.png" border="0" alt="Click to Disable" title="Disable"/></a>
                                <?php
                                } elseif ($status=="0") { ?>
                                <a href="NewsAction.php?act=enable&id=<?=$id?>"><img src="images/disable.png" border="0" alt="Enable" title="Click to Enable"/></a>
                                <?php
                                } ?>
                              </td>
                              <td><a href="javascript:void(0)"><img border="0" src="images/delete.png" align="Delete" title="Delete" onClick="deleteMessage(<?=$id?>)" /></a> </td>
                                
                             
    </tr>
                        <?php } ?>  
                        </tbody>
                    </table>
                
                      
                   
				</section>
				</div>
			
	</div>

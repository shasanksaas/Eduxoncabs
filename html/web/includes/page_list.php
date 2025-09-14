<?php
//page_list.php
$total_page = $pageObj->getTotalPages(); 
$page = isset($_GET['page'])?(int)$_GET['page']:0;
$orderby = isset($_SESSION[SES]['page-management']['orderby'])?$_SESSION[SES]['page-management']['orderby']:"page_id";
$order = isset($_SESSION[SES]['page-management']['order'])?$_SESSION[SES]['page-management']['order']:"desc";
$res = $pageObj->getAllPages($page*PAGE_LIMIT, $orderby, $order); 
$total = $res['NO_OF_ITEMS'];
?>



  <?php
	if($total>0) { ?>


	<div class="col-md-12 ">
			
				<div class="col-md-12 top-content">
                <section id="no-more-tables">
                
                    <table class="table-bordered table-striped table-condensed cf">
                        <thead>
                          <tr>
                              <th>S.N.</th>
                              <th>Page Name</th>
                              <th>Page Type</th>
                              <th>Last Updated</th>
                              <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
    <?php			
for($i=0;$i<$total;$i++) { 
	$page_id = outText($res['oDATA'][$i]['page_id']);
	$page_name = outText($res['oDATA'][$i]['page_name']);
	$page_updated = formatDate(outText($res['oDATA'][$i]['page_updated']));
	$page_type = strtoupper(outText($res['oDATA'][$i]['page_type'])); ?>
    <tr>
      <td><?=($page*PAGE_LIMIT)+$i+1?></td>
      <td><?=$page_name?></td>
	  <td><?=$page_type?></td>
      <td><?=$page_updated?></td>
      <td><a href="<?=$_curpage?>?q=edit&pid=<?=$page_id?>&page=<?=$page?>"><img border="0" src="images/edit.png" align="Edit" title="Edit" /></a></td>
      <!--<td width="50"><a href="PageAction.php?act=delpage&pid=<?=$page_id?>&page=<?=$page?>" onclick="return confirm('Are You Sure Delete This Page?')"><img border="0" src="images/delete.png" align="Delete" title="Delete" /></a></td>-->
    </tr>
    <?php } ?>
	</tbody>
                    </table>
                
                      
                   
				</section>
				</div>
			
	</div>

  <?php } ?>


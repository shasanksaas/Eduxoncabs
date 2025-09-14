<?php
$c_menu_id = isset($_GET['mid'])?$_GET['mid']:"";
$c_menu_id = (int)$c_menu_id;
$res = $menuObj->getMenu($c_menu_id); 
$total = $res['NO_OF_ITEMS'];
?>
<div class="content_header">
<div class="heading flleft">Manage Sub-Menu Of <u><i><?=$_SESSION[SES]['admin']['menu_name'][$c_menu_id]?></i></u></div>
<div class="heading flright">
<a href="<?=$_curpage?>?q=add&mid=<?=$c_menu_id?>" class="heading flleft">Add Sub-Menu</a> &nbsp;|&nbsp; 
<a href="<?=$_curpage?>" class="heading">&laquo; BACK</a></div>
</div>
<div class="bodycontent">
<?php

if($total>0) { ?>
<table width="99%" border="1" bordercolor="#CCCCCC" cellspacing="0" cellpadding="3" align="center" class="datagrid">
  <tr>
	<th width="44">SL.No</th>
	<th width="146">Title</th>
	<th width="133">Associates Page</th>
	<th width="53">Position</th>
	<th width="342">Actions</th>
  </tr>
<?php			
for($i=0;$i<$total;$i++) { 
	$menu_id = $res['oDATA'][$i]['menu_id'];
	$menu_name = stripslashes($res['oDATA'][$i]['menu_name']);
	$_SESSION['iitadmin']['menu_name'][$menu_id] = $menu_name;
	$menu_page_name = stripslashes($res['oDATA'][$i]['page_name']);
	$page_name = stripslashes($res['oDATA'][$i]['page_name']);
	$page_id = $res['oDATA'][$i]['page_id'];
	$menu_position = $res['oDATA'][$i]['menu_position']; ?>		
 <tr>
	<td><?=($i+1)?></td>
	<td><?=$menu_name?></td>
	<td><a href="page.php?q=edit&pid=<?=$page_id?>"><?=$menu_page_name?></a></td>
	<td><?=$menu_position?></td>
	<td>
    <a href="menu.php?q=edit&mid=<?=$menu_id?>">Edit</a> || 
    <a href="menu.php?q=add&mid=<?=$menu_id?>">Add Submenu</a> ||  
    <a href="menu.php?q=mngsubmenu&mid=<?=$menu_id?>">Manage Submenu</a> ||  
    <a href="menuAction.php?act=del&mid=<?=$menu_id?>" onclick="confirm('Are you sure to delete this menu ?')">Delete</a>
    </td>
  </tr>
<?php } ?>          
</table>
<?php } ?>
</div>
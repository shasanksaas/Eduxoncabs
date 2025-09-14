<?php
//page_add.php
$required = "<font color='#FF0000' size='1'>*</font>";
if(isset($_SESSION[SES]['pagedata'])) {
	$pdata = $_SESSION[SES]['pagedata'];
	extract($pdata);
	if($pdata['page_content_static']!="") {
		$page_contents = $pdata['page_content_static'];
	}
	else if($pdata['page_content_dynamic']!="") {
		$page_contents = $pdata['page_content_dynamic'];
	}
	else {
		$page_contents = "";
	}
	unset($_SESSION[SES]['pagedata']);
}
else {
	$pdata = array();
}
?>

<div class="content_header">
  <div class="heading flleft">Add New Page</div>
  <div class="heading flright"><a href="<?=$_curpage?>">&laquo; Back</a></div>
</div>
<div class="bodycontent">
  <form action="PageAction.php" method="post" enctype="multipart/form-data" name="pageaddfrm" onsubmit="return page_valid(this);">
    <input type="hidden" name="act" value="addpage" />
	<div id="validation_div" class="validation_error"></div>
     <table width="100%" border="0" cellspacing="0" cellpadding="3" align="center">
      <tr>
        <td align="left" class="label" width="150">Page Name <?=$required?><br />
          <span class="hint">(e.g. Page Name)</span></td>
        <td align="center">:</td>
        <td align="left"><input type="text" name="page_name" value="<?=$pdata['page_name']?>" size="60" onblur="fillURL(this.value,'page_url')"/></td>
      </tr>
      <tr>
        <td align="left" class="label">Page URL <?=$required?><br />
          <span class="hint">(e.g. page-url)</span></td>
        <td align="center">:</td>
        <td align="left"><input type="text" name="page_url" id="page_url" value="<?=$pdata['page_url']?>" size="60" title="It is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens."/></td>
      </tr>
	  <tr>
        <td align="left" class="label">Page Type <?=$required?></td>
        <td align="center">:</td>
        <td align="left"><select name="page_type" onchange="setPageContentType(this)">
              <option value="static" <?php if($pdata['page_type']=="static") echo ' selected="selected"';?>>Static</option>
			  <option value="dynamic" <?php if($pdata['page_type']=="dynamic") echo ' selected="selected"';?>>Dynamic</option>
            </select></td>
      </tr>
      <tr>
        <td align="left" class="label">Page Title <?=$required?></td>
        <td align="center">:</td>
        <td align="left"><input type="text" name="page_title" value="<?=$pdata['page_title']?>" size="60"/></td>
      </tr>
      <tr>
        <td align="left" class="label">Meta Keywords</td>
        <td align="center">:</td>
        <td align="left"><input type="text" name="page_metakeywords" value="<?=$pdata['page_metakeywords']?>" size="60"/></td>
      </tr>
      <tr>
        <td align="left" class="label">Meta Description</td>
        <td align="center">:</td>
        <td align="left"><input type="text" name="page_metadesc" value="<?=$pdata['page_metadesc']?>" size="60"/></td>
      </tr>
      <tr id="editor" class="label">
        <td align="left" colspan="3">Page Content :
		<p id="container_htmlarea" <?php if(isset($pdata['page_type']) && $pdata['page_type']=="dynamic") echo 'style="display:none;"';?>>
            <?php
		include_once("includes/fckeditor/fckeditor.php") ;
		echo "\n";
		$cntdesc = $page_contents;
		$ctrl_name = 'page_content_static';
		$sBasePath = 'includes/fckeditor/';
		$oFCKeditor = new FCKeditor($ctrl_name);
		$oFCKeditor->Height = "400px";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->BasePath = $sBasePath;
		$oFCKeditor->Value =$cntdesc;
		$oFCKeditor->Create();
	 ?>
          </p>
          <p id="container_txtarea" <?php if( !isset($pdata['page_type']) || (isset($pdata['page_type']) && $pdata['page_type']=="static") )  echo 'style="display:none;"';?>>
            <textarea name="page_content_dynamic" style="width:700px;height:300px;"><?=$page_contents?></textarea>
          </p>
		
		  </td>
      </tr>
      <tr>
        <td align="left" colspan="2">&nbsp;</td>
        <td align="left" valign="middle" height="40"><input name="submit" type="submit" value="Add Page" class="button" />
        </td>
      </tr>
    </table>
  </form>
</div>

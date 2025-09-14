<?php
//page_edit.php
$required = "<font color='#FF0000' size='1'>*</font>";
if(isset($_SESSION[SES]['pagedata'])) {
	$pdata = $_SESSION[SES]['pagedata'];
	extract($pdata);
	$page_contents = ($pdata['page_content_static']!="")?$pdata['page_content_static']:$pdata['page_content_dynamic'];
	unset($_SESSION[SES]['pagedata']);
}
else {
	$page_id = isset($_GET['pid'])?$_GET['pid']:0;
	$ped_res = $pageObj->getPageById($page_id);
	if($ped_res['NO_OF_ITEMS']>0) {
		$page_id = (int)$ped_res['oDATA'][0]['page_id'];
		$page_name = outText($ped_res['oDATA'][0]['page_name']);
		$page_url = outText($ped_res['oDATA'][0]['page_url']);
		$page_type = outText($ped_res['oDATA'][0]['page_type']);
		$page_title = outText($ped_res['oDATA'][0]['page_title']);
		$page_metakeywords = outText($ped_res['oDATA'][0]['page_metakeywords']);
		$page_metadesc = outText($ped_res['oDATA'][0]['page_metadesc']);
		$page_contents = outText($ped_res['oDATA'][0]['page_contents']);
		$editable = outText($ped_res['oDATA'][0]['editable']);
		if($editable) $ro = "";
		else $ro = 'readonly="true" class="readonly"';
	}
}
$page =filter($_REQUEST['page']);
?>
<div class="col-md-12"><a href="<?=$_curpage?>?page=<?=$page?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>

	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" action="PageAction.php" name="pageeditfrm" method="post" onsubmit="return page_valid(this);" enctype="multipart/form-data">
                            <input type="hidden" name="act" value="editpage" />
                            <input type="hidden" name="page_id" value="<?=$page_id?>" />
                            <input type="hidden" name="page" value="<?=$page?>" />
                             <div id="validation_div" class="validation_error" align="center"></div>
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Page Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" name="page_name" value="<?=$page_name?>" size="60" onblur="fillURL(this.value,'page_url')"/>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Page Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" name="page_url" id="page_url" value="<?=$page_url?>" size="60" title="It is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens." <?=$ro?>/>
                                                        
                                                        <input type="hidden" name="page_type" value="static"/>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Page Title</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" name="page_title" value="<?=$page_title?>" size="60"/>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Meta Keywords</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" name="page_metakeywords" value="<?=$page_metakeywords?>" size="60"/>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Meta Description</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control1" name="page_metadesc" value="<?=$page_metadesc?>" size="60"/>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Page Content</label>
                                                    <div class="col-sm-8">
                                                         <p id="container_htmlarea" <?php if($page_type=="dynamic") echo 'style="display:none;"';?>>
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
          <p id="container_txtarea" <?php if($page_type=="static") echo 'style="display:none;"';?>>
            <textarea name="page_content_dynamic" style="width:700px;height:300px;"><?=$page_contents?></textarea>
          </p>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                

                               
                                                
                                                <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn">Update</button>
                                <button class="btn-inverse btn">Reset</button>
                            </div>
                        </div>
                     </div>
                                            </form>                
                        </div>
      			</div>
			</div>
	</div>





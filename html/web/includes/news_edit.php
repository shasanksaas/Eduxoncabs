<?php 
$required = "<font color='#FF0000' size='1'>*</font>";
$id = filter($_REQUEST['id']);
$res = $newsObj->getNewsById($id); 
$total = $res['NO_OF_ITEMS'];
$type = outText($res['oDATA'][0]['type']);
$page_contents = outText($res['oDATA'][0]['content']);
if($type == 0){$display = 'style="display:block;"';}else{$display = 'style="display:none;"';}
if($type == 1){$display1 = 'style="display:block;"';}else{$display1 = 'style="display:none;"';}
if($type == 2){$display2 = 'style="display:block;"';}else{$display2 = 'style="display:none;"';}
?>

<div class="col-md-12"><a href="<?=$_curpage?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>

	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" name="frmnotice" action="NewsAction.php" method="post" onsubmit="return happenings_valid()" enctype="multipart/form-data">
                              <input type="hidden" name="act" value="updatenews" />
								<input type="hidden" name="id" value="<?=$res['oDATA'][0]['id'];?>" />
                             <div id="validation_div" class="validation_error" align="center"></div>
                                                
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Title</label>
                                                    <div class="col-sm-8">
                                                        
                                                        <textarea name="title" class="form-control"  id="title" onblur="fillURL(this.value,'url')"><?=outText($res['oDATA'][0]['title']);?></textarea>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Publish Date</label>
                                                    <div class="col-sm-8">
                                                    
                                                        <input type="date" class="form-control1" value="<?=outText($res['oDATA'][0]['publish_date']);?>" name="publish_date">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label"> Upload File</label>
                                                    <div class="col-sm-8">
                                                       
		
                                                        
                                                            <input type="file" name="file_name" onchange="javascript:return validNewsFile(this.value)" value=""/>
                                                            <?php if($res['oDATA'][0]['file_name']) {?><a href="../news-files/<?=outText($res['oDATA'][0]['file_name']);?>" target="_blank">view</a><?php }?>
                                                            <br /><span style="color:#990000; font-style:italic;">(Only Image allowed for best view upload 1280X500 size image)</span>
                                                       
                                                        
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label"> Content</label>
                                                    <div class="col-sm-8">
                                                       
		
                                                        
                                                           <p id="container_htmlarea">
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
          
                                                        
                                                    </div>
                                                    
                                                </div>                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                

                               <input type="hidden" name="url" id="url" value="<?=outText($res['oDATA'][0]['url']);?>"/>
                               <input type="hidden" name="description" id="description" <?=outText($res['oDATA'][0]['description']);?>/>
                                                
                                                <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn">Update</button>
                                
                            </div>
                        </div>
                     </div>
                                            </form>                
                        </div>
      			</div>
			</div>
	</div>





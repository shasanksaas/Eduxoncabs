<div class="col-md-12"><a href="<?=$_curpage?>" class="btn btn-success float-right" style="margin-bottom:1%;">Back</a></div>

	<div class="col-md-12 ">
			<div class="col-md-12 top-content">
                <div class="grid-form1">
  	       			<div class="bs-example" data-example-id="form-validation-states-with-icons">
                             <form class="form-horizontal" name="frmnotice" action="NewsAction.php" method="post" onsubmit="return happenings_valid()" enctype="multipart/form-data">
                             <input type="hidden" name="act" value="addnews" />
                             <div id="validation_div" class="validation_error" align="center"></div>
                                                
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Title</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="title" id="title" class="form-control1"/>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Publish Date</label>
                                                    <div class="col-sm-8">
                                                    
                                                        <input type="date" class="form-control1" name="publish_date">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="focusedinput" class="col-sm-2 control-label"> Upload File</label>
                                                    <div class="col-sm-8">
                                                       
		
                                                        
                                                            <input type="file" name="file_name" onchange="javascript:return validNewsFile(this.value)" value=""/>
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
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                

                               <input type="hidden" name="url" id="url" value="<?php echo date("H-i-s");?>"/>
                               <input type="hidden" name="description" id="description" value="<?php echo date("H-i-s");?>"/>
                                                
                                                <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn-primary btn">Submit</button>
                                
                            </div>
                        </div>
                     </div>
                                            </form>                
                        </div>
      			</div>
			</div>
	</div>





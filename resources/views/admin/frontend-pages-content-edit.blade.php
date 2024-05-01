<x-app-layout>
    
    <div class="row">
        
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="fas fa-list"></i> Edit Page  {{$rowsPageDetails->page_name}} </h2>
                    
                    {{-- <div class="box-icon">
                         <a href="#" class="btn btn-setting btn-round btn-default"><i
                                class="glyphicon glyphicon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div> --}}
                </div>
                <div class="box-content">
                    <br>
                    {{-- starts here --}}


                    <form class="form-horizontal" action="{{route('admin.saveCMS')}}" method="post" enctype="multipart/form-data" onsubmit="return validatePageContent()">
                        @csrf
                        <fieldset>                        
                            <div class="control-group">
                                <label for="focusedInput" class="control-label">Screen Name</label>
                                <div class="controls">
                                <input type="text" disabled="disabled" value="<?php echo stripslashes($rowsPageDetails->page_name) ?>" class="input-xlarge focused span4">
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label for="focusedInput" class="control-label">Heading</label>
                                <div class="controls">
                                <input type="text" name="heading" id="heading" value="<?php echo stripslashes($rowsPageDetails->heading) ?>" class="input-xlarge focused span4">
                                <span class="error" id="headingError"></span>
                                </div>
                            </div>
                            
                              <div class="control-group">
                                  <label class="control-label" for="textarea2">Content</label>
                                  <div class="controls">
                                    <textarea class="cleditor" id="editor" name="description" rows="3">
                                        {{$rowsPageDetails->content}}
                                    </textarea>
                                   {{-- <script type="text/javascript" src="fkeditor/fckeditor.js"></script> --}}
                                    <?php 
                                        // include "fckeditor/fckeditor.php";
                                        // $oFCKeditor = new FCKeditor('content') ;
                                        // $oFCKeditor->BasePath = 'fckeditor/' ;
                                        // $oFCKeditor->Value = stripslashes($rowsPageDetails->content) ;
                                        // $oFCKeditor->Width = "80%";
                                        // $oFCKeditor->Height = "400";
                                        // $oFCKeditor->ToolbarSet = "Basic";
                                        // $oFCKeditor->Create();
                                    ?>
                                    <!--<textarea class="cleditor" id="content" name="content" rows="3"><?php //echo stripslashes($rowsPageDetails['content']) ?></textarea>-->
                                    <span class="error" id="contentError"></span>
                                  </div>
                              </div>
                               {{-- my code --}}
                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#editor'))
                                        .catch(error => {
                                            console.error(error);
                                        });
                                </script>
                                {{-- ends --}}
                             
                             <div class="clearfix"></div>
    
                       
                             <div class="form-actions" style="border:none; background:none;">
                                 <button class="btn btn-primary" name="btnSubmit" type="submit">Submit</button>
                                {{-- <button class="btn btn-primary" name="btnEditCancel" type="button" onclick="javascript:window.location='<?php echo (isset($_GET['redirectBack']) && strlen(_sanitize($_GET['redirectBack']))) ? _sanitize($_GET['redirectBack']) : "frontend-pages-list.php" ?>'">Cancel</button> --}}
                             </div>
                        </fieldset>
                        
                            <input type="hidden" name="doContentEditId" value="<?php echo $rowsPageDetails->id ?>" id="doContentEditId" />
                            <input type="hidden" name="doContentEditSubmit" id="doContentEditSubmit" />
                        
                        </form>	

                    

                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


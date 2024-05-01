<x-app-layout>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="fas fa-file"></i>  Content Add </h2>

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
                    
                            <form class="form-horizontal offset6 span8" action="{{route('admin.addPage')}}" method="post" onsubmit="return validate()">
                                @csrf
                            <fieldset>
                              
                                      
                                 <div class="control-group">
                                    <label for="focusedInput" class="control-label">Content Name</label>
                                    <div class="controls">
                                    <input type="text" class="input focused" name="pageName" id="pageName" /> &nbsp;<span class="error" id="pageNameError"></span>
                                    </div>
                                </div>
                                 
                                <div class="control-group">
                                    <label for="focusedInput" class="control-label">Allowed Groups</label>
                                    <div class="controls">
                                    <!--<input type="text" class="input focused" name="allowed_packages" id="allowed_packages" /> -->
                                    <select name="allowed_groups[]" id="allowed_groups" multiple>
                                        @foreach($group_query as $result_query)
                                    
                                        <option value="<?php echo $result_query->id ?>"> <?php echo $result_query->group_name ?> </option>
                                        @endforeach
                                    
                                    </select>
                                    &nbsp;<span class="error" id="allowed_groupsError"></span>
                                    </div>
                                </div>
                                 {{-- <input type="hidden" name="redirectBack" value="<?php echo urlencode(getFullURL()); ?>" id="redirectBack" /> --}}
                                 <div class="form-actions" style="border:none; background:none;">
                                     <button class="btn btn-primary" name="btnAddSubmit" type="submit">Submit</button>
                                    
                                    <button class="btn btn-primary" name="" type="button" onclick="javascript:window.location='<?php echo (isset($_GET['redirectBack']) && strlen(_sanitize($_GET['redirectBack']))) ? _sanitize($_GET['redirectBack']) : "frontend-pages-list.php" ?>'">Cancel</button>
                                    
                                 </div>
                            </fieldset>
                               
                            </form>	
                            </div>
                        </div>
                    </div>

                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>

    
<script type="text/javascript">


    function validate()
    {
        $(".error").css("display","none");
        var error = 0;
        document.getElementById("pageNameError").innerHTML = "";
        document.getElementById("allowed_groupsError").innerHTML = "";
        document.getElementById("templateError").innerHTML = "";
        
        var name = document.getElementById("pageName").value.trim();
        var group = document.getElementById("allowed_groups").value.trim();
        var template = document.getElementById("template").value.trim();
        
        if(name.length == 0)
        {
            document.getElementById("pageNameError").innerHTML = "Please Enter the page name";
            error = 1;
        }
        
        if(error)
        {
            $(".error").css("display","inline");
            return false;
        }
        else
            return true;
        
    }
    </script>
</x-app-layout>
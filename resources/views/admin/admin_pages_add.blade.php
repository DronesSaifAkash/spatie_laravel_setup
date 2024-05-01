<x-app-layout>
    
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="icon-list-alt"></i>Page Add</h2>
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
                    <form class="form-horizontal offset6 span8" action="{{route('admin.insert_admin_pages_data')}}" method="post" onsubmit="return validate()">
                        @csrf 
                        <fieldset>
                             <div class="control-group">
                                <label for="focusedInput" class="control-label">Object Name</label>
                                <div class="controls">
                                <input type="text" class="input focused" name="object_name" id="object_name" /> &nbsp;<span class="error" id="object_nameError"></span>
                                </div>
                            </div>
                             <div class="control-group">
                                <label for="focusedInput" class="control-label">Object Page</label>
                                <div class="controls">
                                <input type="text" class="input focused" name="object_page" id="object_page" /> &nbsp;<span class="error" id="object_pageError"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="focusedInput" class="control-label">Allowed Groups</label>
                                <div class="controls">
                                <!--<input type="text" class="input focused" name="allowed_groups" id="allowed_groups" /> -->
                                <select name="allowed_groups" id="allowed_groups" multiple>
                                @foreach($group_query as $result_query)
                                    <option value="<?php echo $result_query->id ?>"> <?php echo $result_query->group_name ?> </option>
                                @endforeach 
                                </select>
                                &nbsp;<span class="error" id="allowed_groupsError"></span>
                                </div>
                            </div>
                             <input type="hidden" name="redirectBack" value="<?php echo urlencode(getFullURL()); ?>" id="redirectBack" />
                             <div class="form-actions" style="border:none; background:none;">
                                 <button class="btn btn-primary" name="btnAddSubmit" type="submit">Submit</button>
                                 <a href="{{route('admin.admin_pages')}}" class="btn btn-primary" name="btnEditCancel" type="button" >Cancel</a>
                             </div>
                        </fieldset>
                        </form>	

                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="row-fluid pageHeaderButtons">
        <?php
        $allowedPages = checkPermissions();
        if(in_array("groups-add-edit", $allowedPages) )
        {
        ?>
        <div style="float: right !important;"><a href="groups-add-edit.php?redirectBack=<?php echo urlencode(getFullURL()); ?>"><button
                    class="btn btn-medium btn-primary">Add</button></a></div>
        <?php
        }
        ?>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="icon-list-alt"></i> Add Groups <span style="color: red;">Any changes here can ruin the
                            Admin Panel.</span></h2>
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
                    <form class="form-horizontal  offset6 span8" action="{{ route('admin.groups_add_submit') }}"
                        method="post" onsubmit="return validateGroups()">
                        @csrf
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="selectError3">Group Name</label>
                                <div class="controls">
                                    <input type="text" name="groupName" id="groupName" class="input-xlarge focused" />
                                    <span class="help-inline error" id="groupNameError"></span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Notes</label>
                                <div class="controls">
                                    <textarea name="notes" id="notes"></textarea><span class="help-inline error" id="groupNotesError"></span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Select Parent</label>
                                <div class="controls">
                                    <select name="groupParent" data-rel="chosen">
                                        <option value="0">Top Level</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions" style="border:none; background:none;">
                                <button class="btn btn-primary" name="groupNameAddsubmit" type="submit">Add</button>
                                <a href="{{route('admin.groups_list')}}" class="btn btn-primary" name="groupNameAddsubmit" type="button"
                                   >Cancel</a>
                            </div>
                        </fieldset>
                    </form>



                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
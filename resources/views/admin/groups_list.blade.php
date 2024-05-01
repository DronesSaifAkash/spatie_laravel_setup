<x-app-layout>
    <div class="row-fluid pageHeaderButtons">
        <?php
    
        $allowedPages = checkPermissions();
        
        if(in_array("groups-add-edit", $allowedPages) )
        {
        ?>
        <div style="float: right !important;"><a href="{{ route('admin.groups_add') }}"><button
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
                    <h2><i class="icon-file"></i> Groups <span style="color: red;">Any changes here can ruin the Admin
                            Panel.</span></h2>
                    {!! resultsPerPg($lasturl, $resultsPerPage) !!}
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
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Group Id </th>
                                <th>Group Name</th>
                                <th>Group Slug</th>
                                <th>Notes </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resultCategories as $rowsGroups)
                                <tr>
                                    <td> {{ $rowsGroups->id }}
                                    </td>

                                    <td class="center"> <?php echo $rowsGroups->group_name; ?></td>
                                    <td class="center" style="text-align: center !important;"><?php echo $rowsGroups->group_slug; ?></td>
                                    <td class="center" style="text-align: center !important;"><?php echo stripslashes($rowsGroups->notes); ?></td>
                                    <td class="center">
                                        <?php
                                    if($rowsGroups->id != 1)
                                    {
                                ?>
                                        {{-- $rowsGroups->id --}}
                                        <form action="{{ route('admin.groups_edit') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="groupsId" value="{{ $rowsGroups->id }}">
                                            <button class="btn btn-warning">
                                                <i class="icon-edit icon-white"></i>
                                                Edit
                                            </button>
                                        </form>
                                        <a class="btn btn-small btn-danger" href="#"
                                            onclick="deleteConfirm('<?php echo $rowsGroups->id; ?>', '<?php echo $rowsGroups->group_name; ?>')">
                                            <i class="icon-trash icon-white"></i>
                                            Delete
                                        </a>
                                        <?php
                                    }
                                ?>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script type="text/javascript">
                        function deleteConfirm(groupId, groupName) {
                            document.getElementById("IdOfGroupToDelete").value = groupId;
                            document.getElementById("NameOfGroupToDelete").innerHTML = groupName;
                            $('#deleteConfirm').modal('show');
                        }
                    </script>
                    <div class="modal" tabindex="-1" role="dialog" id="deleteConfirm">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                    <h3>Delete <span id="NameOfGroupToDelete"></span>? </h3>
                                </div>
                                <div class="modal-body">
                                    <p style="color: red;">Are you sure you want to delete this group? Deleting the group
                                        will also delete the admin users who belong to this group.</p>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.del_groups_data')}}" method="post" id="deleteConfirmForm">
                                        @csrf 
                                        <fieldset>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="hidden" name="IdOfGroupToDelete" id="IdOfGroupToDelete"
                                                        value="" />
                                                    <input type="submit" style="display: none;" name="groupDeleteSubmit"
                                                        id="groupDeleteSubmit" />
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                                    <a href="#" class="btn btn-primary"
                                        onclick="javascript:document.getElementById('groupDeleteSubmit').click()">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
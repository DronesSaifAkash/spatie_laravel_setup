<x-app-layout>
    <div class="row-fluid pageHeaderButtons">
        <div style="margin-left: 50px;">
            <form action="" method="get" style="display: inline;">
                <input type="text" id="searchTerm" name="searchTerm" value="<?php echo $searchTerm; ?>" />
                <select name="searchIn">
                    <option value="">--Select--</option>
                    <option <?php echo $searchIn == 'name' ? "selected='selected'" : ''; ?> value="name">User
                        Name</option>
                </select>
                <input type="submit" id="searchSubmit" name="searchSubmit" style="display: none;" />
                <i class="fas fa-search" style="margin-left: 5px; margin-top: -12px;"
                    onclick="javascript:document.getElementById('searchSubmit').click()"></i>
            </form>
        </div>
        <a href="{{ route('admin.admin_user_list') }}">Clear</a>

        <?php
        $allowedPages = checkPermissions();
        if(in_array("admin-user-add-edit", $allowedPages) ){
        ?>
        <div style="float: right !important;">
            <a href="{{ route('admin.admin_user_add') }}">
                <button class="btn btn-medium btn-primary">Add</button>
            </a>
        </div>
        <?php
        }
        ?>

    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="glyphicon glyphicon-file"></i> Users </h2>
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
                            <tr>
                                <?php
                                if ($orderBy == 'username') {
                                    $orderBy = 'username';
                                } elseif ($orderBy == 'group') {
                                    $orderBy = 'group_id';
                                } elseif ($orderBy == 'status') {
                                    $orderBy = 'status';
                                } elseif ($orderBy == 'name') {
                                    $orderBy = 'fname';
                                } else {
                                    $orderBy = 'username';
                                }
                                ?>
                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'username', $sortURL);
                                ?>
                                <th>Login Id
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}">
                                        <i class="fa fa-caret-up <?php echo $orderBy == 'username' && $direction == 'asc' ? ' active' : ''; ?>"></i>
                                    </a>
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}">
                                        <i class="fa fa-caret-down <?php echo $orderBy == 'username' && $direction == 'desc' ? ' active' : ''; ?>"></i>
                                    </a>
                                </th>
                                
                                <?php 
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'name', $sortURL);
                                ?>
                                <th>User Name
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}">
                                        <i class="fa fa-caret-up <?php echo $orderBy == 'fname' && $direction == 'asc' ? ' active' : ''; ?>"></i>
                                    </a>
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}">
                                        <i class="fa fa-caret-down <?php echo $orderBy == 'fname' && $direction == 'desc' ? ' active' : ''; ?>"></i>
                                    </a>
                                </th>

                                

                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'group', $sortURL);
                                ?>
                                <th>Group
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}">
                                        <i class="fa fa-caret-up  <?php echo $orderBy == 'group_id' && $direction == 'asc' ? ' active' : ''; ?>"></i>
                                    </a>
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}">
                                        <i class="fa fa-caret-down <?php echo $orderBy == 'group_id' && $direction == 'desc' ? ' active' : ''; ?>"></i>
                                    </a>
                                </th>


                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'status', $sortURL);
                                ?>
                                <th>Status
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}">
                                        <i class="fa fa-caret-up <?php echo $orderBy == 'status' && $direction == 'asc' ? ' active' : ''; ?>"></i>
                                    </a>
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}">
                                        <i class="fa fa-caret-down <?php echo $orderBy == 'status' && $direction == 'desc' ? ' active' : ''; ?>"></i>
                                    </a>
                                </th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resultUsers as $rowsUsers)
                                <tr>
                                    @php
                                        $rowsGroupsName = getGroupName($rowsUsers->group_id);
                                    @endphp
                                    <td class="center">
                                        <?php
                                        if ($searchIn == 'name') {
                                            echo highlightSearchTerm(stripslashes($rowsUsers->fname), $searchTerm);
                                        } else {
                                            echo stripslashes($rowsUsers->fname);
                                        }
                                        ?>

                                    </td>

                                    <td class="center">
                                        <?php
                                        //   var_dump($rowsGroupsName);
                                        //   exit;
                                        if ($searchIn == 'username') {
                                            echo highlightSearchTerm(stripslashes($rowsUsers->username), $searchTerm);
                                        } else {
                                            echo stripslashes($rowsUsers->username);
                                        }
                                        ?>

                                    </td>

                                    <td class="center" style="text-align: center !important;">
                                        @if (isset($rowsGroupsName))
                                            {{ $rowsGroupsName . '( ' . $rowsUsers->group_id . ' )' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td class="center">
                                        <?php
                                    if($rowsUsers->status==1 )
                                    {
                                    ?>
                                        <span class="label label-success" style="cursor: pointer;" id="<?php echo 'status' . $rowsUsers->id; ?>"
                                            onclick="changeStatus('login_details', '<?php echo $rowsUsers->id; ?>')">Active</span>
                                        <?php
                                    }
                                    if($rowsUsers->status==0 )
                                    {
                                    ?>
                                        <span class="label label-important" style="cursor: pointer;"
                                            id="<?php echo 'status' . $rowsUsers->id; ?>"
                                            onclick="changeStatus('login_details', '<?php echo $rowsUsers->id; ?>')">Inactive</span>
                                        <?php  
                                    }
                                    ?>

                                    </td>
                                    <td class="center">
                                        <form action="{{ route('admin.admin_user_edit') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="adminUserId" value="{{ $rowsUsers->id }}">
                                            <i class="icon-edit icon-white"></i>
                                            <input type="submit" name="Edit" value="Edit" class="btn btn-warning">
                                        </form>

                                        <a class="btn btn-small btn-danger" href="javascript:void(0)"
                                            onclick="deleteConfirm('<?php echo $rowsUsers->id; ?>', '<?php echo $rowsUsers->username; ?>')">
                                            <i class="icon-trash icon-white"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script type="text/javascript">
                        function deleteConfirm(userId, userName) {
                            document.getElementById("IdOfUserToDelete").value = userId;
                            document.getElementById("NameOfUserToDelete").innerHTML = userName;
                            $('#deleteConfirm').modal('show');
                        }
                    </script>


                    <div class="modal" tabindex="-1" role="dialog" id="deleteConfirm">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                    <h3>Delete <span id="NameOfUserToDelete"></span>? </h3>
                                </div>
                                <div class="modal-body">
                                    <p style="color: red;">Are you sure you want to delete this user?</p>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.admin_user_delete_cong')}}" method="post" id="deleteConfirmForm">
                                        @csrf
                                        <fieldset>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="hidden" name="IdOfUserToDelete" id="IdOfUserToDelete"
                                                        value="" />
                                                    <input type="submit" style="display: none;" name="userDeleteSubmit"
                                                        id="userDeleteSubmit" />
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                                    <a href="#" class="btn btn-primary"
                                        onclick="javascript:document.getElementById('userDeleteSubmit').click()">Delete</a>
                                </div>
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

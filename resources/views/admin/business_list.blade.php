<x-app-layout>
    <div class="row-fluid pageHeaderButtons">
        <div style="margin-left: 50px;">
            <form action="" method="get" style="display: inline;">
                <input type="text" id="searchTerm" name="searchTerm" value="<?php echo $searchTerm; ?>" />
                <select name="searchIn">
                    <option value="">--Select--</option>
                    <option <?php echo $searchIn == 'name' ? "selected='selected'" : ''; ?> value="name">Business Name</option>
                </select>
                <input type="submit" id="searchSubmit" name="searchSubmit" style="display: none;" />
                <i class="fas fa-search" style="margin-left: 5px; margin-top: -12px;"
                    onclick="javascript:document.getElementById('searchSubmit').click()"></i>
            </form>
        </div>
        <a href="{{ route('admin.business_list') }}" class="bg-dark">
            <i class="btn"> Clear </i>
        </a>

        <?php
        $allowedPages = checkPermissions();
        
        if(in_array("business-add-edit", $allowedPages) )
        {
        ?>
        <div style="float: right !important;"><a href="{{ route('admin.business_add') }}">
                <button class="btn btn-medium btn-primary">Add</button></a>
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
                    <h2><i class="glyphicon glyphicon-file"></i> Businesses </h2>
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
                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'name', $sortURL);
                                ?>
                                <th>Business Name
                                    <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL); ?>"><i class="sort-asc <?php echo $orderBy == 'name' && $direction == 'asc' ? ' active' : ''; ?>"></i></a>
                                    <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL); ?>"><i class="sort-desc <?php echo $orderBy == 'name' && $direction == 'desc' ? ' active' : ''; ?>"></i></a>
                                </th>

                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'email', $sortURL);
                                ?>
                                <th>Email
                                    <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL); ?>"><i class="sort-asc <?php echo $orderBy == 'email' && $direction == 'asc' ? ' active' : ''; ?>"></i></a>
                                    <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL); ?>"><i class="sort-desc <?php echo $orderBy == 'email' && $direction == 'desc' ? ' active' : ''; ?>"></i></a>
                                </th>


                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'fname', $sortURL);
                                ?>
                                <th>Contact Name
                                    <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL); ?>"><i class="sort-asc <?php echo $orderBy == 'fname' && $direction == 'asc' ? ' active' : ''; ?>"></i></a>
                                    <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL); ?>"><i class="sort-desc <?php echo $orderBy == 'fname' && $direction == 'desc' ? ' active' : ''; ?>"></i></a>
                                </th>


                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'status', $sortURL);
                                ?>
                                <th>Status
                                    <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL); ?>"><i class="sort-asc <?php echo $orderBy == 'status' && $direction == 'asc' ? ' active' : ''; ?>"></i></a>
                                    <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL); ?>"><i class="sort-desc <?php echo $orderBy == 'status' && $direction == 'desc' ? ' active' : ''; ?>"></i></a>
                                </th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resultUsers as $rowsUsers)
                                @php
                                    // print_r($rowsUsers);
                                    // exit;
                                    $rowsGroupsName = getGroupName($rowsUsers->group_id);
                                @endphp
                                <tr>
                                    <td class="center">
                                        <?php
                                        if ($searchIn == 'name') {
                                            echo highlightSearchTerm(stripslashes($rowsUsers->name), $searchTerm);
                                        } else {
                                            echo stripslashes($rowsUsers->name);
                                        }
                                        ?>

                                    </td>

                                    <td class="center">
                                        <?php
                                        if ($searchIn == 'email') {
                                            echo highlightSearchTerm(stripslashes($rowsUsers->email), $searchTerm);
                                        } else {
                                            echo stripslashes($rowsUsers->email);
                                        }
                                        ?>

                                    </td>

                                    <td class="center">
                                        <?php
                                        if ($searchIn == 'fname') {
                                            echo highlightSearchTerm(stripslashes($rowsUsers->fname . ' ' . $rowsUsers->lname), $searchTerm);
                                        } else {
                                            echo stripslashes($rowsUsers->fname . ' ' . $rowsUsers->lname);
                                        }
                                        ?>

                                    </td>

                                    <td class="center">
                                        <?php
                                          if($rowsUsers->status==1 )
                                          {
                                      ?>
                                        <span class="label label-success" style="cursor: pointer;" id="<?php echo 'status' . $rowsUsers->id; ?>"
                                            onclick="changeStatus2('login_details', '<?php echo $rowsUsers->id; ?>')">Active</span>
                                        <?php
                                          }
                                          if($rowsUsers->status==0 )
                                          {
                                      ?>
                                        <span class="label label-important" style="cursor: pointer;"
                                            id="<?php echo 'status' . $rowsUsers->id; ?>"
                                            onclick="changeStatus2('login_details', '<?php echo $rowsUsers->id; ?>')">Inactive</span>
                                        <?php  
                                          }
                                      ?>

                                    </td>
                                    <td class="center">
                                        <form action="{{ route('admin.business_add_edit') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="businessUserId" value="{{ $rowsUsers->id }}">
                                            <button class="btn btn-small btn-info">
                                                <i class="fas fa-pen"></i> Edit
                                            </button>
                                        </form>
                                        <a class="btn btn-small btn-danger" href="javascript:void(0)"
                                            onclick="deleteConfirm('<?php echo $rowsUsers->id; ?>', '<?php echo $rowsUsers->name; ?>')">
                                            <i class="icon-trash icon-white"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    {{ $resultUsers->links() }}
                    <script type="text/javascript">
                        function deleteConfirm(userId, name) {
                            document.getElementById("IdOfUserToDelete").value = userId;
                            document.getElementById("NameOfUserToDelete").innerHTML = name;
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
                                    <form action="{{ route('admin.deleteUser') }}" method="post" id="deleteConfirmForm">
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


                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

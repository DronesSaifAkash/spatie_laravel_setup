<x-app-layout>
    <div class="row-fluid pageHeaderButtons">
        <div style="margin-left: 50px;">
            <form action="" method="get" style="display: inline;">
                <input type="text" id="searchTerm" name="searchTerm" value="<?php echo $searchTerm; ?>" />
                <select name="searchIn">
                    <option value="">--Select--</option>
                    <option <?php echo $searchIn == 'name' ? "selected='selected'" : ''; ?> value="name">Object Name</option>
                    <option <?php echo $searchIn == 'page' ? "selected='selected'" : ''; ?> value="page">Object Page</option>
                </select>
                <input type="submit" id="searchSubmit" name="searchSubmit" style="display: none;" />
                <i class="fas fa-search" style="margin-left: 5px; margin-top: -12px;"
                    onclick="javascript:document.getElementById('searchSubmit').click()"></i>
                <a href="{{ route('admin.admin_pages') }}"><button class="btn btn-medium btn-primary">Clear</button></a>
            </form>
        </div>
        <div style="float: right !important;">
            <a href="{{ route('admin.admin_page_add') }}"><button class="btn btn-medium btn-primary">Add</button></a>
        </div>


    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="icon-file"></i> Pages <span style="color: red;">Any changes here can ruin the Admin Panel.</span></h2>
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
                            <?php
                            $sortURL = getFullURL();
                            $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'name', $sortURL);
                            ?>
                            <th>Page Name
                                <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL); ?>"><i class="sort-asc <?php echo $orderBy == 'object_name' && $direction == 'asc' ? ' active' : ''; ?>"></i></a>
                                <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL); ?>"><i class="sort-desc <?php echo $orderBy == 'object_name' && $direction == 'desc' ? ' active' : ''; ?>"></i></a>
                            </th>

                            <?php
                            $sortURL = getFullURL();
                            $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'page', $sortURL);
                            ?>
                            <th>File Name
                                <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL); ?>"><i class="sort-asc <?php echo $orderBy == 'object_page' && $direction == 'asc' ? ' active' : ''; ?>"></i></a>
                                <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL); ?>"><i class="sort-desc <?php echo $orderBy == 'object_page' && $direction == 'desc' ? ' active' : ''; ?>"></i></a>
                            </th>

                            <?php
                            $sortURL = getFullURL();
                            $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'code', $sortURL);
                            ?>

                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resultobject as $rowsobject)
                                <tr>
                                    <td>
                                        <?php
                                        if ($searchIn == 'object_name') {
                                            echo highlightSearchTerm(strtolower(stripslashes($rowsobject->object_name)), $searchTerm);
                                        } else {
                                            echo stripslashes($rowsobject->object_name);
                                        }
                                        ?>
                                    </td>
                                    <td class="center">
                                        <?php
                                        if ($searchIn == 'object_page') {
                                            echo highlightSearchTerm(strtolower(stripslashes($rowsobject->object_page)), $searchTerm);
                                        } else {
                                            echo stripslashes($rowsobject->object_page);
                                        }
                                        ?>
                                    </td>

                                    <td class="center">
                                        <form action="{{ route('admin.admin_pages_edit') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="doEditId" value="{{ $rowsobject->id }}">
                                            <button class="btn btn-warning">
                                                <i class="icon-edit icon-white"></i> Edit
                                            </button>
                                        </form>
                                        <a class="btn btn-small btn-danger" href="javascript:void(0)"
                                            onclick="doDelete('<?php echo $rowsobject->id; ?>', '<?php echo $rowsobject->object_name; ?>')">
                                            <i class="icon-trash icon-white"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="display: none;">
                        <form action="{{route('admin.delete_admin_pages')}}" method="post">
                            @csrf
                            <input type="hidden" name="action" value="delete" />
                            <input type="hidden" name="deleteId" value="" id="deleteId" />
                            <input type="submit" name="deleteSubmit" id="deleteSubmit" />
                        </form>
                    </div>
                    <script type="text/javascript">
                        function doDelete(elementId, pageName)
                        {    
                            var userInput = confirm("Are you sure you want to delete " +pageName+ " ?.");
                            
                            if(userInput == false)
                                return;
                            
                            document.getElementById("deleteId").value = elementId;
                            document.getElementById("deleteSubmit").click();
                        }
                        </script>  

                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

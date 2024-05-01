<x-app-layout>
    <div class="row-fluid pageHeaderButtons">
        <div style="margin-left: 50px;">
            <form action="" method="get" style="display: inline;">
                <input type="text" id="searchTerm" name="searchTerm" value="<?php echo $searchTerm; ?>" />
                <select name="searchIn">
                    <option value="">--Select--</option>
                    <option <?php echo $searchIn == 'heading' ? "selected='selected'" : ''; ?> value="heading">Page Heading</option>
                    <option <?php echo $searchIn == 'content' ? "selected='selected'" : ''; ?> value="content">Page Content</option>
                </select>
                <input type="submit" id="searchSubmit" name="searchSubmit" style="display: none;" />
                <i class="fas fa-search" style="margin-left: 5px; margin-top: -12px;"
                    onclick="javascript:document.getElementById('searchSubmit').click()"></i>
            </form>
        </div>
        <a href="{{ route('admin.frontend_pages_list') }}" class="bg-dark">
            <i class="btn"> Clear </i>
        </a>
    </div>
    <div class="row">

        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="glyphicon glyphicon-file"></i> CMS Based Screens </h2>
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
                                <th>Screen Name</th>
                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'heading', $sortURL);
                                ?>
                                <th>Heading
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}"><i
                                            class="fa fa-caret-up {{ $orderBy == 'heading' && $direction == 'asc' ? ' active' : '' }} "></i></a>

                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}"><i
                                            class="fa fa-caret-down {{ $orderBy == 'heading' && $direction == 'desc' ? ' active' : '' }} "></i></a>
                                </th>

                                <th>Screen Content</th>
                                <?php
                                
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'status', $sortURL);
                                ?>
                                <th>Status
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}">
                                        <i
                                            class="fa fa-caret-up {{ $orderBy == 'status' && $direction == 'asc' ? ' active' : '' }}"></i>
                                    </a>
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}">
                                        <i
                                            class="fa fa-caret-down {{ $orderBy == 'status' && $direction == 'desc' ? ' active' : '' }}"></i>
                                    </a>
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resultPages as $rowsPages)
                                @php
                                    // dd($rowsPages);
                                @endphp
                                <tr>
                                    <td>{{ $rowsPages->page_name }}</td>
                                    <td>
                                        <!--<a href="javascript:void(0)" onclick="doDetails(<?php //echo $rowsPages['id']
                                        ?>)">-->
                                        <?php
                                        if ($searchIn == 'heading') {
                                            echo highlightSearchTerm(strtolower(stripslashes($rowsPages->heading)), $searchTerm);
                                        } else {
                                            echo stripslashes($rowsPages->heading);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($searchIn == 'content') {
                                            echo highlightSearchTerm(strtolower(substr(stripslashes($rowsPages->content), 0, 100)), $searchTerm);
                                        } else {
                                            echo substr(stripslashes($rowsPages->content), 0, 100);
                                        }
                                        ?>
                                        <!--</a>-->
                                    </td>
                                    <td class="center">
                                        <?php
                                    if($rowsPages->status=="Y" )
                                    {
                                    ?>
                                        <span class="label label-success" style="cursor: pointer;" id="<?php echo 'status' . $rowsPages->id; ?>"
                                            onclick="changeStatus('frontend_pages', '<?php echo $rowsPages->id; ?>')">Active</span>
                                        <?php
                                    }
                                    if($rowsPages->status =="N" )
                                    {
                                    ?>
                                        <span class="label label-important" style="cursor: pointer;"
                                            id="<?php echo 'status' . $rowsPages->id; ?>"
                                            onclick="changeStatus('frontend_pages', '<?php echo $rowsPages->id; ?>')">Inactive</span>
                                        <?php  
                                    }
                                    ?>
                                    </td>
                                    <td class="center">
                                        {{-- @if (in_array('frontend-pages-content-edit.php', $allowedPages)) --}}
                                        <form action="{{route('admin.frontend_pages_content_edit')}}" method="post">
                                            @csrf 
                                            {{-- <input type="hidden" name="tableName" value="{{$tableName}}" > --}}
                                            <input type="hidden" name="doEditPageContentId" value="{{$rowsPages->id}}">
                                            <i class="icon-edit icon-white"></i>
                                            <input type="submit" class="btn btn-success" value="Edit Content">
                                        </form>
                                        {{-- <a class="btn btn-small btn-inverse"
                                            href="frontend-pages-content-edit/doEditPageContentId={{ $rowsPages->id }}">
                                        
                                            Edit Content
                                        </a> --}}
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $resultPages->links() }}
                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
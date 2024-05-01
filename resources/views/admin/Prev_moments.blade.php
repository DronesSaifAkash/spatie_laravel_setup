<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.dataTables.min.js"></script> --}}
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-file"></i> Moments </h2>
                    {{-- {{resultsPerPg($resultsPerPage)}} --}}
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
                    <table class="table table-striped table-bordered display" id="myTable">
                        <thead>
                            <tr>
                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'id', $sortURL);
                                // echo $sortURL.'<br>';
                                // echo $orderBy.'<br>';
                                // echo $direction;
                                ?>
                                <th>Id
                                    {{-- Function call for changing order.  Checking for active class show using orderBy and direction. --}}
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}"><i
                                            class="fa fa-caret-up {{ $orderBy == 'id' && $direction == 'asc' ? ' active' : '' }} "></i></a>

                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}"><i
                                            class="fa fa-caret-down {{ $orderBy == 'id' && $direction == 'desc' ? ' active' : '' }}"></i></a>
                                </th>
                                <th>Marker</th>
                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'quality', $sortURL);
                                ?>
                                <th>Quality
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}"><i
                                            class="fa fa-caret-up {{ $orderBy == 'quality' && $direction == 'asc' ? ' active' : '' }}"></i></a>
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}"><i
                                            class="fa fa-caret-down {{ $orderBy == 'quality' && $direction == 'desc' ? ' active' : '' }}"></i></a>
                                </th>
                                <th>Name</th>
                                <?php
                                //$sortURL = getFullURL();
                                //$sortURL = addOrChangeURLParameter($lasturl ,"sortBy", "category", $sortURL);
                                ?>
                                <!--<th>Type
                                                <a href="<?php //echo addOrChangeURLParameter($lasturl ,"direction", "asc", $sortURL)
                                                ?>"><i class="sort-asc <?php //echo ($orderBy == "category" && $direction == "asc") ? " active" : ""
                                                ?>"></i></a>
                                                <a href="<?php //echo addOrChangeURLParameter($lasturl ,"direction", "desc", $sortURL)
                                                ?>"><i class="sort-desc <?php //echo ($orderBy == "category" && $direction == "desc") ? " active" : ""
                                                ?>"></i></a>
                                            </th>-->
                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'entryDate', $sortURL);
                                ?>
                                <th>Created
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}"><i
                                            class="fa fa-caret-up {{ $orderBy == 'entryDate' && $direction == 'asc' ? ' active' : '' }}"></i></a>
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}"><i
                                            class="fa fa-caret-down {{ $orderBy == 'entryDate' && $direction == 'desc' ? ' active' : '' }}"></i></a>
                                </th>
                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'publishTime', $sortURL);
                                ?>
                                <th>Publish Time
                                    <a href=" {{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}"><i
                                            class="fa fa-caret-up {{ $orderBy == 'publishTime' && $direction == 'asc' ? ' active' : '' }}"></i></a>
                                    <a href=" {{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}"><i
                                            class="fa fa-caret-down {{ $orderBy == 'publishTime' && $direction == 'desc' ? ' active' : '' }}"></i></a>
                                </th>
                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'displayOrder', $sortURL);
                                ?>
                                <th>Display Order
                                    <a href=" {{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }} "><i
                                            class="fa fa-caret-up {{ $orderBy == 'displayOrder' && $direction == 'asc' ? ' active' : '' }}"></i></a>
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}"><i
                                            class="fa fa-caret-down {{ $orderBy == 'displayOrder' && $direction == 'desc' ? ' active' : '' }}"></i></a>
                                </th>
                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'reported', $sortURL);
                                ?>
                                <th>Business
                                    <a href=" {{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}"><i
                                            class="fa fa-caret-up {{ $orderBy == 'reported' && $direction == 'asc' ? ' active' : '' }}"></i></a>
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}"><i
                                            class="fa fa-caret-down {{ $orderBy == 'reported' && $direction == 'desc' ? ' active' : '' }}"></i></a>
                                </th>
                                <?php
                                        if(0)
                                        {
                                        // $sortURL = getFullURL();
                                        // $sortURL = addOrChangeURLParameter($lasturl ,"sortBy", "flag", $sortURL);
                                                  ?>
                                <th>Flagged
                                    {{-- <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL); ?>"><i class="sort-asc <?php echo $orderBy == 'flag' && $direction == 'asc' ? ' active' : ''; ?>"></i></a>
                                    <a href="<?php echo addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL); ?>"><i class="sort-desc <?php echo $orderBy == 'flag' && $direction == 'desc' ? ' active' : ''; ?>"></i></a> --}}
                                </th>
                                <?php
                                                  }
                                                  ?>
                                <?php
                                $sortURL = getFullURL();
                                $sortURL = addOrChangeURLParameter($lasturl, 'sortBy', 'status', $sortURL);
                                ?>
                                <th>Status
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'asc', $sortURL) }}"><i
                                            class="fa fa-caret-up {{ $orderBy == 'status' && $direction == 'asc' ? ' active' : '' }}"></i></a>
                                    <a href="{{ addOrChangeURLParameter($lasturl, 'direction', 'desc', $sortURL) }}"><i
                                            class="fa fa-caret-down {{ $orderBy == 'status' && $direction == 'desc' ? ' active' : '' }}"></i></a>
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tbl_moment as $key => $tbl_m)
                                <tr>
                                    <td class="center" style="text-align: center !important;">
                                        {{ $tbl_m->id }}
                                    </td>
                                    <td class="center">
                                        <div class="thumbnail"
                                            style="width: 62px; border: none; background: none; box-shadow: none; border-radius: none; margin-bottom: 0px !important;">
                                            <a style="width: 62px;"
                                                href="{{ asset('/') }}admin/allfiles/moments/{{ $tbl_m->id }}I.jpg">
                                                <img style="width:60px"
                                                    src="{{ asset('/') }}admin/allfiles/moments/{{ $tbl_m->id }}I.jpg" />
                                                {{-- src="<?php echo '../../allfiles/moments/markars/' . stripslashes($rowsProducts['Image']); ?>" /> --}}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="center" style="text-align: center !important;">
                                        {{ $tbl_m->image_quality_score }}
                                    </td>
                                    <td class="center">
                                        <?php
                                        // if($searchIn == "name")
                                        // {
                                        // 	//echo "name: " . strtolower(stripslashes($rowsProducts['name'])) ."<br/>";
                                        //     echo highlightSearchTerm(strtolower(stripslashes($rowsProducts['name'])), $searchTerm);
                                        // }
                                        // else
                                        //     echo ucwords(stripslashes($rowsProducts['name']));
                                        ?>
                                        {{ $tbl_m->name }}
                                    </td>

                                    <td class="center" style="text-align: center !important;">
                                        {{ $tbl_m->entryDate }}
                                    </td>
                                    <td class="center" style="text-align: center !important;">
                                        {{ $tbl_m->publishTime }}

                                    </td>
                                    <td class="center">
                                        <input style="width: 30px;" type="text" maxlength="3"
                                            id="order{{ $tbl_m->id }}" onkeydown="saveOrder('{{ $tbl_m->id }}')"
                                            onfocus="saveOrder('{{ $tbl_m->id }}')"
                                            onclick="saveOrder('{{ $tbl_m->id }}')"
                                            value="{{ $tbl_m->displayOrder }}" />

                                        <img style="margin-top: -10px; width: 24px; height: 24px;"
                                            src="{{ asset('/') }}admin/dashboard/img/right_disabled.png"
                                            id="right{{ $tbl_m->id }}" />
                                        <img style="margin-top: -10px; width: 24px; height: 24px;"
                                            id="cross{{ $tbl_m->id }}"
                                            src="{{ asset('/') }}admin/dashboard/img/cross_disabled.png" />
                                    </td>
                                    <td class="center" style="text-align: center !important;">
                                        <?php
                                        //get the business name
                                        $rowsBusinessName = orgName($tbl_m->userId);
                                        ?>
                                        {{-- @if ($tbl_m->reported && 0) 
                                            <a style="padding: 5px 10px 5px 10px" href="#" class="label label-important" data-toggle="popover" data-content="{{$tbl_m->reportedBy}}" title="Reported By">{{$tbl_m->reported}} </a>
                                        @endif --}}

                                        {{ @$rowsBusinessName->org_name }}
                                    </td>
                                    <td class="center">
                                        <?php
                                        if($tbl_m->status == 'Y' )
                                        {
                                        ?>
                                        <span class="label label-success" style="cursor: pointer;"
                                            id="ban{{ $tbl_m->id }}"
                                            onclick="changeBan('tbl_moment', '{{ $tbl_m->id }}', 'momentId')">Not
                                            Banned</span>
                                        <?php
                                            }
                                            if($tbl_m->status == 'N' )
                                            {
                                        ?>
                                        <span class="label label-important" style="cursor: pointer;"
                                            id="ban{{ $tbl_m->id }}"
                                            onclick="changeBan('tbl_moment', '{{ $tbl_m->id }}', 'momentId')">Banned</span>
                                        <?php  
                                            }
                                        ?>
                                    </td>
                                    <td class="center">
                                        <form action="{{ route('admin.moments_add_edit') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="tbl_m_id" value="{{ $tbl_m->id }}">
                                            <button class="btn btn-sm btn-info">
                                                <i class="icon-edit icon-white"></i>
                                                Edit
                                            </button>
                                            <a class="btn btn-small btn-danger" href="#"
                                                onclick="deleteConfirm('{{ $tbl_m->id }}', ' {{ $tbl_m->name }}')">
                                                <i class="icon-trash icon-white"></i>
                                                Delete
                                            </a>

                                        </form>


                                    </td>
                                </tr>
                            @empty
                                <td class="center" colspan="5">No Moments defined yet</td>
                            @endforelse

                        </tbody>
                    </table>
                    {{-- tbl_moment --}}
                    {{ $tbl_moment->links() }}
                    <script>
                        // $(document).ready(function() {
                        //     $('#myTable').DataTable(); // Replace 'yourDataTable' with the ID of your table
                        // });
                    </script>
                    <script type="text/javascript">
                        var elementIds = new Array();
                        var i = 0;
                        var ajaxR = Math.random();
                        @php
                            $len = count($elementIds);
                        @endphp
                        @foreach ($elementIds as $key => $value)
                            elementIds['{{ $key }}'] = '{{ $value }}';
                        @endforeach

                        function saveOrder(id) {
                            document.getElementById("right" + id).src = "{{ asset('/') }}admin/dashboard/img/right.png";
                            document.getElementById("cross" + id).src = "{{ asset('/') }}admin/dashboard/img/cross.png";
                            document.getElementById("right" + id).setAttribute("onclick", "updateOrder('order" + id + "', '" + id + "')");
                            document.getElementById("cross" + id).setAttribute("onclick", "cancelUpdateOrder('order" + id + "', '" + id +
                                "')");
                        }

                        // function updateOrderListener() {
                        //     if (xmlHTTPupdtOrder.readyState == 4 && xmlHTTPupdtOrder.status == 200) {
                        //         var options = $.parseJSON(xmlHTTPupdtOrder.responseText);
                        //         if (options['status'] == "1" && options['id'].length > 0) {
                        //             document.getElementById("right" + options['id']).removeAttribute("onclick");
                        //             document.getElementById("cross" + options['id']).removeAttribute("onclick");
                        //             document.getElementById("right" + options['id']).src =
                        //                 "{{ asset('/') }}admin/dashboard/img/right_disabled.png";
                        //             document.getElementById("cross" + options['id']).src =
                        //                 "{{ asset('/') }}admin/dashboard/img/cross_disabled.png";
                        //             elementIds["order" + options['id']] = options['currrentOrder'];
                        //         }
                        //         noty(options);
                        //     }
                        // }
                        // var xmlHTTPupdtOrder;

                        // function updateOrder(inputElementId, id) {
                        //     if (window.XMLHttpRequest)
                        //         xmlHTTPupdtOrder = new XMLHttpRequest();
                        //     else
                        //         xmlHTTPupdtOrder = new ActiveXObject("Microsoft.XMLHTTP");
                        //     xmlHTTPupdtOrder.onreadystatechange = updateOrderListener;
                        //     var params = "action=updateProductOrder&id=" + id + "&value=" + document.getElementById(inputElementId).value +
                        //         "&rand=" + ajaxR + "&key=" + ajaxKey;
                        //     xmlHTTPupdtOrder.open("POST", "ajax-backend.php", false);
                        //     xmlHTTPupdtOrder.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        //     xmlHTTPupdtOrder.setRequestHeader("Content-length", params.length);
                        //     //xmlhttp.setRequestHeader("Connection", "close");
                        //     xmlHTTPupdtOrder.send(params);
                        // }
                        function updateOrder(inputElementId, id) {
                            @php
                                $ajaxR = ajaxR();
                            @endphp
                            var params = {
                                action: 'update_product',
                                id: id,
                                value: document.getElementById(inputElementId).value,
                                rand: '{{ $ajaxR }}', // Assuming $ajaxR is passed from the controller
                                key: '{{ ajaxKey($ajaxR) }}' // Assuming $ajaxKey is passed from the controller
                            };
                            // console.log(params);
                            $.ajax({
                                url: "{{ route('admin.update_product') }}",
                                type: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: params,
                                success: function(response) {
                                    // Handle successful response
                                    var options = response;
                                    // console.log( options['status'], options['id'].length > 0)
                                    if (options['status'] == "1" && options['id'].length > 0) {
                                        document.getElementById("right" + options['id']).removeAttribute("onclick");
                                        document.getElementById("cross" + options['id']).removeAttribute("onclick");
                                        document.getElementById("right" + options['id']).src =
                                            "{{ asset('/') }}admin/dashboard/img/right_disabled.png";
                                        document.getElementById("cross" + options['id']).src =
                                            "{{ asset('/') }}admin/dashboard/img/cross_disabled.png";
                                        elementIds["order" + options['id']] = options['currrentOrder'];
                                    }
                                    noty(options);
                                },
                                error: function(xhr, status, error) {
                                    // Handle error
                                    console.error(xhr.responseText);
                                }
                            });
                        }

                        function cancelUpdateOrder(inputElementId, id) {
                            document.getElementById(inputElementId).value = elementIds[inputElementId];
                            document.getElementById("right" + id).removeAttribute("onclick");
                            document.getElementById("cross" + id).removeAttribute("onclick");
                            document.getElementById("right" + id).src = "{{ asset('/') }}admin/dashboard/img/right_disabled.png";
                            document.getElementById("cross" + id).src = "{{ asset('/') }}admin/dashboard/img/cross_disabled.png";
                        }

                        function deleteConfirm(attributeId, attributeName) {
                            document.getElementById("IdOfproductsToDelete").value = attributeId;
                            document.getElementById("NameOfproductAttributeToDelete").value = attributeName;
                            $('#deleteConfirm').modal('show');
                        }
                    </script>
                    <div class="modal" tabindex="-1" role="dialog" id="deleteConfirm">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                    <h3>Delete <span id="NameOfproductAttributeToDelete"></span>? </h3>
                                </div>
                                <div class="modal-body">
                                    <p style="color: red;">Are you sure you want to delete this moment?</p>
                                    <p style="color: black;">This will delete all activities of this moment. Deleted Moment
                                        cannot be retrieved
                                        or restored.</p>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.delete_moments')}}" method="post" id="deleteConfirmForm">
                                        @csrf
                                        <fieldset>
                                            <div class="control-group">
                                                <div class="controls" style="display: none;">
                                                    <input type="hidden" name="IdOfproductsToDelete"
                                                        id="IdOfproductsToDelete" value="" />
                                                    <input type="submit" name="productsDeleteSubmit"
                                                        id="productsDeleteSubmit" />
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                                    <a href="#" class="btn btn-primary"
                                        onclick="javascript:document.getElementById('productsDeleteSubmit').click()">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content ends -->
    </div>
    <!--/#content.span10-->
</x-app-layout>
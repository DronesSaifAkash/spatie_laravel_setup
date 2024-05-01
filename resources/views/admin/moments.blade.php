{{-- @extends('layout.app')

@section('title', 'home')

@section('content')
    <style type="text/css">
        .pageHeaderButtons div {
            float: left;
            margin-right: 5px;
        }

        .active {
            color: blue;
        }
    </style> --}}
<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
    
    
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.dataTables.min.js"></script> --}}
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well " data-original-title="">
                    <h2><i class="glyphicon glyphicon-file"></i> Moments </h2>
                </div>
                <div class="box-content">
                    <div class="container">
                        <div class="row">
                        <div class="col-md-4">
                            <form action="" method="get">
                                <input type="text" id="searchTerm" name="search" value="{{$search}}" placeholder="Search by Name..."/>
                                <input type="submit" id="searchSubmit" name="searchSubmit" style="display: none;" />
                                <i class="btn btn-sm fas fa-search" style="margin-left: 5px; margin-top: -12px;" onclick="javascript:document.getElementById('searchSubmit').click()"></i>
                                <a class="btn btn-sm" href="{{route('moments_newList')}}"> <i class="fas fa-close"></i> </a>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="get" action="">
                                <select name="sort_by" class="form-select">
                                    <option value="status" {{ Request::get('sort_by') == 'status' ? 'selected' : '' }}>Status</option>
                                    <option value="heading" {{ Request::get('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                                    <option value="momentid" {{ Request::get('sort_by') == 'Id' ? 'selected' : '' }}>Id</option>
                                    
                                    <!-- Add more options for other sorting criteria if needed -->
                                </select>
                                <button type="submit">Sort</button>
                            </form>
                        </div>
                    </div>
                    </div>
                    <br>
                    {{-- starts here --}}
                    <table class="table table-striped table-bordered display" id="myTable">
                        <thead>
                            <tr>
                                
                                <th>Id </th>
                                
                                <th>Marker</th>
                                
                                <th>Quality
                                    
                                </th>

                                <th>Name</th>
                                
                                <th>Created
                                    
                                </th>
                               
                                <th>Publish Time
                                    
                                </th>
                               
                                <th>Display Order
                                    
                                </th>
                               
                                <th>Business
                                    
                                </th>
                               
                                <th>Status
                                   
                                </th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $elementIds = array();
                            @endphp 
                            @forelse($tbl_moment as $key => $tbl_m)
                                @php 
                                    $elementIds["order" . $tbl_m->momentid] = $tbl_m->displayOrder; 
                                @endphp 
                                <tr>
                                    <td class="center" style="text-align: center !important;">
                                        {{ $tbl_m->momentid }}
                                    </td>
                                    <td class="center">
                                        <div class="thumbnail"
                                            style="width: 62px; border: none; background: none; box-shadow: none; border-radius: none; margin-bottom: 0px !important;">
                                            <a style="width: 62px;"
                                                href="{{ asset('/') }}admin/allfiles/moments/{{ $tbl_m->momentid }}I.jpg">
                                                <img style="width:60px"
                                                    src="{{ asset('/') }}admin/allfiles/moments/{{ $tbl_m->momentid }}I.jpg" />
                                            
                                            </a>
                                        </div>
                                    </td>
                                    <td class="center" style="text-align: center !important;">
                                        @php 
                                            $resultMarker =  getMomentMarkarV2ById($tbl_m->momentid); 
                                            $image = $resultMarker ? $resultMarker->Image : "";
                                            $image_quality_score = $resultMarker ? $resultMarker->image_quality_score_m : -1;
                                            $category = $tbl_m->isBusinessMoment ? 2 : 1;
                                        @endphp 
                                        {{ $image_quality_score }}
                                    </td>
                                    <td class="center">
                                       
                                        {{ addslashes($tbl_m->heading) }}
                                    </td>

                                    <td class="center" style="text-align: center !important;">
                                        {{ $tbl_m['entryDate'] }}
                                    </td>
                                    <td class="center" style="text-align: center !important;">
                                        {{ $tbl_m['publishTime'] }}

                                    </td>
                                    <td class="center">
                                        <input style="width: 30px;" type="text" maxlength="3"
                                            id="order{{ $tbl_m->momentid }}" onkeydown="saveOrder('{{ $tbl_m->momentid }}')"
                                            onfocus="saveOrder('{{ $tbl_m->momentid }}')"
                                            onclick="saveOrder('{{ $tbl_m->momentid }}')"
                                            value="{{ $tbl_m->display_order }}" />

                                        <img style="margin-top: -10px; width: 24px; height: 24px;"
                                            src="{{ asset('/') }}admin/dashboard/img/right_disabled.png"
                                            id="right{{ $tbl_m->momentid }}" />
                                        <img style="margin-top: -10px; width: 24px; height: 24px;"
                                            id="cross{{ $tbl_m->momentid }}"
                                            src="{{ asset('/') }}admin/dashboard/img/cross_disabled.png" />
                                    </td>
                                    <td class="center" style="text-align: center !important;">
                                        <?php
                                        //get the business name
                                        $rowsBusinessName = orgName($tbl_m->userId);
                                        ?>
                                        {{-- @if ($tbl_m['reported && 0) 
                                            <a style="padding: 5px 10px 5px 10px" href="#" class="label label-important" data-toggle="popover" data-content="{{$tbl_m['reportedBy}}" title="Reported By">{{$tbl_m['reported}} </a>
                                        @endif --}}

                                        {{ @$rowsBusinessName->org_name }}
                                    </td>
                                    <td class="center">
                                        <?php
                                        if($tbl_m->status == 'Y' )
                                        {
                                        ?>
                                        <span class="label label-success" style="cursor: pointer;"
                                            id="ban{{ $tbl_m->momentid }}"
                                            onclick="changeBan('tbl_moment', '{{ $tbl_m->momentid }}', 'momentid')">Not
                                            Banned</span>
                                        <?php
                                            }
                                            if($tbl_m->status == 'N' )
                                            {
                                        ?>
                                        <span class="label label-important" style="cursor: pointer;"
                                            id="ban{{ $tbl_m->momentid }}"
                                            onclick="changeBan('tbl_moment', '{{ $tbl_m->momentid }}', 'momentid')">Banned</span>
                                        <?php  
                                            }
                                        ?>
                                    </td>
                                    <td class="center">
                                        <form action="{{ route('moments_add_edit') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="tbl_m_id" value="{{ $tbl_m->momentid }}">
                                            <button class="btn btn-sm btn-info">
                                                <i class="icon-edit icon-white"></i>
                                                Edit
                                            </button>
                                            <a class="btn btn-small btn-danger" href="#"
                                                onclick="deleteConfirm('{{ $tbl_m->momentid }}', ' {{ $tbl_m->name }}')">
                                                <i class="icon-trash icon-white"></i>
                                                Delete
                                            </a>

                                        </form>


                                    </td>
                                </tr>
                            @empty
                                <td class="center" colspan="10">No Moments defined yet</td>
                            @endforelse

                        </tbody>
                    </table>
                    {{-- tbl_moment --}}
                    {{ $tbl_moment->appends(['search' => $search])->links() }}
                    
                    <script type="text/javascript">
                      
                    </script>
                    
                </div>
            </div>
        </div>
        <!-- content ends -->
    </div>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
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
            console.log(id);
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
                url: "{{ route('update_product') }}",
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
                    <form action="{{route('delete_moments')}}" method="post" id="deleteConfirmForm">
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
    <!--/#content.span10-->
</x-app-layout>
{{-- @endsection --}}

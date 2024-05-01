
<x-app-layout>
{{-- @include('role-permission.nav-links') --}}
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="icon-list-alt"></i>Manage Permissions</h2>
                @can('Create Permission')
                    <a class="btn btn-sm btn-primary" href="{{url('permissions/create')}}">Add Permissions</a>
                @endcan 
            </div>
            <div class="box-content">
                <br>
                {{-- starts here --}}
<div class="container text-white">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif 

            <div class="card">
                <div class="card-body">

                    <table>
                        <tr>
                            <th>Id </th>
                            <th>Name </th>
                            <th>Action </th>
                        </tr>
                        @foreach($permissions as $permission)
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>
                                @can('Update Permission')
                                <a class="btn btn-sm btn-primary" href="{{url('permissions/'.$permission->id.'/edit')}}">Edit</a>
                                @endcan 
                                @can('Delete Permission')
                                <a class="btn btn-sm btn-primary" href="{{ url('permissions/'.$permission->id.'/delete')}}">Delete</a>
                                @endcan 

                            </td>
                        </tr>
                        @endforeach 
                    </table>
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
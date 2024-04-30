<x-app-layout>
{{-- @include('role-permission.nav-links') --}}


<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif 

            <div class="card">
                <div class="card-header">
                    <h4>Roles</h4>
                    @can('Create Role')
                    <a href="{{url('roles/create')}}">Add Role</a>
                    @endcan 
                </div>
                <div class="card-body">

                    <table>
                        <tr>
                            <th>Id </th>
                            <th>Name </th>
                            <th>Action </th>
                        </tr>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                @can('Update Permission')
                                    <a href="{{url('roles/'.$role->id.'/give-permission')}}"> Add / Edit Role Permission </a>
                                @endcan
                                {{-- @can('Update role') --}}
                                @role('Super-Admin')
                                    <a href="{{url('roles/'.$role->id.'/edit')}}">Edit</a>
                                @endrole
                                {{-- @endcan --}}
                                @can('Delete role')
                                    <a href="{{ url('roles/'.$role->id.'/delete')}}">Delete</a>
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
</x-app-layout>
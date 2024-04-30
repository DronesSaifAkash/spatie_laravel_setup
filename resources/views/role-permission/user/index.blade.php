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
                    <h4>User</h4>
                    @can('Create User')
                    <a href="{{url('users/create')}}">Add User</a>
                    @endcan 
                </div>
                <div class="card-body">

                    <table>
                        <tr>
                            <th>Id </th>
                            <th>Name </th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Action </th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if(!empty($user->getRoleNames() ))
                                @foreach($user->getRoleNames() as $rolename)
                                <label for="">{{$rolename}}</label>

                                @endforeach
                                @endif 
                            </td>
                            <td>
                                {{-- <a href="{{url('users/'.$user->id.'/give-permission')}}">
                                    Add / Edit user Permission
                                </a> --}}
                                @can('Update User')
                                <a href="{{url('users/'.$user->id.'/edit')}}">Edit</a>
                                @endcan 
                                @can('Delete User')
                                <a href="{{ url('users/'.$user->id.'/delete')}}">Delete</a>
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
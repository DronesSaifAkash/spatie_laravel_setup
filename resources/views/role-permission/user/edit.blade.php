<x-app-layout>
    
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="icon-list-alt"></i>Edit User</h2>
                    <a class="btn btn-sm btn-primary"  href="{{url('users')}}">Back</a>
                </div>
                <div class="box-content">
                    <br>
                    {{-- starts here --}}
                    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{url('users/'.$user->id)}}" method="POST">
                        @csrf 
                        @method('PUT')
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" value="{{$user->name}}">
                            @error('name')
                            {{$message}}
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control"  value="{{$user->email}}" readonly>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div> --}}
                        <div class="mb-3">
                            <label for="">Roles</label>
                            <select name="roles[]" id="" multiple class="form-control">
                                <option value=""> Select Role </option>
                                @foreach($roles as $role)
                                <option
                                {{in_array($role, $userRoles)? 'selected': ''}}
                                 value="{{$role}}"> {{$role}} </option>
                                @endforeach 
                            </select>
                            @error('roles')
                            <span>
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary"> Save</button>
                        </div>

                    </form>

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
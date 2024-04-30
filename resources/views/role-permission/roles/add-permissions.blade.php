<x-app-layout>
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
                    <h4>Role : {{ $role->name }} </h4>
                    <a href="{{ url('roles') }}">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('roles/' . $role->id . '/give-permission') }}" method="POST">
                        @csrf
                        @method('PUT')


                        @error('permission')
                        <span class="text-danger">{{$message}}</span>
                        @enderror



                        <div class="mb-3">
                            <label for="">Permissions</label>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-3">
                                        <label for="">
                                            <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                                class="form-control" {{ in_array($permission->id, $rolePermissions) ? 'checked' : ''; }}>
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary"> Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
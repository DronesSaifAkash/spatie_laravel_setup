<x-app-layout>

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="icon-list-alt"></i>Role : {{ $role->name }} </h2>
                    <a class="btn btn-sm btn-primary" href="{{ url('roles') }}">Back</a>
                </div>
                <div class="box-content">
                    <br>
                    {{-- starts here --}}
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ url('roles/' . $role->id . '/give-permission') }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')


                                            @error('permission')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror



                                            <div class="mb-3">
                                                <label for="">Permissions</label>
                                                <div class="row">
                                                    @foreach ($permissions as $permission)
                                                        <div class="col-md-3">
                                                            <label for="">
                                                                <input type="checkbox" name="permission[]"
                                                                    value="{{ $permission->name }}" class="form-control"
                                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
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

                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

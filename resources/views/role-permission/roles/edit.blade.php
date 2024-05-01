<x-app-layout>

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="icon-list-alt"></i>Edit Roles</h2>
                    <a class="btn btn-sm btn-primary"  href="{{ url('roles') }}">Back</a>
                </div>
                <div class="box-content">
                    <br>
                    {{-- starts here --}}
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ url('roles/' . $role->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="">Permission Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $role->name }}">
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

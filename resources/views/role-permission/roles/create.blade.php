<x-app-layout>
    
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="icon-list-alt"></i>Page Add</h2>
                </div>
                <div class="box-content">
                    <br>
                    {{-- starts here --}}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Role</h4>
                    <a href="{{url('roles')}}">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{url('roles')}}" method="POST">
                        @csrf 
                        <div class="mb-3">
                            <label for="">Role Name</label>
                            <input type="text" name="name" class="form-control">
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
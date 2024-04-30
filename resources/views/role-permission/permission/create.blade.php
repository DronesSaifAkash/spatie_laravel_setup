<x-app-layout>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Permissions</h4>
                    <a href="{{url('permissions')}}">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{url('permissions')}}" method="POST">
                        @csrf 
                        <div class="mb-3">
                            <label for="">Permission Name</label>
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
</x-app-layout>
<x-app-layout>
    
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="icon-list-alt"></i>Edit Profile</span></h2>
                    {{-- <div class="box-icon">
                         <a href="#" class="btn btn-setting btn-round btn-default"><i
                                class="glyphicon glyphicon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div> --}}
                </div>
                <div class="box-content">
                    <br>
                    {{-- starts here --}}
                    <form class="form-horizontal offset6 span8" action="" method="post" onsubmit="return validate()">
                        @csrf
                            <div class="control-group">
                                <label for="focusedInput" class="control-label">Name</label>
                                <div class="controls">
                                <input type="text" value="" class="input focused" name="name" id="name" /> &nbsp;<span class="error" id="nameError"></span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="focusedInput" class="control-label">Email</label>
                                <div class="controls">
                                <input type="text" value="" class="input focused" name="email" id="email" /> &nbsp;<span class="error" id="emailError"></span>
                                </div>
                            </div>


                            <div class="control-group">
                                <label for="focusedInput" class="control-label">Contant No</label>
                                <div class="controls">
                                <input type="text" value="" class="input focused" name="phone" id="phone" /> &nbsp;<span class="error" id="phoneError"></span>
                                </div>
                            </div>

                            
                            <div class="form-actions " style="border:none; background:none; padding:5px;">
                                <button class="btn btn-primary" name="adminUserAddsubmit" type="submit">Add</button>
                                <a href="{{route('admin.admin_profile')}}" class="btn btn-primary" type="button" >Cancel</a>
                            </div>
                        </form>	

                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

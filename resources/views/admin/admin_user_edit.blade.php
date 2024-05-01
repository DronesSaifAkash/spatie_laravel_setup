<x-app-layout>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="icon-list-alt"></i>
                        <?php
                        // echo (isset($_GET['action']) && _sanitize($_GET['action']) == "edit") ? "Edit" : "Add"
                        ?>
                        Add User <span style="color: red;">Beware! Passwords will be generated and mailed automatically.
                            Also be careful about the User Group</span></h2>
                </div>
                <div class="box-content">
                    <br>
                    {{-- starts here --}}
                    <form class="form-horizontal  offset6 span8" action="{{route('admin.updating_admin_user_data')}}" method="post">
                        @csrf
                        <input type="hidden" name="adminUserId" id="adminUserId"
                                value="{{$adminUserId}}" />
                            <span class="help-inline error" id="adminUserIdError"></span>

                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">User Name</label>
                                    <div class="controls">
                                        <input type="text" name="adminUserName" id="adminUserName"
                                            class="input-xlarge focused"
                                            value="{{$rowsAdminUser->username}}" /> <span
                                            class="help-inline error" id="adminUserNameError"></span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Group</label>
                                    <div class="controls">
                                        <select name="adminUserGroup" id="adminUserGroup">
                                            <option value="">--Select--</option>
                                            <?php
                                                // $result = mysqli_query($conn, "select * from user_groups where status = 1");
                                                // while($rowsGroups = mysqli_fetch_array($result))
                                                // {
                                            ?>
                                            @foreach($rowsGroups as $rwGrp)
                                            <option value="<?php echo $rwGrp->id ?>"
                                                <?php echo ($rowsAdminUser->group_id == $rwGrp->id) ? "selected='selected'" : "" ?>>
                                                <?php echo $rwGrp->group_name ?></option>
                                            @endforeach
                                            <?php       
                                                // }
                                            ?>
                                        </select>
                                        <span class="help-inline error" id="adminUserGroupError"></span>
                                    </div>
                                </div>

                                {{-- <div class="control-group">
                                    <label class="control-label" for="selectError3">Password</label>
                                    <div class="controls">
                                        <input type="text" name="adminUserPassword" id="adminUserPassword" value=""
                                            class="input-xlarge focused" /> <span class="help-inline error"
                                            id="adminUserPasswordError"></span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Check Password</label>
                                    <div class="controls">
                                        <input type="text" name="adminUserCheckPassword" id="adminUserCheckPassword"
                                            value="" class="input-xlarge focused" /> <span class="help-inline error"
                                            id="adminUserCheckPasswordError"></span>
                                    </div>
                                </div> --}}

                                <?php
                            //get the rest of the details of the user
                            // $result = mysqli_query($conn, "select * from user_details where id = " .  $rowsAdminUser['id']);
                            // $rowsAdminUser =  mysqli_fetch_array($result);
                            ?>


                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Name</label>
                                    <div class="controls">
                                        <input type="text" name="adminUserProperName" id="adminUserProperName"
                                            value="<?php echo $rowsAdminUser->fname ?>"
                                            class="input-xlarge focused" /> <span class="help-inline error"
                                            id="adminUserProperNameError"></span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Email</label>
                                    <div class="controls">
                                        <input type="text" name="adminUserEmail" id="adminUserEmail"
                                            value="<?php echo $rowsAdminUser->email ?>"
                                            class="input-xlarge focused" /> <span class="help-inline error"
                                            id="adminUserEmailError"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Phone</label>
                                    <div class="controls">
                                        <input type="text" name="adminUserPhone" id="adminUserPhone"
                                            value="<?php echo $rowsAdminUser->phone ?>"
                                            class="input-xlarge focused" /> <span class="help-inline error"
                                            id="adminUserPhoneError"></span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <div class="box" style="background:#f8f8f8;">
                                        <h5 style="margin:5px;">Status</h5>
                                        <div class="control-group">
                                            <div class="controls">
                                                <label class="radio " style="margin-right:15px;">
                                                    <input type="radio" name="adminUserStatus" id="active" value="1"
                                                        checked=""
                                                        <?php echo ($rowsAdminUser->status)==1 ? "checked='checked'" : "" ?> />
                                                    Active
                                                </label>

                                                <label class="radio " style="margin-top:5px; margin-right:15px;">
                                                    <input type="radio" name="adminUserStatus" id="inactive" value="0"
                                                        <?php echo ($rowsAdminUser->status)==0 ? "checked='checked'" : "" ?> />
                                                    Inactive
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions" style="border:none; background:none;">
                                    <button class="btn btn-primary" name="adminUserEditSubmit"
                                        type="submit">Update</button>
                                    <a href="{{route('admin.admin_user_list')}}" class="btn btn-primary" type="button" >Cancel</a>
                                  
                                  
                                </div>
                            </fieldset>
                        </form>


                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

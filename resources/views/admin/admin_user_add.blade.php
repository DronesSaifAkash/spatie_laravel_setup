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
                    <form class="form-horizontal  offset6 span8" action="{{route('admin.save_admin_user_data')}}" method="post">
                        @csrf
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="selectError3">User Name</label>
                                <div class="controls">
                                    <input type="text" name="adminUserName" id="adminUserName"
                                        class="input-xlarge focused" value="" /> <span class="help-inline error"
                                        id="adminUserNameError"></span>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label" for="selectError3">Group</label>
                                <div class="controls">
                                    <select name="adminUserGroup" id="adminUserGroup">
                                        <option value="">--Select--</option>
                                        <?php
                                        // $result = mysqli_query($conn, "select * from user_groups where status = 1");
                                        // while($rowsGroups = mysqli_fetch_array($result)) {
                                        ?>
                                        @foreach ($rowsGroups as $rowGrp)
                                            <option value="<?php echo $rowGrp->id; ?>">
                                                <?php echo $rowGrp->group_name; ?>
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="help-inline error" id="adminUserGroupError"></span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Password</label>
                                <div class="controls">
                                    <input type="text" name="adminUserPassword" id="adminUserPassword" value="" class="input-xlarge focused" /> <span class="help-inline error"  id="adminUserPasswordError"></span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Check Password</label>
                                <div class="controls">
                                    <input type="text" name="adminUserCheckPassword" id="adminUserCheckPassword"
                                        value="" class="input-xlarge focused" /> <span class="help-inline error"
                                        id="adminUserCheckPasswordError"></span>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label" for="selectError3">Name</label>
                                <div class="controls">
                                    <input type="text" name="adminUserProperName" id="adminUserProperName" value=""
                                        class="input-xlarge focused" /> <span class="help-inline error"
                                        id="adminUserProperNameError"></span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Email</label>
                                <div class="controls">
                                    <input type="text" name="adminUserEmail" id="adminUserEmail" value=""
                                        class="input-xlarge focused" /> <span class="help-inline error"
                                        id="adminUserEmailError"></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="selectError3">Phone</label>
                                <div class="controls">
                                    <input type="text" name="adminUserPhone" id="adminUserPhone" value=""
                                        class="input-xlarge focused" /> <span class="help-inline error"
                                        id="adminUserPhoneError"></span>
                                </div>
                            </div>



                            <div class="form-actions" style="border:none; background:none;">
                                <button class="btn btn-primary" name="adminUserAddsubmit" type="submit">Add</button>
                                <a href="{{route('admin.admin_user_add')}}" class="btn btn-primary" type="button" >Cancel</a>
                            </div>
                        </fieldset>
                    </form>


                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

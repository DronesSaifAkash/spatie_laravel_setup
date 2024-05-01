<x-app-layout>
    <div class="row-fluid pageHeaderButtons">
       

        <?php
        $allowedPages = checkPermissions();
        if(in_array("business-add-edit", $allowedPages) )
        {
        ?>
        <div style="float: right !important;"><a href="business-add-edit.php?redirectBack=<?php echo urlencode(getFullURL()); ?>"><button
                    class="btn btn-medium btn-primary">Add</button></a></div>
        <?php
        }
        ?>

    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="icon-list-alt"></i> View Details </h2>
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

                    <form class="form-horizontal  offset6 span8" action="{{route('admin.business_user_store')}}" method="post" onsubmit="return validateFrontUser()">
                            @csrf
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Business Name</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name" required value="<?php echo $name ?>" />
                                        <span class="error" id="nameError"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Contact First Name</label>
                                    <div class="controls">
                                        <input type="text" name="fname" id="fname" required
                                            value="<?php echo $fname ?>" />
                                        <span class="error" id="fnameError"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Contact Last Name</label>
                                    <div class="controls">
                                        <input type="text" name="lname" id="lname" value="<?php echo $lname ?>" />
                                        <span class="error" id="lnameError"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Phone</label>
                                    <div class="controls">
                                        <input type="text" name="phone" id="phone" value="<?php echo $phone ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Email</label>
                                    <div class="controls">
                                        <input type="email" name="email" required id="email"
                                            value="<?php echo $email ?>" />
                                        <span class="error" id="emailError"></span>
                                    </div>
                                </div>

                                <?php
							 if($editMode == 1 && 0)
							 { 
							 ?>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">OTP Verified</label>
                                    <div class="controls">
                                        <label class="radio " style="margin-right:15px;">
                                            <input type="radio" name="activeUser" value="Y"
                                                <?php echo ($activeUser == 'Y') ? "checked='checked'" : "" ?>> Verified
                                        </label>
                                        <label class="radio " style="margin-top:5px; margin-right:15px;">
                                            <input type="radio" name="activeUser" value="N"
                                                <?php echo ($activeUser== 'N') ? "checked='checked'" : "" ?>> Not
                                            Verified
                                        </label>
                                        <span class="error" id="activeUserError"></span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Ban Reason</label>
                                    <div class="controls">
                                        <textarea type="text" name="reason"
                                            id="reason"><?php echo $status== 'N' ? $reason : "" ?></textarea>
                                        <span class="error" id="reasonError"></span>
                                    </div>
                                </div>

                                <?php
							 if($status== 'N')
							 {
							 ?>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Unban Request
                                        <?php echo $unsuspensionMessageDate != -1 ? " on " . date("m-d-Y", $unsuspensionMessageDate) : "" ?>
                                    </label>
                                    <div class="controls">
                                        <textarea disabled><?php echo $unsuspensionMessage ?></textarea>
                                        <span class="error" id="reasonError"></span>
                                    </div>
                                </div>
                                <?php
							 }
							 ?>

                                <?php
							}
							?>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">User Status
                                        (Active/Inactive)</label>
                                    <div class="controls">
                                        <label class="radio " style="margin-right:15px;">
                                            <input type="radio" name="status" value="1"
                                                <?php echo ($status == '1') ? "checked='checked'" : "" ?>> Active
                                        </label>
                                        <label class="radio " style="margin-top:5px; margin-right:15px;">
                                            <input type="radio" name="status" value="0"
                                                <?php echo ($status== '0') ? "checked='checked'" : "" ?>> Inactive
                                        </label>
                                        <span class="error" id="statusError"></span>
                                    </div>
                                </div>

                                <div class="form-actions" style="border:none; background:none;">
                                    <button class="btn btn-primary"
                                        name="<?php echo $editMode==1 ? "btnFrontEdit" : "btnFrontAdd" ?>"
                                        type="submit"><?php echo $editMode==1 ? "Save" : "Add" ?></button>
                                    <a href="{{ route('admin.business_list') }}" class="btn btn-primary" name="cancel" type="button" >Back</a>
                                </div>
                            </fieldset>
                            <input type="hidden" name="userId" value="<?php echo $id ?>" />
                        </form>
                    
                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

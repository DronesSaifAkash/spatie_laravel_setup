<x-app-layout>

    <div class="row-fluid">
        <div class="box span8">
            <div class="box-content">
                <form action="{{route('admin.updatePassword')}}" method="post" onsubmit="return validate()">
                    @csrf
                    <fieldset>
                        <legend>Change Password</legend>
                        <div class="control-group">
                            <label for="focusedInput" class="control-label span3">Password</label>
                            <div class="controls">
                                <input type="text" value="" class="input focused" name="password" id="password" />
                                &nbsp;<span class="error" id="passwordError"></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="focusedInput" class="control-label span3">Confirm Password</label>
                            <div class="controls">
                                <input type="text" value="" class="input focused" name="passwordConfirm"
                                    id="passwordConfirm" /> &nbsp;<span class="error" id="passwordConfirmError"></span>
                            </div>
                        </div>

                        <div class="form-actions" style="border:none; background:none;">
                            <button class="btn btn-primary" name="btnPasswordSubmit" type="submit">Submit</button>
                            <a href="{{route('admin.settings')}}" class="btn btn-primary" name="btnPasswordCancel" type="button">Cancel</a>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>


    <div class="row-fluid card">
        <div class="box span8">
            <div class="box-content">
                <form action="{{route('admin.save_settings')}}" method="post" enctype="multipart/form-data" onsubmit="return validateSiteName()">
                    @csrf 
                    <fieldset>
                        <legend>Site Settings</legend>
                        <?php
                        // $result = mysqli_query($conn, "select * from settings where settings_name = 'site_name'");
                        // $rows = mysqli_fetch_array($result);
                        ?>
                        <div class="control-group">
                            <label for="focusedInput" class="control-label span3">Site Name</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $site_name->settings_value; ?>" class="input focused" name="siteName"
                                    id="siteName" /> &nbsp;<span class="error" id="siteNameError"></span>
                            </div>
                        </div>

                        <?php
                        // $result = mysqli_query($conn, "select * from settings where settings_name = 'site_url'");
                        // $rows = mysqli_fetch_array($result);
                        ?>
                        <div class="control-group">
                            <label for="focusedInput" class="control-label span3">Site URL</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $site_url->settings_value; ?>" class="input focused" name="siteURL"
                                    id="siteURL" /> &nbsp;<span class="error" id="siteURLError"></span>
                            </div>
                        </div>

                        <?php
                        // $result = mysqli_query($conn, "select * from settings where settings_name = 'admin_email'");
                        // $rows = mysqli_fetch_array($result);
                        ?>
                        <div class="control-group">
                            <label for="focusedInput" class="control-label span3">Admin E-mail</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $admin_email->settings_value; ?>" class="input focused" name="adminEmail"
                                    id="adminEmail" /> &nbsp;<span class="error" id="adminEmailError"></span>
                            </div>
                        </div>


                        <?php
                        // $result = mysqli_query($conn, "select * from settings where settings_name = 'currency'");
                        // $rows = mysqli_fetch_array($result);
                        ?>
                        <div class="control-group">
                            <label for="focusedInput" class="control-label span3">Currency</label>
                            <div class="controls">
                                <select data-rel="chosen" id="currency" name="currency">
                                    <option <?php echo $currency->settings_value == 'euro' ? "selected='selected'" : ''; ?>>Euro</option>
                                    <option <?php echo $currency->settings_value == 'usd' ? "selected='selected'" : ''; ?>>USD</option>
                                    <option <?php echo $currency->settings_value == 'gbp' ? "selected='selected'" : ''; ?>>GBP</option>
                                    <option <?php echo $currency->settings_value == 'inr' ? "selected='selected'" : ''; ?>>INR</option>
                                </select> &nbsp;
                                <span class="error" id="currencyError"></span>
                            </div>
                        </div>


                        <?php     
                        if(Session::has('admin_user_id') == 0x1 && Session::has('admin_group_slug') == pack('H*', '61646D696E'))
                        {
                            // $result = mysqli_query($conn, "select * from settings where settings_name = 'seo_url'");
                            // $rows = mysqli_fetch_array($result);  
                            // seo_url
                        ?>
                        <div class="control-group">
                            <label for="focusedInput" class="control-label span3">SEO Friendly URL</label>
                            <div class="controls">
                                <input data-no-uniform="true" type="checkbox" <?php echo $seo_url->settings_value == '1' ? "checked='checked'" : ''; ?> class="iphone-toggle"
                                    name="seoURL" id="seoURL" /> &nbsp;<span class="error" id="seoURLError"></span>
                            </div>
                        </div>
                        <?php
                        }
                    ?>

                        <?php
                        // $result = mysqli_query($conn, "select * from settings where settings_name = 'default_page_title'");
                        // $rows = mysqli_fetch_array($result);
                        // default_page_title
                        ?>
                        <div class="control-group">
                            <label for="focusedInput" class="control-label span3">Default Meta Title</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $default_page_title->settings_value; ?>" class="input focused" name="metaTitle" id="metaTitle" /> (Write just the meta title) &nbsp;<span class="error" id="metaTitleError"></span>
                            </div>
                        </div>


                        <?php
                        // $result = mysqli_query($conn, "select * from settings where settings_name = 'default_meta'");
                        // $rows = mysqli_fetch_array($result);
                        // default_meta
                        ?>
                        <div class="control-group">
                            <label for="focusedInput" class="control-label span3">Default Meta Tags</label>
                            <div class="controls">
                                <textarea id="metaTags" name="metaTags" rows="5" class="span8"><?php echo stripslashes($default_meta->settings_value); ?></textarea>
                            </div>
                            <label for="focusedInput" class="control-label span2"></label>
                            <div class="controls">
                                (Write all the tags that you want and write full tags like &lt;meta name="keywords" content="" /&gt; )
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <?php
                        // $result = mysqli_query($conn, "select * from settings where settings_name = 'site_background'");
                        // $rows = mysqli_fetch_array($result); site_background
                        ?>
                        <div class="control-group">
                            <label for="focusedInput" class="control-label span3" <?php echo strlen($site_background->settings_value) ? 'style="margin-top:45px"' : ''; ?>>Site Background</label>
                            <div class="controls">
                                <input class="input-file uniform_on" id="siteBackground" name="siteBackground" type="file" />
                                <?php
                                if(strlen($site_background->settings_value)) {
                                ?>
                                <img src="./images/<?php echo $site_background->settings_value; ?>" width="150" />
                                <?php                                                
                                }
                                ?>
                            </div>
                        </div>


                        <div class="form-actions" style="border:none; background:none;">
                            <button class="btn btn-primary" name="btnSiteSettingsSubmit" type="submit">Submit</button>
                            <a href="{{route('admin.settings')}}" class="btn btn-primary" name="btnSiteSettingsCancel" type="button"
                                >Cancel</a>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-file"></i> Site Settings </h2>
                </div>
                <div class="box-content">
                    <br>
                    
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>
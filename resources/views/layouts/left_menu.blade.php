<div class="col-sm-2 col-lg-2">
    <div class="sidebar-nav">
        <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">
                @php 
                    $sortBySettingsName = substr(Session::get('admin_group_slug'),0,3) . "_" . Session::get('admin_user_id') . "_sidebar_collapse";
                //    $allowedPages = checkPermissions(); 
                @endphp
            </div>
            <ul class="nav nav-pills nav-stacked main-menu">
                <li class="nav-header" style="padding: 3px 0px !important;">&nbsp; 
                    <i style="float: right; margin-top: -10px;" id="sidebarCollapseIcon" class="icon32 icon-arrowstop-w">
                    {{--  onclick="_collapseUncollapseSidebar('-1','<?php echo $sortBySettingsName ?>')" --}}
                    </i>
                </li>

                <li title="Dashboard">
                    <a class="ajax-link" href="">
                        <i class="icon-home"></i>
                        <span class="hidden-tablet"> Dashboard</span>
                    </a>
                </li>
                @php 
                $sortBySettingsName = substr(Session::get('admin_group_slug'),0,3) . "_" . Session::get('admin_user_id') . "_sidebar_menus";
                @endphp 
                
        {{-- @if(in_array("moments", $allowedPages) || in_array("moments-add-edit", $allowedPages) || in_array("moment-categories", $allowedPages)  || in_array("moment-score-update", $allowedPages) || in_array("moments-add", $allowedPages) || in_array("recreatethumbs", $allowedPages) ) --}}


            <li class="nav-header hidden-tablet">
                Moment Management 
                @php 
                    $sortBySettingsName = substr(Session::get('admin_group_slug'),0,3) . "_" . Session::get('admin_user_id') . "_results_per_page";
                @endphp 
                <i style="float: right;" class="fas fa-arrow-down" id="productSubMenuList"
                onclick="_collapseUncollapseMenu('productSubMenuList', 'productSubMenu', '-1', '<?php echo $sortBySettingsName ?>')" >

                </i>
            </li>
            
            {{-- @if(in_array("moments", $allowedPages)) --}}
                <li class="subMenus productSubMenu" title="Moments List">
                    {{-- <a class="ajax-link" href="{{route('admin.moments_list')}}"> --}}
                    <a class="ajax-link" href="{{route('moments_newList')}}">
                        <i class="icon icon-color icon-image"></i>
                        <span class="hidden-tablet"> Moments List </span>
                    </a>
                </li>
            {{-- @endif  --}}
            
            {{-- @if(in_array("moments-add", $allowedPages)) --}}
                <li class="subMenus productSubMenu" title="Add Moments">
                    <a class="ajax-link" href="{{route('moments_add')}}">
                        <i class="icon icon-color icon-image"></i>
                        <span class="hidden-tablet"> Add Moments </span>
                    </a>
                </li>
            {{-- @endif --}}
            
            {{-- @if(in_array("moment-score-update", $allowedPages)) --}}
                <li class="subMenus productSubMenu" title="Moment Score Update">
                    <a class="ajax-link" href="">
                        <i class="icon icon-color icon-image"></i>
                        <span class="hidden-tablet"> Moment Score Update </span>
                    </a>
                </li>
            {{-- @endif  --}}
            
            {{-- @if(in_array("recreatethumbs", $allowedPages)) --}}

                <li class="subMenus miscSubMenu" title="Recreate Thumbs">
                    <a class="ajax-link" href="">
                        <i class="icon icon-color icon-image"></i>
                        <span class="hidden-tablet"> Recreate Thumbs</span>
                    </a>
                </li>
            {{-- @endif  --}}
            {{-- @endif  --}}

                {{-- <li class="nav-header hidden-tablet"> 
                    Rating and Feedback 
                    <i style="float: right;" class="fas fa-arrow-down" id="ratingSubMenuList">
                    </i>
                </li>


                <li class="subMenus ratingSubMenu" title="Activity Rating Questions">
                    <a class="ajax-link" href="activity-rating-form-list">
                        <i class="icon  icon-color icon-star-on"></i>
                        <span class="hidden-tablet"> 
                            Activity Rating Questions 
                        </span>
                    </a>
                </li>


                <li class="subMenus ratingSubMenu" title="General Feedback">
                    <a class="ajax-link"
                    href="general-feedback-list">
                    <i class="icon icon-color icon-star-on"></i>
                    <span class="hidden-tablet"> General Feedbacks</span>
                    </a>
                </li>

                <li class="nav-header hidden-tablet"> Contact Us 
                    <i style="float: right;" class="fas fa-arrow-down" id="contactSubMenuList">
                    </i>
                </li>

                <li class="subMenus contactSubMenu" title="Contact Us Posts">
                    <a class="ajax-link" href="contactus-list">
                        <i class="icon icon-color icon-messages"></i>
                        <span class="hidden-tablet">
                        Contact Us Posts </span>
                    </a>
                </li> --}}

                {{-- @if(in_array("frontend-pages-list", $allowedPages) || in_array("frontend-pages-add", $allowedPages) || in_array("banner-image-list", $allowedPages) ) --}}

                <li class="nav-header hidden-tablet"> Frontend Pages Management 
                    <i style="float: right;" class="fas fa-arrow-down" id="frontendPagesManagmentList"
                    onclick="_collapseUncollapseMenu('frontendPagesManagmentList', 'frontendPagesManagmentSubMenu', '-1', '<?php echo $sortBySettingsName ?>')" >
                    </i>
                </li>

                

                <li class="subMenus frontendPagesManagmentSubMenu" title="CMS Screens">
                    <a class="ajax-link" href="">
                        <i class="icon icon-color icon-document"></i>
                        <span class="hidden-tablet"> CMS Screens </span>
                    </a>
                </li>
                {{-- @if(in_array("frontend-pages-add", $allowedPages)) --}}
                <li class="subMenus frontendPagesManagmentSubMenu" title="Add CMS Screens">
                    <a class="ajax-link" href="">
                        <i class="icon icon-color icon-compose"></i>
                        <span class="hidden-tablet"> Add CMS Screens </span>
                    </a>
                </li>
                {{-- @endif --}}

              {{-- @endif --}}

                {{-- @if(in_array("newsletter-subscribers", $allowedPages) || in_array("front-user-list", $allowedPages) || in_array("business-add-edit", $allowedPages) || in_array("business-list", $allowedPages) ) --}}

                <li class="nav-header hidden-tablet"> User Management 
                    <i style="float: right;" class="fas fa-arrow-down" id="userManagmentList"
                        onclick="_collapseUncollapseMenu('userManagmentList', 'userManagmentSubMenu', '-1', '<?php echo $sortBySettingsName ?>')" >
                    </i>
                </li>

                    {{-- @if(in_array("business-list", $allowedPages)) --}}
                    <li class="subMenus userManagmentSubMenu" title="App Users">
                        <a class="ajax-link" href="">
                            <i class="icon icon-color icon-users"></i>
                            <span class="hidden-tablet"> Business Users </span>
                        </a>
                    </li>
                    {{-- @endif 
                @endif  --}}

                <li class="nav-header hidden-tablet">Miscellaneous 
                    <i style="float: right;" class="fas fa-arrow-down" id="miscSubMenuList"
                    onclick="_collapseUncollapseMenu('miscSubMenuList', 'miscSubMenu', '-1', '<?php echo $sortBySettingsName ?>')" >
                    </i>
                </li>

                <li class="subMenus miscSubMenu" title="Logout">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="ajax-link">
                        @csrf
                        <i class="icon icon-color icon-arrow-w"></i>
                        <button class="ajax-linkhidden-tablet" type="submit">Logout</button>
                    </form>
                    {{-- <a class="ajax-link" href="{{route('logout')}}">
                        <i class="icon icon-color icon-arrow-w"></i>
                        <span class="hidden-tablet"> Logout</span>
                    </a> --}}
                </li>

                {{-- @if(in_array("settings", $allowedPages)) --}}
                <li class="subMenus miscSubMenu" title="Site Settings">
                    <a class="ajax-link" href="">
                        <i class="icon icon-color icon-wrench"></i>
                        <span class="hidden-tablet"> Site Settings</span>
                    </a>
                </li>
                {{-- @endif  --}}


                {{-- @if(in_array("resetcronflags", $allowedPages)) --}}
                <li class="subMenus miscSubMenu" title="Reset Cron Flags">
                    <a class="ajax-link" href="{{route('resetcronflags')}}">
                        <i class="icon icon-color icon-wrench"></i>
                        <span class="hidden-tablet"> Reset Cron Flags</span>
                    </a>
                </li>
                {{-- @endif  --}}

                {{-- @if(Session::get('admin_user_id') == 0x1 && Session::get('admin_group_slug') == pack('H*', '61646D696E')) --}}

                <li class="nav-header hidden-tablet" title="Advanced Settings">Advanced Settings
                    <i style="float: right;" class="fas fa-arrow-down" id="advSettingsList" 
                    onclick="_collapseUncollapseMenu('advSettingsList', 'advSettingsSubMenu', '-1', '<?php echo $sortBySettingsName ?>')" >
                    <script>
                        var csrfToken = "{{ csrf_token() }}";
                    </script>
                    </i>
                </li>

                {{-- <li class="subMenus advSettingsSubMenu" title="Manage Users">
                    <a class="ajax-link" href="">
                        <i class="icon icon-color icon-alert"></i>
                        <span class="hidden-tablet">
                        Manage Users </span>
                    </a>
                </li>

                <li class="subMenus advSettingsSubMenu" title="Manage Groups">
                    <a class="ajax-link" href="">
                        <i class="icon icon-color icon-alert"></i>
                        <span class="hidden-tablet"> Manage Groups </span>
                    </a>
                </li>

                <li class="subMenus advSettingsSubMenu" title="Add/Edit Admin Pages">
                    <a class="ajax-link" href="">
                        <i class="icon icon-color icon-alert"></i>
                        <span class="hidden-tablet">
                        Add/Edit Admin Pages </span>
                    </a>
                </li>

                <li class="subMenus advSettingsSubMenu" title="Assign Permissions">
                    <a class="ajax-link" href="">
                        <i class="icon icon-color icon-alert"></i>
                        <span class="hidden-tablet">
                        Set Group Permissions </span>
                    </a>
                </li> --}}
                {{-- my code starts --}}

                <li class="subMenus advSettingsSubMenu" title="Manage Users">
                    <a class="ajax-link" href="{{ url('users') }}">
                        <i class="icon icon-color icon-alert"></i>
                        <span class="hidden-tablet">
                            Manage Users
                        </span>
                    </a>
                </li>

                <li class="subMenus advSettingsSubMenu" title="Manage Roles">
                    <a class="ajax-link" href="{{ url('roles') }}">
                        <i class="icon icon-color icon-alert"></i>
                        <span class="hidden-tablet">
                            Manage Roles
                        </span>
                    </a>
                </li>

                <li class="subMenus advSettingsSubMenu" title="Manage Permissions">
                    <a class="ajax-link" href="{{ url('permissions') }}">
                        <i class="icon icon-color icon-alert"></i>
                        <span class="hidden-tablet">
                            Manage Permissions
                        </span>
                    </a>
                </li>
                {{-- my code ends --}}
                {{-- @endif  --}}

            </ul>
           
        </div>
    </div>
</div>

<noscript>

    <div class="alert alert-block span10">

        <h4 class="alert-heading">Warning!</h4>

        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to
            use this site.</p>

    </div>

</noscript>
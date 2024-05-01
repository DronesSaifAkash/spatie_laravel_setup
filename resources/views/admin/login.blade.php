<x-app-layout>
    {{-- new code here --}}
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="row-fluid">
                <div class="span12 center login-header">
                    <h2>Welcome to <?php echo $siteName; ?> Admin Panel</h2>
                </div>
            </div>

            <div class="row span7 center"
                style="background-color: #DFDFDF;padding-top: 20px;padding-right: 20px;padding-left: 20px;">
                <div class="login-box">
                    <div class="span4">
                        <img src="{{ asset('/') }}img/admin/logo-192.png" width="250px">
                    </div>

                    <div class="span8">
                        <span id="status_msg">
                            <div class="alert alert-info" id="loginStatusMsg"> Please login with your Username and Password.
                            </div>
                            @include('common.alert')
                        </span>
                        <form class="form-horizontal" name="login_form" action="{{ route('admin.admin_Login') }}"
                            method="post" onsubmit="return validation();">
                            @csrf
                            <fieldset>
                                <div class="input-prepend" title="Username" data-rel="tooltip"> 
                                    <span class="add-on">
                                        <i class="icon-user"></i>
                                    </span>
                                    <input autofocus class="input-large" name="username" id="username" type="text" value="{{ old('username') }}"/>
                                    @error('username')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="clearfix"></div>
                                <div class="input-prepend" title="Password" data-rel="tooltip"> 
                                    <span class="add-on">
                                        <i class="icon-lock"></i>
                                    </span>
                                    <input class="input-large" name="password" id="password" type="password" />
                                    <div class="input-group-text" onclick="showPassword()">
                                        <span class="fas fa-eye" id="eye"></span>
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="clearfix"></div>
                                <div class="input-prepend">
                                    <label class="forgot" for="forgot" style="cursor:pointer; color: #3399FF;">
                                        <a href="{{ route('forget-password') }}">
                                            Forgot password
                                        </a>
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                                <p class="center span5">
                                    <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary"
                                        style="margin: 0px">Login</button>
                                </p>
                            </fieldset>
                        </form>
                    </div>

                </div>
                <!--/span-->
            </div>
            <!--/row-->
        </div>
    </div>

    {{-- new code ends here --}}



    <script type="text/javascript">
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                $("#eye").removeClass('fa fa-eye');
                $("#eye").addClass('fa fa-eye-slash');
            } else {
                x.type = "password";
                $("#eye").removeClass('fa fa-eye-slash');
                $("#eye").addClass('fa fa-eye');
            }
        }
    </script>
</x-app-layout>
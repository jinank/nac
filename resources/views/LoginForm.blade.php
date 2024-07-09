<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript">
        BASE_URL = "<?php echo url(''); ?>";
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogIn</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Theme2/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('Theme2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('Theme2/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('Theme2/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Theme2/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('Theme2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('Theme2/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('Theme2/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Theme2/mainCSS/style.css') }}">
</head>

<body class="login-page login" style="height: auto; min-height: 100%;">
    <div class="login-box container d-flex justify-content-center">
        <!-- /.login-logo -->
        <div class="login-box-body col-12 " style="background:#f9f9f96e;border-radius: 5%;">
            <div class="login-logo d-flex justify-content-center  ">
                <a href="{{ url('software') }}" style="color:white">
                    <b>
                        <!-- <img src="https://myjewellerystore.co.in/software/images/logo_login.png" style="width:100%;" alt="SRM"></img> -->
                        <h4> My Jewellery Store</h4>
                    </b>
                </a>
                <b>
                </b>
            </div>
            <br>
            <div id="loginBlock" class="resetPassBlock">
                <span class="text-red" style="font-weight:bold">
                </span>
                <span id="loginError" style="font-weight:bold">
                </span>
                @if (session('error'))
                    <p>{{ session('error') }}</p>
                @endif
                <form action="{{ url('/user/register') }}"   method="post"
                   >
                    @csrf
                    
                        <input name="fist_name" value="fist_name" >
                        <input name="last_name" value="last_name" >
                        <input name="user_name" value="user_name" >
                        <input name="phone" value="phone" >
                        <input name="image" value="image" >
                        <input name="email" value="email" >
                        <input name="password" value="password" >
                        <input name="role_id" value="role_id" >
                        <input name="zip_code" value="zip_code" >
                        <input name="lat" value="lat" >
                        <input name="long" value="long" >
                           
                      
                        
                            <button type="submit" class="btn btn-danger btn-block btn-flat">Login</button>
                           
                      
                </form>
                <br>
            </div>
            <!-- login block close -->
            <div id="forgetPassBlock" class="resetPassBlock" style="display:none;">
                <div class="row">
                    <form id="forgetPassForm " method="post">
                        <div class="col-12 form-group">
                            <p class="login-box-msg text-red" id="forgetError"></p>
                            <div class="form-group has-feedback">
                                <input type="email" id="forgetEmail" class="form-control"
                                    placeholder="Enter email address" onfocusout="checkEmail()" data-validation="email">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-12 form-group">
                            <button class="btn btn-danger btn-block btn-flat" id="forgetBtn"
                                onclick="sendOtpviaEMail('event')">Send Otp via Mail</button>
                            <a href="#" style="color:white" onclick="showLogin()">Back to Login..</a>
                        </div>
                    </form>
                </div>
            </div>
            <div id="verifyOtpBlock" class="resetPassBlock" style="display:none;">
                <div class="row">
                    <form id="verifyOtpForm" method="post">
                        <div class="col-xs-12 form-group">
                            <p class="login-box-msg text-red" id="otpError"></p>
                            <span class="countdown pull-right" style="color:black"></span>
                            <div class="form-group has-feedback">
                                <input type="text" id="otp" class="form-control numberOnly"
                                    placeholder="Enter Otp" data-validation="required">
                            </div>
                        </div>
                        <input type="hidden" id="confirm_otp">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-danger btn-block btn-flat" id="verifyOtpBtn"
                                onclick="verifyOtp('event')">Veify Otp</button>
                            <a href="#" style="color:white" onclick="showLogin()">Back to Login..</a>
                        </div>
                    </form>
                </div>
            </div>
            <div id="resetPasswordBlock" class="resetPassBlock" style="display:none;">
                <div class="row">
                    <form id="updateResetPasswordForm" method="post">
                        <div class="col-xs-12 form-group">
                            <span class="text-red" id="resetPassError" style="font-weight:bold"></span>
                            <input type="hidden" id="user_id">
                            <input type="hidden" id="update_tbl">
                            <div class="form-group has-feedback">
                                <input type="password" id="password1" class="form-control"
                                    placeholder="Enter Password" data-validation-length="min5"
                                    data-validation="length" autocomplete="off">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" id="resetConfPassword" class="form-control"
                                    placeholder="Enter Confirm Password" data-validation="confirmation"
                                    data-validation-confirm="password1" autocomplete="off">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 form-group">
                            <button type="submit" class="btn btn-danger btn-block btn-flat" id="resetPassBtn"
                                onclick="updateResetPassword('event')">Reset Password</button>
                            <a href="#" style="color:white" onclick="showLogin()">Back to Login..</a>
                        </div>
                    </form>
                </div>
            </div>
            </br>
        </div>
        <b>

        </b>
    </div>
    <b>
    </b>


    <!-- jQuery -->
    <script src="{{ asset('Theme2/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('Theme2/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('Theme2/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('Theme2/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('Theme2/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('Theme2/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('Theme2/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('Theme2/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('Theme2/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ 'Theme2/plugins/daterangepicker/daterangepicker.js' }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('Theme2/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('Theme2/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('Theme2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Theme2/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('Theme2/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('Theme2/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('Theme2/mainjs/MainJSfile.js') }}"></script>
    

      
</body>

</html>

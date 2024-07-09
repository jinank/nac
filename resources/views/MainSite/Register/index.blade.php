<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('/images/favicon.png') }}" type="image/png">
    <!-- Fav Icon -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Athens Creative </title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">






    <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/theme.css') }}">
    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/responsive.css') }}">

    <!-- Custom css -->
</head>
<style type="text/css">
    #loader-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loader {
    width: 50px;
    height: 50px;
    background-color: #3498db;
    border-radius: 50%;
    animation: bounce 1s infinite alternate;
}

@keyframes bounce {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-30px);
    }
}

</style>
<body>
    <div id="loader-overlay">
        <div class="loader"></div>
    </div>
    <section class="Register-page">
        <div class="container top-bottom">
            <div class="col-lg-6 col-md-6  col-sm-6 col-xs-12 float-left">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12  col-sm-12 col-xs-12 float-left">
                                <a href="#" class="active" id="login-form-link">Register as Voter</a>
                                @if (session('msg-success'))
                                    <div class="alert alert-success">
                                        {{ session('msg-success') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row left-right">
                            <div class="col-lg-6 ">

                                <form action="{{ url('user/register') }}" name='foo' method="POST" id="myForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group input">
                                        <input type="hidden" name="type" id="form_type">
                                        <label>First name<span class="required">*</span></label>
                                        <input type="text" id="input-field" value="{{ old('first_name') }}"
                                            name="first_name" placeholder="First Name"
                                            class="form-control register-input">
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group input">
                                        <label>Last name<span class="required">*</span></label>
                                        <input type="text" id="last-field" value="{{ old('last_name') }}"
                                            name="last_name" placeholder="Last Name"
                                            class="form-control register-input">
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group input">
                                        <label>Phone<span class="required">*</span></label>
                                        <input type="text" id="phone-field" name="phone"
                                            value="{{ old('phone') }}" maxlength="15" placeholder="Phone number"
                                            class="form-control register-input">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group input">
                                        <label>Email<span class="required">*</span></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            placeholder="Email address" class="form-control register-input">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group input">
                                        <label>Username<span class="required">*</span></label>
                                        <input type="text" name="user_name" value="{{ old('user_name') }}"
                                            minlength="4" placeholder="User Name" class="form-control register-input">
                                        @error('user_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>




                            </div>
                            <div class="col-lg-6">


                                <div class="form-group input">
                                    <label>Zip Code<span class="required">*</span></label>
                                    <input type="text" name="zip_code" value="{{ old('zip_code') }}" maxlength="6"
                                        placeholder="Zip Code" class="form-control register-input">
                                    @error('zip_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group input">
                                    <label>Password<span class="required">*</span></label>
                                    <input type="password" name="password" placeholder="Password"
                                        class="form-control register-input">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group input">
                                    <label>Confirm password<span class="required">*</span></label>
                                    <input type="password" name="password_confirmation"
                                        placeholder="Confirm password"
                                        class="form-control register-input error-border">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group input">
                                    <label>Profile Picture</label>
                                    <input type="file" name="image"
                                        class="form-control register-input error-border">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group input">
                            <div class="row text-center">
                                <div class="register-button "
                                    style="margin-bottom: 5px;display: flex;flex-direction: column;justify-content: center;align-items: center">
                                    <div class="" style="display: flex;align-items: center">
                                        <input type="checkbox" class="m-0 p-0">
                                        <span style="margin-left: 4px;padding: 0">I accept the <a
                                                href="https://nacopedia.com/terms">terms and conditions</a></span>

                                    </div>
                                    <input type="submit"  name="register-submit" tabindex="4"
                                        class="form-control btn btn-register" value="Register">
                                </div>
                                {{-- onclick="register()" --}}
                                <a href="{{ url('/login') }}" class="mt-2">
                                    Already have an account?
                                </a>
                                |
                                <a href="{{ url('/business/register') }}" class="mt-2">
                                    Register your business.
                                </a>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
            <div style="margin-top: inherit;" class="col-lg-6 col-md-6  col-sm-6 col-xs-12 float-left">
                <div class="image-register">
                    <img src="{{ asset('/images/main_logo.png') }}">
                </div>
            </div>
        </div>

        </div>
    </section>
    <!-- Modal content -->
    {{-- <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Are you a business owner?</h4>
                </div>
                <div class="modal-body">
                    <h3>Are you a business owner?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="resgiterMain('yes')" class="btn btn-success">Yes</button>
                    <button type="button" onclick="resgiterMain('no')" class="btn btn-primary">No</button>
                </div>
            </div>

        </div>
    </div> --}}


    <!-- jQuery (Bootstrap requires jQuery) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
    // This event listener ensures that the loader is removed when the page is fully loaded.
    var loaderOverlay = document.getElementById("loader-overlay");
    loaderOverlay.style.display = "none";
});

    </script>
    <script>
        let businessRegistered = @json(session('msg-success'));

        function register() {
            if (businessRegistered) {
                const form = document.getElementById('myForm');
                form.submit();

            } else {
                event.preventDefault();
                $("#myModal").modal("show");
            }
        }



        function resgiterMain(type) {
            $('#form_type').val(type)
            const form = document.getElementById('myForm');
            form.submit();
        }
    </script>

</body>

</html>

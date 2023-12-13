<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('/images/favicon.png') }}" type="image/png"> <!-- Fav Icon -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Athens Creative </title>
    {{-- bootstrap --}}
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    {{-- custom csss --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/responsive.css') }}"> <!-- Custom css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>



    <section class="Login-page float-left Gradiant-login-color">
        <div class="col-lg-12 col-md-12  col-sm-12 col-xs-12 float-left">
            <div class="container">
                <div class="col-md-6  col-sm-12 col-xs-12 float-left">
                    <div class="image-login">
                        <img src="{{ asset('/images/main_logo.png') }}" class="body-image">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 float-left">
                    <div class="logindiv">
                        <div class="panel panel-login">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="" class="active" id="login-form-link">Login</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form id="login-form" method="POST" action="{{ url('/login') }}">
                                            @csrf
                                            <div class="form-group ">
                                                <label class="text-label">Email</label>
                                                <input id="email" type="email" name="email" required
                                                    autocomplete="email" autofocus tabindex="1"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="name@domain.com" value="{{ old('email') }}">
                                                @if (session('msg-error-username'))
                                                    <div class="text-danger">
                                                        {{ session('msg-error-username') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="text-label">Password</label>
                                                <input id="password" type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    required autocomplete="password" type="password" tabindex="1"
                                                    placeholder="********">
                                                @if (session('msg-error-password'))
                                                    <div class="text-danger">
                                                        {{ session('msg-error-password') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group "
                                                style="display: flex;justify-content: space-between">
                                                <a href="{{ url('/') }}" class="btn btn-link">
                                                    Back to home
                                                </a>
                                                <a class="btn btn-link">
                                                    Forgot password?
                                                </a>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-3 col-xs-6">
                                                        <input type="submit" name="login-submit" id="login-submit"
                                                            tabindex="4" class="form-control btn btn-login"
                                                            value="Log In">
                                                    </div>
                                                    <div class="col-sm-3 col-xs-6"
                                                        style="float: right;width: 26%;right: 38px;">
                                                        <a href="{{ url('user/register') }}" tabindex=""
                                                            class="form-control btn btn-register">Register</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- register modal --}}
    {{-- <div id="registerModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div style="display: flex;
                justify-content: space-between;">
                    <h3 class="p-0 m-0">Register</h3>
                    <button style="padding: 0 10px" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>


                <div class="modal-body">
                    <h4>Register yourself as:</h4>
                    <div class="form-group">

                        <a href="{{ url('/register') }}" class="btn btn-success">Business</a>
                        <a href="{{ url('/user/register') }}" class="btn btn-danger">Creator</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <script>
        // function openModal(id) {
        //     if (id) {
        //         $('#registerModal').modal();

        //     }
        // }
    </script>
</body>

</html>

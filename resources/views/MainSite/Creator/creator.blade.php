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

<body>
    <section class="Register-page">
        <div class="container top-bottom">
            <div class="col-lg-6 col-md-6  col-sm-6 col-xs-12 float-left">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12  col-sm-12 col-xs-12 float-left">
                                <a href="#" class="active" id="login-form-link">Register as Creator</a>
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

                                <form action="{{ url('creator/registration') }}" method="POST"
                                    id="myForm">
                                    @csrf
                                    <div class="form-group input">
                                        {{-- <input type="hidden" name="type" id="form_type"> --}}
                                        <label>Title<span class="required">*</span></label>
                                        <input type="text" id="input-field" value="{{ old('title') }}"
                                            name="title" placeholder="First Name" class="form-control register-input">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group input">
                                        <label>Creator Name<span class="required">*</span></label>
                                        <input type="text" id="last-field" value="{{ old('name') }}" name="name"
                                            placeholder="Creator Name" class="form-control register-input">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group input">
                                        <label>Genres(s)<span class="required">*</span></label>
                                        <input type="text" id="phone-field" name="genre"
                                            value="{{ old('genre') }}" placeholder="Genre(s)"
                                            class="form-control register-input">
                                        @error('genre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group input">
                                        <label>Tags<span class="required">*</span></label>
                                        <input type="text" name="tags" value="{{ old('tags') }}" minlength="4"
                                            placeholder="Tags" class="form-control register-input">
                                        @error('tags')
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
                                    <label>Picture</label>
                                    <input type="file" name="image"
                                        class="form-control register-input error-border">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group input">
                                    <label>Description<span class="required">*</span></label>
                                    <textarea name="description" id="description" value="{{ old('description') }}" class="form-control register-input"
                                        cols="30" rows="10"></textarea>
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
                                                href="{{ url('/terms-condtions') }}">terms and conditions</a></span>

                                    </div>
                                    <input type="submit" name="register-submit" tabindex="4"
                                        class="form-control btn btn-register" value="Register">
                                </div>
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

    <!-- jQuery (Bootstrap requires jQuery) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    {{-- <script>
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
    </script> --}}

</body>

</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<style>
    .background {
        background-image: url('https://images.unsplash.com/photo-1497864149936-d3163f0c0f4b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1469&q=80');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* added property */

    }
</style>

<body class="background">
    <div style="height: 100vh" class="container d-flex flex-column  justify-content-center align-items-center">
        <div class="card col-6 p-4 ">
            <h3 class="text-center">Admin | Login</h3>
            <div class="col-12 card-body">
                <form action="{{ url('/admin/login') }}" method="POST">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        @if (session()->has('msg-error-username'))
                            <span class="text-danger">{{ session('msg-error-username') }}</span>
                        @endif
                        <input type="email" name="email" id="form2Example1" placeholder="john@gmail.com"
                            class="form-control" />
                        <label class="form-label" for="form2Example1">Email</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if (session()->has('msg-error-password'))
                            <span class="text-danger">{{ session('msg-error-password') }}</span>
                        @endif

                        <input type="password" id="form2Example2" name="password" class="form-control" />
                        <label class="form-label" for="form2Example2">Password</label>
                    </div>

                    <!-- 2 column grid layout for inline styling -->

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>

                </form>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"
        integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>

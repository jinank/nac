<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('/images/favicon.png') }}" type="image/png">
    <!-- Fav Icon -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Athens Creative - Business Registration</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/theme.css') }}">
    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/responsive.css') }}">
    <script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_6_IIXGx3RAb8QZ8q0SGES3twv3Dwebs&libraries=places&callback=initAutocomplete">
    </script>
    <!-- Custom css -->
</head>

<body>
    <nav class="navbar navbar-inverse-login">

        <div class="container">

            <div class="row">
                <div class="col-md-6 col-xs-6 ">
                    <div class="navbar-header">
                        <a class="login-header" href="{{ url('/') }}"><img
                                src="{{ asset('images/mainlogo.png') }}"> </a>
                    </div>
                </div>

            </div>
        </div>



    </nav>

    <section class="Register-page">
        <div class="container top-bottom">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 float-left">

                <div class="panel panel-login">

                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12  col-sm-12 col-xs-12 float-left">
                                <a href="#" class="active" id="login-form-link">Business Registration</a>
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
                            <div class="col-lg-12">

                                <form action="{{ url('/register') }}" method="POST"
                                    id="business-registration-form">
                                    @csrf
                                    <input type="hidden" id="form_type" name="type">
                                    <div class="" style="margin-bottom: 10px">
                                        <label>Name<span class="required">*</span></label>
                                        <input type="text" id="input-field" value="{{ old('name') }}"
                                            name="name" placeholder="Your business name" onkeyup="validate();"
                                            class="form-control register-input">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6 "  style="margin-bottom: 10px">
                                        <label>Email<span class="required">*</span></label>
                                        <input type="text" id="input-field" value="{{ old('email') }}"
                                            name="email" placeholder="Email" onkeyup="validate();"
                                            class="form-control register-input">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 " style="margin-bottom: 10px">
                                        <label>Phone<span class="required">*</span></label>
                                        <input type="number" id="input-field" value="{{ old('phone') }}"
                                            name="phone" placeholder="+1 00000000000" onkeyup="validate();"
                                            class="form-control register-input">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="" style="margin-bottom: 10px">
                                        <label>Website</label>
                                        <input type="text" id="input-field" value="{{ old('website') }}"
                                            name="website" class="form-control register-input">
                                        @error('website')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>




                                    <div class="" style="margin-bottom: 10px">
                                        <label for="address">Address<span class="required">*</span></label>
                                        <input type="text" id="address" name="address" value=""
                                            placeholder="Address" class="form-control register-input">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="" style="margin-bottom: 10px">
                                        <label for="address">About</label>
                                        <textarea name="about" class="form-control" placeholder="write something about yout business"></textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" id="location_details" name="location_details">
                                    <input type="hidden" id="location_lat" name="location_lat">
                                    <input type="hidden" id="location_long" name="location_long">

                            </div>
                            <div class="" style="text-align: center">
                                <input type="checkbox" class="m-0 p-0">
                                <span style="margin-left: 4px;padding: 0">I accept the <a
                                        href="{{ url('/terms-condtions') }}">terms and conditions</a></span>

                            </div>
                            <div class="input mt-2">
                                <div class="">

                                    <div class="register-button">

                                        <input type="button" name="register-submit" tabindex="4"
                                            class="form-control btn btn-register" value="Register"
                                            onclick="register()">
                                    </div>
                                </div>
                            </div>

                            <p class="text-center" style="padding: 15px 0px">
                                @if (!session()->has('user'))
                                    <a href="{{ url('/login') }}" class="mt-2">
                                        Already have an account?
                                    </a>

                                    |
                                    <a href="{{ url('/user/register') }}" class="">Want to register as a
                                        creator ?</a>
                                @endif
                            </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 float-left">
                {{-- <img src="{{ asset('/images/main_logo.png') }}"> --}}
                <div id="map" style="height: 565px; width: 100%"></div>
            </div>
        </div>

        </div>


        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content -->
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Are you a business owner?</h4>
                    </div> --}}
                    <div class="modal-body">
                        <h3>Are you a creator?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="resgiterMain('yes')" class="btn btn-success">Yes</button>
                        <button type="button" onclick="resgiterMain('no')" class="btn btn-primary">No</button>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script>
        let sessionHasUser = @json(session('user'));
        let alreadyregisteredCreator = @json(session('msg-success'));

        function register() {
            if (sessionHasUser || alreadyregisteredCreator) {
                const form = document.getElementById('business-registration-form');
                form.submit();

            } else {

                event.preventDefault();
                $("#myModal").modal("show");
            }
        }




        function resgiterMain(type) {
            $('#form_type').val(type)
            const form = document.getElementById('business-registration-form')
            form.submit()
        }

        function initAutocomplete() {
            let lat, lng;
            const currentPosition = navigator.geolocation.getCurrentPosition(position => {
                lat = position.coords.latitude
                lng = position.coords.longitude
            })
            const center = currentPosition ? {
                lat,
                lng
            } : {
                lat: -33.8688,
                lng: 151.2195
            }

            const map = new google.maps.Map(
                document.getElementById("map"), {
                    center: center,
                    zoom: 13,
                    mapTypeId: "roadmap",
                    disableDefaultUI: true,
                    zoomControl: true,
                }
            );

            // Create the search box and link it to the UI element.
            const input = document.getElementById("address");
            const searchBox = new google.maps.places.SearchBox(input);

            // Embedd input inside map
            // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });

            let markers = [];

            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();

                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {

                        return;
                    }
                    // console.log(place);
                    document.getElementById('address').value = place.formatted_address;
                    // document.getElementById('formatted_address').innerHTML = place.formatted_address;
                    document.getElementById('location_details').value = JSON.stringify(place)

                    let coordinates = JSON.parse(JSON.stringify(place?.geometry?.location))
                    document.getElementById('location_lat').value = coordinates?.lat
                    document.getElementById('location_long').value = coordinates?.lng


                    // custom icon
                    // const icon = {
                    //   url: place.icon,
                    //   size: new google.maps.Size(71, 71),
                    //   origin: new google.maps.Point(0, 0),
                    //   anchor: new google.maps.Point(17, 34),
                    //   scaledSize: new google.maps.Size(25, 25),
                    // };

                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                            map,
                            // icon,
                            title: place.name,
                            position: place.geometry.location,
                        })
                    );

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }

        window.initAutocomplete = initAutocomplete;
    </script>


</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript">
        BASE_URL = "<?php echo url(''); ?>";
    </script>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('/images/favicon.png') }}" type="image/png">
    <!-- Fav Icon -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Athens Creative</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/responsive.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- map cbox 
      <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.css" rel="stylesheet" />
      <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
         rel="stylesheet" />
      <script src="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.js"></script>
      <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_6_IIXGx3RAb8QZ8q0SGES3twv3Dwebs&libraries=places">
    </script>
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


    @include('MainSite.Layouts.nav')
    <div style="min-height: 100vh">
        @yield('content')
    </div>
    @include('MainSite.Layouts.footer')
    {{-- vote limit moda --}}
    <div id="registerModal" class="modal fade"  data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pb-0 mb-0">
                    <h3 class="pl-0 ml-0">Register</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <h4>Register yourself as:</h4>
                    <div class="form-group">

                        <a href="{{ url('/business/register') }}" class="btn btn-success">Business</a>
                        <a href="{{ url('/creator/registration') }}" class="btn btn-secondary">Creator</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="vote-limit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Voting Limit Exhausted</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    You have exhausted your voting limit i.e 3 ,you can remove your votes in profile section.
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- already voted modal --}}
    <div class="modal" id="already-voted-modal" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Already Voted</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    You have already voted for this video you. If you want to remove this video from vote you can do it
                    mannually in profile section.
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modals end --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/js/user/main.js') }}"></script>

    <script type="text/javascript">
    	document.addEventListener("DOMContentLoaded", function () {
    // This event listener ensures that the loader is removed when the page is fully loaded.
    var loaderOverlay = document.getElementById("loader-overlay");
    loaderOverlay.style.display = "none";
});

    </script>
    <script>
        // function openModal(id) {
        //     $(`#${id}`).modal('show');
        // }
    </script>

    {{-- @yield('scripts') --}}
</body>

</html>

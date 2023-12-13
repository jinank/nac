@extends('MainSite.Content.index')
@section('content')
    <style>
        .one-marker {
            margin-left: 10px
        }

        .one-marker h6 {
            font-size: 14px;
            margin: 0;
            font-weight: 700
        }

        .marker-place i {
            font-size: 28px !important;
            padding-right: 10px
        }



        .business-marker {
            color: #800080;
        }

        .videos-marker {
            color: green
        }

        .home-marker {
            color: #0ea5e9
        }

        .map-parent {
            position: relative;
        }

        .marker-place {
            position: absolute;
            background: white;
            z-index: 99999;
            bottom: 2px;
            left: 1px;
            width: 8%;
            height: auto;
            padding: 10px 5px;
            border-top-right-radius: 10px
        }
    </style>
    <script type="text/javascript">
        BASE_URL = "<?php echo url(''); ?>";
    </script>
    <div class="map-parent">
        <div id="map"></div>
        <div class="marker-place">
            <div class="one-marker  d-flex align-items-center">
                <i class="fa fa-map-marker videos-marker"></i>
                <h6>TV Shows</h6>
            </div>
            <div class=" one-marker d-flex align-items-center">
                <i class="fa fa-map-marker business-marker"></i>
                <h6>Business</h6>
            </div>

            <div class=" one-marker d-flex align-items-center ">
                <i class="fa fa-map-marker home-marker"></i>
                <h6>Properties</h6>
            </div>

        </div>
    </div>
    <div class=" d-flex justify-content-between mt-4 mx-4">
        <input type="text" id="search-input" class="form-control col-2" placeholder="Pin to location ">
        <div class="">
            <button onclick="handleHomeLoanModal('home-loan-modal','Home Loan')" class="btn btn-success"> Home Loan</button>
            <button onclick="handleHomeLoanModal('home-loan-modal','Need Realtor')" class="btn btn-success"> Need
                Realtor</button>
            <button onclick="handleHomeOwnerInsuranceModal('homeowner-insurance-modal','Homeowners Insurance')"
                class="btn btn-success">
                Homeowners Insurance</button>
        </div>
    </div>
    {{-- top tv shows --}}
    <div class="d-flex justify-content-between align-items-center mx-4 mt-4">
        <h1 class="m-0 pb-2">Tv Shows</h1>
        <a href="">View All</a>
    </div>
    <div class="mx-4 row">
        @foreach ($Videos as $item)
            @php
                $encryptedUrl = Crypt::encryptString($item->id);
            @endphp
            <div class="card mx-2" style="width: 18rem;">

                <img src="{{ asset('Data/Thumbnail/' . $item->thumbnail) }}" class="card-img-top" alt="">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title font-weight-bold mb-0">{{ substr($item->video_title, 0, 20) }}</h5>
                    <p class="card-text mt-0"><span class="font-weight-bold mr-1">Gener:</span>{{ $item->genere }}</p>
                    <div class="mt-auto">
                        <a href="{{ url('live?watch=' . $encryptedUrl) }}" class="btn btn-primary">Watch</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- business list tables --}}
    <div class="d-flex justify-content-between align-items-center mx-4 mt-4">
        <h1 class="m-0 pb-2">Top Businesses</h1>
        <a href="{{ url('business/view-all') }}">View All</a>
    </div>
    <div class="mx-4 row">
        @foreach ($Business as $item)
            <div class="card mx-2" style="width: 18rem;">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title font-weight-bold">{{ $item->name }}</h5>
                    <p class="card-text">{{ substr($item->about, 0, 20) }}</p>
                    <div class="mt-auto">
                        <a target="_blank" href="{{ $item->website }}" class="btn btn-primary">Website</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- top Properties --}}
    <div class="d-flex justify-content-between align-items-center mx-4 mt-4">
        <h1 class="m-0 pb-2">Properties</h1>
        <a href="{{ url('properties/view-all') }}">View All</a>
    </div>
    <div class="mx-4 row mb-4">
        @foreach ($properties as $item)
            <div class="card mx-2" style="width: 18rem;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title font-weight-bold">{{ $item->name }}</h5>
                    <p class="card-text m-0"><span class="font-weight-bold mr-1">City:</span>{{ $item->cityName }}</p>
                    <p class="card-text m-0"><span class="font-weight-bold mr-1">Price:</span>{{ $item->price }}</p>
                    <div class="mt-auto">
                        {{-- <a target="_blank" href="{{ $item->website }}" class="btn btn-primary">Website</a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="modal" id="home-loan-modal" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="loan-pop-up-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="{{ route('emailData') }}" id="home-form">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="tel" placeholder="(Optional) Phone Number" name="phone" class="form-control"
                                id="phone">
                        </div>
                        <div class="form-group">
                            <label for="">Message</label>
                            <textarea type="message" name="message" class="form-control" placeholder="Write somthing...." id="message"
                                required></textarea>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="submit-button">Submit</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="homeowner-insurance-modal" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="home-loan-pop-up-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="{{ route('homeOwner') }}" id="home-form">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="tel" placeholder="(Optional) Phone Number" name="phone"
                                class="form-control" id="phone">
                        </div>
                        <div class="form-group">
                            <label for="">Message</label>
                            <textarea type="message" name="message" class="form-control" placeholder="Write somthing...." id="message"
                                required></textarea>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="submit-button">Submit</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function getCityDetailsFromPincode(pincode,latitude,longitude) {
            return new Promise(function(resolve, reject) {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    'address': pincode
                }, function(results, status) {
                    if(results != null){
                        if (status === google.maps.GeocoderStatus.OK) {
                            console.log(results[0]);
                            for (var i = 0; i < results[0].address_components.length; i++) {
                                var addressType = results[0].address_components[i].types[0];
                                if (addressType === "locality") {
                                    var lat = results[0].geometry.location.lat();
                                    var lng = results[0].geometry.location.lng();
                                    var cityDetails = {
                                        lat: lat,
                                        lng: lng
                                    };
                                    resolve(cityDetails);
                                }
                            }
                            reject("City not found");
                        } else {
                            reject("Geocoder failed due to: " + status);
                        } 
                    }else{
                        console.log(pincode);
                            var lat = latitude;
                            var lng = longitude;
                            var cityDetails = {
                                            lat: lat,
                                            lng: lng
                                        };
                            console.log(cityDetails);
                            resolve(cityDetails);
                    }
                    
                });
            });
        }
        // to zoom automaticaly on coordinates
        var zoom = {!! json_encode($Video) !!};
        let currentUrl = 'http://3.7.41.47/nac/public/';
        let localUrl = 'http://127.0.0.1:8000/';
        let Business = {!! json_encode($Business) !!};
        let Videos = {!! json_encode($Videos) !!};
        let properties = {!! json_encode($properties) !!};
        let currentInfoWindow = null;

        // initialise map
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 34.    ,
                lng: -118.4741052
            },
            zoom: 10,
            styles: [{
                    featureType: 'poi.business',
                    stylers: [{
                        visibility: 'off'
                    }]
                },
                {
                    featureType: 'poi.attraction',
                    stylers: [{
                        visibility: 'off'
                    }]
                },
                {
                    featureType: 'transit',
                    stylers: [{
                        visibility: 'off'
                    }]
                },
                {
                    featureType: 'poi.school',
                    stylers: [{
                        visibility: 'off'
                    }]
                },
                {
                    featureType: 'poi.park',
                    stylers: [{
                        visibility: 'off'
                    }]
                },
            ]
        });

        // realstate properties
        properties?.forEach(oneProp => {
            let property = {
                lat: parseFloat(oneProp.lat),
                lng: parseFloat(oneProp.long)
            };
            let marker = new google.maps.Marker({
                position: property,
                map: map,
                icon: {
                    url: `${currentUrl}/images/map/marker-blue.png`,
                    anchor: new google.maps.Point(10, 34)
                }
            });
            marker.addListener('click', function() {
                if (currentInfoWindow) {
                    currentInfoWindow.close();
                }
                // create and open info window
                var infoWindow = new google.maps.InfoWindow({
                    content: '<h6 style="margin:0px">' + JSON.parse(oneProp.jsonData).address
                        .streetAddress +
                        '</h6>'
                });
                infoWindow.open(map, marker);
                currentInfoWindow = infoWindow;

            });
            marker.setMap(map);
        });
        // mark business
        Business?.forEach(business_item => {
            let business_location = {
                lat: parseFloat(business_item.lat),
                lng: parseFloat(business_item.long)
            };

            let marker = new google.maps.Marker({
                position: business_location,
                map: map,
                icon: {
                    url: `${currentUrl}/images/map/marker-purple.png`,
                    anchor: new google.maps.Point(10, 34)
                }
            });
            marker.addListener('click', function() {
                // Close the currently open info window, if any
                if (currentInfoWindow) {
                    currentInfoWindow.close();
                }
                // create and open info window
                var infoWindow = new google.maps.InfoWindow({
                    content: '<h6 style="margin:0px">' + business_item.name +
                        '</h6><p style="font-size:10px;margin-bottom:0">' + business_item.address +
                        '</p>'
                });
                infoWindow.open(map, marker);
                // Update the currentInfoWindow variable
                currentInfoWindow = infoWindow;
            });
            marker.setMap(map);
        });
        // mark videos
        Videos?.forEach(element => {
            getCityDetailsFromPincode(element?.zipcode,element?.lat,element?.long).then(function(coordinates) {
                if (coordinates) {
                    let marker = new google.maps.Marker({
                        position: coordinates,
                        map: map,
                        icon: {
                            url: `${currentUrl}/images/map/marker-green.png`,
                            anchor: new google.maps.Point(10, 34)
                        }
                    });
                    marker.addListener('click', function() {
                        if (currentInfoWindow) {
                            currentInfoWindow.close();
                        }
                        // create and open info window
                        var infoWindow = new google.maps.InfoWindow({
                            content: '<h6 style="margin:0px">' + element.video_title +
                                '</h6><p style="font-size:10px;margin-bottom:0">' +
                                element.creator_name +
                                '</p><a href="' + currentUrl + 'redicrectToWatch?id=' +
                                element.id +
                                '" style="font-size:10px;margin-bottom:0">Go to video</a>'
                        });
                        infoWindow.open(map, marker);
                        currentInfoWindow = infoWindow;

                    });
                    marker.setMap(map);
                }
            }).catch(function(error) {
                console.error(error);
            });
        });



        function zoomToLocation(lat, lng, zoomLevel) {
            var center = new google.maps.LatLng(lat, lng);
            map.panTo(center);
            map.setZoom(zoomLevel);
        }
        // search input 
        var searchInput = document.getElementById('search-input');
        var searchBox = new google.maps.places.SearchBox(searchInput);
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            var place = places[0];
            zoomToLocation(place.geometry.location.lat(), place.geometry.location.lng(), 10);
        });
        // if url has any querry for zoom to marker then it will zoom on that
        if (zoom) {
        //if (true) {
            let data = getCityDetailsFromPincode(zoom?.zipcode).then(function(coordinates) {
                if (coordinates) {

                    zoomToLocation(coordinates.lat, coordinates.lng, 13)

                }
            }).catch(function(error) {
                console.error(error);
            });
        }

        function handleHomeLoanModal(id, heading) {
            $('#loan-pop-up-title').text(heading)
            $(`#${id}`).modal('show');
        }

        function handleHomeOwnerInsuranceModal(id, heading) {
            $('#home-loan-pop-up-title').text(heading)
            $(`#${id}`).modal('show');
        }

        function checkRequiredFields() {
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var message = $('#message').val();

            // Regex pattern to allow only numeric characters
            var numericPattern = /^[0-9]+$/;

            // Test if the phone input matches the numeric pattern
            var isPhoneValid = numericPattern.test(phone);

            // Display an error message if the phone input is not numeric
            if (!isPhoneValid) {
                $('#phone-error').text('Please enter a valid phone number (numeric characters only)');
            } else {
                $('#phone-error').text(''); // Clear the error message
            }

            // Check if any of the required fields is empty or if phone is invalid
            if (name === '' || email === '' || phone === '' || message === '' || !isPhoneValid) {
              //  $('#submit-button').prop('disabled', true);
            } else {
               // $('#submit-button').prop('disabled', false);
            }
        }

        // Attach the input event listener to the phone field
        $('#phone').on('input', checkRequiredFields);

        // Initial check to see if the submit button should be enabled
        checkRequiredFields();

        // Submit form logic (you can replace this with your actual form submission code)
        $('#home-form').submit(function(e) {
            e.preventDefault();
            alert('Form submitted!');
            $('#home-loan-modal').hide();
        });
    </script>
@endsection

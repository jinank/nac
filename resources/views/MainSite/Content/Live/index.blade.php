@extends('MainSite.Content.index')
@section('content')
    <style>
        .embed-responsive {
            height: 500px;
            /* set the height to match the height of the iframe */
        }

        a {
            text-decoration: none !important;
        }

        .home-upper-section i {
            font-size: 23px !important;
            cursor: pointer;
        }

        .video-title {
            /* text-align: justify; */
            width: 100%;
            word-wrap: break-word;
            font-weight: bold;
            font-size: 22px
        }

        .description-section {
            /* border: 2px solid black; */
            border-radius: 10px;
            margin-top: 20px !important;
            padding: 10px 12px;
            background: #c0c0c0;
            color: rgb(49, 48, 48);
        }

        .description-section h5 {
            font-weight: bold !important
        }

        .description-section h6 {
            word-wrap: break-word;
        }

        .more-video {
            cursor: pointer;
        }

        .small-thumbnail {
            width: 160px !important;
            object-fit: cover;
            height: 90px;
            cursor: pointer
        }

        .more-title {
            color: black
        }

        .profile-image-outer {
            width: 50px;
            height: 50px;
            border-radius: 50%
        }

        .profile-image-outer img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%
        }
    </style>

    {{-- nac live  --}}
    <section id="" class="home-upper-section p-4">
        <div class="row">
            <div class="col-8">
                <div class="embed-responsive embed-responsive-16by9">
                    {{-- {{dd($id)}} --}}
                    <video {{ $id ? 'autoplay' : '' }} id="my-video" width="320" height="240" controls
                        controlsList="nodownload"
                        poster="{{ !empty($oneVideo->thumbnail) ? asset('Data/Thumbnail/' . $oneVideo->thumbnail) : '' }}">
                        <source src="{{ !empty($oneVideo->file_name) ? asset('Data/Video/' . $oneVideo->file_name) : '' }}"
                            type="video/mp4">
                    </video>

                </div>
                <div class="row">
                    <div class="col-9">
                        <h3 class="pt-2 m-0 video-title" style="">
                            {{ !empty($oneVideo->video_title) ? $oneVideo->video_title : '' }}</h3>
                    </div>
                </div>


                <div class="row mt-3 justify-content-between align-items-center">
                    <div class="col-6 d-flex flex-row pt-2">
                        <div class="profile-image-outer">
                            <img class="creator-profile"
                                src="{{ $user && $user->image ? asset('Data/User/Profile/' . $user->image) : asset('/images/user.png') }}"
                                alt="">
                        </div>
                        <div class="creator-name mx-3 mb-4" style="align-self: flex-end">
                            <h6 class="font-weight-bold m-0 p-0">
                                {{ !empty($user->first_name) ? $user->first_name . ' ' . $user->last_name : '' }}</h6>
                            <p style="font-size: 14px" class="m-0 p-0">
                                Creator
                            </p>

                        </div>

                    </div>

                    <div class="col-6 d-flex  justify-content-end">

                        <div class="d-flex align-items-center mx-2" data-toggle="tooltip" data-placement="bottom"
                            title="Like this video">
                            <p class="video-des m-0 d-flex flex-column text-center"
                                onclick="managelike({{ !empty($oneVideo->id) ? $oneVideo->id : '' }},0)">

                            @if(session()->has('user'))
                                @if (!empty($oneVideo) && $oneVideo['likes']->contains('user_id', session('user')->id))
                                    <i class="like-icon-0 fa fa-thumbs-up"></i>
                                @else
                                    <i class="like-icon-0 fa fa-thumbs-o-up"></i>
                                @endif
                            @endif

                                {{-- dont need to show count right  now --}}
                                {{-- <span class="like-count-0">
                                    {{ $oneVideo->likes->count() }}
                                </span> --}}


                            </p>
                        </div>
                        <div class="d-flex align-items-center mx-2 mr-3" data-toggle="tooltip" data-placement="bottom"
                            title="Vote for this video">
                            <p onclick="handleVoting({{ !empty($oneVideo) ? $oneVideo->id : '' }},0)"
                                class="video-des m-0 d-flex flex-column text-center">
                                @if(session()->has('user'))
                                    @if (!empty($oneVideo) && $oneVideo['votes']->contains('user_id', session('user')->id))
                                        <i class="vote-icon-0 fa fa-star"></i>
                                    @else
                                        <i class="vote-icon-0 fa fa-star-o"></i>
                                    @endif
                                @endif
                                {{-- <span class="votes-count-0">
                                    {{ $oneVideo->votes->count() }}
                                </span> --}}
                            </p>
                        </div>
                        <div>
                            <a data-toggle="tooltip" data-placement="bottom" title="locate on map"
                                class="btn btn-secondary btn-xs"
                                href="{{ !empty($oneVideo) ? url('/universe?locate=' . $oneVideo->id) : '' }}">Locate
                                on Map </a>
                           <!-- @if (!empty($oneVideo) && $oneVideo->ads_button_link) -->
                                <!-- <a data-toggle="tooltip" data-placement="bottom"
                                    title="{{ !empty($oneVideo) ? $oneVideo->ads_button_text : '' }}"
                                    class="btn btn-success btn-xs ads" target="__blank"
                                    href="{{ !empty($oneVideo) ? $oneVideo->ads_button_link : '' }}">{{ !empty($oneVideo) ? $oneVideo->ads_button_text : 'Buy T-Shirt' }}</a>  -->
                        <!-- @endif -->
                            <a data-toggle="tooltip" data-placement="bottom"
                                    title="{{ !empty($oneVideo) ? $oneVideo->ads_button_text : '' }}"
                                    class="btn btn-success btn-xs ads" target="__blank"
                                    href="{{ !empty($oneVideo) ? $oneVideo->ads_button_link : '' }}">{{ !empty($oneVideo) ? 'Buy T-Shirt' : 'Buy T-Shirt' }}</a>
                        </div>

                    </div>
                </div>

                <div class="row m-0 description-section d-flex flex-column">
                    <h5 class="m-0">Description</h5>
                    <h6>{{ !empty($oneVideo) ? $oneVideo->description : '' }}</h6>
                </div>

            </div>
            <div class="col-4">
                <h4 class="font-weight-bold">More Videos</h4>
                <div class="row">
                    @foreach ($moreVideos as $item)
                        @php
                            
                            $encryptedUrl = Crypt::encryptString($item->id);
                        @endphp
                        <div class="col-12 d-flex my-2 more-video">
                            <a class="d-flex" href="{{ url('live?watch=' . $encryptedUrl) }}">
                                <div class="thumbnail">
                                    <img class="small-thumbnail" src="{{ asset('Data/Thumbnail/' . $item->thumbnail) }}"
                                        alt="">
                                </div>
                                <div class="">

                                    <h5 class="px-2 more-title">{{ $item->video_title }}</h5>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>


        </div>

    </section>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        var video = {!! json_encode($oneVideo) !!};
        const videoPlayer = document.querySelector('#my-video');
        videoPlayer?.addEventListener('play', function() {
            $.ajax({
                url: BASE_URL + "/user/history/add?videoId=" + video?.id,
                success: function(data) {},
            });
        });
    </script>
@endsection

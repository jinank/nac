<style>
    .top-4-videos {
        background: rgb(190,246,190);
        padding: 4rem 0 2rem 0;
        z-index: -1;
    }

    .upper-section-wrapper {
        border-radius: 16px;
        background: gray;
    }

   .upper-section {
        position: relative;
        border-radius: 16px;
        height: 180px;
        width: 100%;
        cursor: pointer;
        transition: box-shadow 0.2s ease-in-out;
    }

    .upper-section:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important;
    }

   .upper-section img {
        border-radius: 16px;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;

    }

    .upper-section:before {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 40%;
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
        background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 1));
        z-index: 1;
        transition: height 0.5s ease-in-out;
    }

    .video-title {
        position: absolute;
        bottom: 0px;
        color: white;
        z-index: 2;
        padding: 10px;
    }

    .video-title h4 {
        margin: 0;
        padding: 0;
        font-size: 18px
    }

    .video-title h6 {
        color: #57B566 !important;
        font-size: 14px;
        padding: 0;
        margin: 0;
    }

    .hover-text {
        position: absolute;
        bottom: 10%;
        width: 100%;
        height: 10%;
        opacity: 0;
        z-index: 1 !important;

        color: black;
        padding: 10px;
        transition: bottom 0.5s ease-in-out;
    }

    .upper-section:hover .hover-text {
        bottom: -10%;
        opacity: 1;
    }

    .top-4-videos i {
        cursor: pointer;
        font-size: 24px !important
    }

    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(217, 217, 217, 0.1);
        backdrop-filter: blur(15px);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .play-button i {
        margin: 0;
        padding: 0;
        font-size: 16px !important;
        color: white;
        padding-left: 3px
    }

    .modal {
        z-index: 10;
    }
</style>
    <?php foreach($videos as $key=>$value){?>
@php
    $encryptedUrl = Crypt::encryptString($value->id);
@endphp
<br/>
        <div class="col-12 col-md-4 col-lg-3 mb-5 mt-1" style="margin-top: 10px;">
            <div class="upper-section-wrapper">
                <div class="upper-section shadow-sm">
                <a href="{{ url('live?watch=' . $encryptedUrl) }}">
                    <img src="{{ asset('Data/Thumbnail/' . $value->thumbnail) }}" alt="" onerror="showplaceholder(event, '{{ asset('images/placeholder.jpg') }}')">
                    <div class="play-button">
                        <i class="fa fa-play"></i>
                    </div>
                    <div class="video-title">
                        <h4>{{ Str::limit($value->video_title, 30, '...') }}</h4>
                        <h6>{{ $value['genere']->title }}</h6>
                    </div>
                </a>
                <div class="hover-text">
                    <h4>
                        {{-- <span class="like-count-{{ $key??0 }}">{{ $value['likes']->count() }}</span> --}}
                        @if ($value['likes']->contains('user_id', session('user')->id))
                            <i onclick="managelike({{ $value->id }},{{ $key??0 }})"
                                class="like-icon-{{ $key??0 }} fa fa-thumbs-up"></i>
                        @else
                            <i onclick="managelike({{ $value->id }},{{ $key??0 }})"
                                class="like-icon-{{ $key??0 }} fa fa-thumbs-o-up"></i>
                        @endif
                        {{-- <span class="votes-count-{{ $key??0 }}">{{ $value['votes']->count() }}</span> --}}
                        @if ($value['votes']->contains('user_id', session('user')->id))
                            <i onclick="handleVoting({{ $value->id }},{{ $key??0 }})"
                                class="vote-icon-{{ $key??0 }} fa fa-star"></i>
                        @else
                            <i onclick="handleVoting({{ $value->id }},{{ $key??0 }})"
                                class="vote-icon-{{ $key??0 }} fa fa-star-o"></i>
                        @endif

                    </h4>

                </div>
            </div>
            </div>
        </div>
        <br/>
    <?php  } ?>

<script>

function showplaceholder(event, image) {
    console.log(event);
    event.target.src = image;
}

</script>

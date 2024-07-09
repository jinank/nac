@extends('MainSite.Content.index')
@section('content')
    <style>
        .card {
            cursor: pointer;
        }

        .card a {
            text-decoration: none
        }

        .break-word {
            overflow-wrap: anywhere;
            ;
        }
    </style>
    {{-- @php
        use Illuminate\Support\Facades\Crypt;
        if (session()->has('user')) {
            $currentUser = session('user');
        }
        
    @endphp --}}
    @if (session()->has('success'))
        <div class="alert alert-success mt-1" role="alert">
            {{ session('success') }}
        </div>
    @endif
    {{-- profile header --}}
    <div class="profile">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6 profileinsta">

                    <div class="profile-image">
                        <img style="width:150px;height: 150px;object-fit: cover;margin: 0"
                            src="{{ $currentUser->image ? asset('/Data/User/Profile/' . $currentUser->image) : asset('/images/user.png') }}">
                    </div>
                    <div class="profile-user-settings text-center">
                        <h1 class="profile-user-name text-capitalize">{{ $currentUser->user_name }}</h1>
                        <a onclick="openEditProfile()"><button class="btn profile-edit-btn">Edit
                                Profile</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- profile form toggle  --}}
    <section class="toogle-profile" style="display: none;">
        <div class="container">
            <form action="{{ url('user/update/') }}" name='foo' method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label>First name<span class="required">*</span></label>
                            <input type="text" id="input-field" name="first_name" value="{{ $currentUser->first_name }}"
                                class="form-control register-input" onkeyup="validate();" placeholder="First name">
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Last name<span class="required">*</span></label>
                            <input type="text" onkeyup="validate();" name="last_name"
                                value="{{ $currentUser->last_name }}" id="last-field" class="form-control register-input"
                                placeholder="Last name">
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Username<span class="required">*</span></label>
                            <input type="text" name="user_name" minlength="4" value="{{ $currentUser->user_name }}"
                                class="form-control register-input" placeholder="User name">
                            @if ($errors->has('user_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Phone<span class="required">*</span></label>
                            <input type="text" id="phone-field" maxlength="15" name="phone"
                                value="{{ $currentUser->phone }}" class="form-control register-input" onkeyup="validate();"
                                placeholder="Phone number">
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Email<span class="required">*</span></label>
                            <input type="email" name="email" onblur="validateEmail(this);"
                                value="{{ $currentUser->email }}" class="form-control register-input"
                                placeholder="Email address">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong id="error_email">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Zip Code<span class="required">*</span></label>
                            <input type="text" onkeyup="validate();" id="zip-field" name="zipcode" inputmode="numeric"
                                value="{{ $currentUser->zip_code }}" class="form-control register-input"
                                placeholder="Zip Code">
                            @if ($errors->has('zipcode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('zipcode') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Password<span class="required">*</span></label>
                            <input type="password" name="password" class="form-control register-input"
                                placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Confirm password<span class="required">*</span></label>
                            <input type="password" name="confirm_password" class="form-control register-input"
                                placeholder="Confirm password">
                            @if ($errors->has('confirm_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group profile-pic">
                            <label>Profile picture</label>
                            <!-- <input type="file"  name="picture"  class="form-control  register-input"   > -->
                            <input type="file" name="image" class="file">
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-3 personalprofile">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                            class="form-control btn  btn-login align" value="Update">
                    </div>
                    <div class="col-sm-3 col-sm-offset-5">
                        <a href="{{ url('home') }}" tabindex=""
                            class="form-control btn btn-register align">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    {{-- liked videos --}}
    <section class="px-4 container">
        <div class="d-flex justify-content-between">
            <h4>Your top liked videos</h4>
            <a href="{{ url('/user/video/liked') }}">View All</a>

        </div>
        <div class="row">

            @foreach ($topLikedVideos as $item)
                @php
                    $encryptedUrl = Crypt::encryptString($item->video_id);
                @endphp
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 card rounded m-2 p-0">
                    <a href="{{ url('live?watch=' . $encryptedUrl) }}">
                        <div class="media card-body p-2">
                            <img style="width: 70px;height: 70px;object-fit: cover"
                                src="{{ asset('Data/Thumbnail/' . $item->thumbnail) }}" alt="" class="mr-2">
                            <div class="media-body  pb-0 mb-0">
                                <h6 class="mt-0 m-0 p-0 break-word" style="font-size: 14px;color: black">
                                    {{ Str::limit($item->video_title, 40, '...') }}</h6>
                                <p class="text-muted m-0 p-0" style="font-size: 12px;color: grey">By
                                    {{ $item->creator_name }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <hr>
    </section>
    {{-- voted videos --}}
    <section class="px-4 mt-4 container">
        <div class="d-flex justify-content-between">
            <h4>Voted videos</h4>
            {{-- <a href="{{url('ballot')}}">View All</a> --}}

        </div>
        <div class="row">

            @foreach ($votedVidoes as $item)
                @php
                    $encryptedUrl = Crypt::encryptString($item->video_id);
                @endphp
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 card rounded m-2 p-0">
                    <div class="media card-body p-2">
                        <a href="{{ url('live?watch=' . $encryptedUrl) }}">
                            <img style="width: 70px;height: 70px;object-fit: cover"
                                src="{{ asset('Data/Thumbnail/' . $item->thumbnail) }}" alt="" class="mr-2">
                        </a>
                        <div class="media-body  pb-0 mb-0">
                            <h6 class="mt-0 m-0 p-0 break-word" style="font-size: 14px;color: black">
                                {{ Str::limit($item->video_title, 40, '...') }}</h6>
                            <p class="text-muted m-0 p-0" style="font-size: 12px;color: grey">By
                                {{ $item->creator_name }}</p>
                            <div class="d-flex">
                                <p onclick="removeVote({{ $item->id }})" title="Remove Vote" class=" m-0 p-0 pt-2"
                                    style="font-size: 18px;color: red"> <i class="fa fa-trash"></i></p>
                                <p onclick="revote({{ $item->id }})" title="Revote" class="mx-2 m-0 p-0 pt-2"
                                    style="font-size: 18px;color: red"> <i class="fa fa-repeat"></i></p>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
    </section>
    <section class="px-4 mt-4 container">
        <div class="d-flex justify-content-between">
            <h4>Manage your videos</h4>
            {{-- <a href="#">View All</a> --}}

        </div>
        {{-- your videos --}}
        <div class="row">

            @foreach ($yourVideos as $item)
                @php
                    $encryptedUrl = Crypt::encryptString($item->video_id);
                @endphp
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 card rounded m-2 p-0">
                    <a href="{{ url('live?watch=' . $encryptedUrl) }}">
                        <div class="media card-body p-2">
                            <img style="width: 70px;height: 70px;object-fit: cover"
                                src="{{ asset('Data/Thumbnail/' . $item->thumbnail) }}" alt="" class="mr-2">
                            <div class="media-body  pb-0 mb-0">
                                <h6 class="mt-0 m-0 p-0 break-word" style="font-size: 14px;color: black">
                                    {{ Str::limit($item->video_title, 40, '...') }}</h6>
                                <p class="text-muted m-0 p-0" style="font-size: 12px;color: grey">By
                                    {{ $item->creator_name }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    {{--  modals  --}}
    <div class="modal" id="remove-vote-modal" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Remove Vote</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{url('remove/vote')}}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" name="videoId" class="videoId">
                        Are you sure you want to remove your vote for this video?
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Yes</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="re-vote-modal" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Re-Vote </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{url('/setForrevote')}}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" name="videoId" class="videoId">
                        Are you sure you want to revote this this video?
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Yes</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // to show form if validatin fails 
        $(document).ready(function() {
            if ($(".help-block").length > 0) {
                $(".toogle-profile").show();
            }
        });
    </script>
@endsection

@extends('MainSite.Content.index')
@section('content')
    @if ($selected_for_votes)
        <section class="top-4-videos">
            <div class="container">
                <h3 class="ml-0">
                    Your videos for voting
                </h3>
                <div class="row">
                    @include('MainSite.Common.videoCard', ['item' => $selected_for_votes])
                </div>
            </div>
        </section>
    @endif

    @if ($selected_for_votes)
        <div style="background: #fff;padding:20px 0px">
            <div class="container" style="margin-bottom: 20px">

                <h3 class="ml-0 mt-3">Polling Questions</h3>
                <div class="box-allvideo">
                    <form method="POST"
                        action="{{ isset($previousResonses) && count($previousResonses) > 0 ? url('/ballot/questions/resubmit') : url('/ballot/questions') }}">
                        @csrf
                        @php
                            $encryptedId = Crypt::encryptString($selected_for_votes->id);
                        @endphp
                        <input type="hidden" name="video" value="{{ $encryptedId }}">
                        @foreach ($polling_questions as $key => $item)
                            <p style="padding-top: 15px">{{ $key + 1 }}) {{ $item->title }}</p>
                            <div style="display: flex;margin-left:20px">
                                <label style="padding-right:15px">
                                    <input type="radio" name="{{ $item->id }}" value="Strongy Agree"
                                        @if (isset($previousResonses)) @foreach ($previousResonses as $response)
               @if ($response->question_id == $item->id && $response->response_type == 'Strongy Agree')
               checked @endif
                                        @endforeach
                        @endif
                        >
                        Strongly Agree
                        </label>
                        <label style="padding-right:15px">
                            <input type="radio" name="{{ $item->id }}" value="Agree"
                                @if (isset($previousResonses)) @foreach ($previousResonses as $response)
               @if ($response->question_id == $item->id && $response->response_type == 'Agree')
               checked @endif
                                @endforeach
    @endif>
    Agree
    </label>
    <label style="padding-right:15px">
        <input type="radio" name="{{ $item->id }}" value="Neutral"
            @if (isset($previousResonses)) @foreach ($previousResonses as $response)
               @if ($response->question_id == $item->id && $response->response_type == 'Neutral')
               checked @endif
            @endforeach
        @endif
        >
        Neutral
    </label>
    <label style="padding-right:15px">
        <input type="radio" name="{{ $item->id }}" value="Disagree"
            @if (isset($previousResonses)) @foreach ($previousResonses as $response)
               @if ($response->question_id == $item->id && $response->response_type == 'Disagree')
               checked @endif
            @endforeach
        @endif
        >
        Disagree
    </label>
    <label style="padding-right:15px">
        <input type="radio" name="{{ $item->id }}" value="Strongly Disagree"
            @if (isset($previousResonses)) @foreach ($previousResonses as $response)
               @if ($response->question_id == $item->id && $response->response_type == 'Strongly Disagree')
               checked @endif
            @endforeach
        @endif
        >
        Strongly Disagree
    </label>
    </div>
    @endforeach
    <button type="submit" class="btn btn-success mt-4" style="min-width: 125px; font-size: 1rem;">
        {{ isset($previousResonses) && count($previousResonses) == 0 ? 'Re-Submit Vote' : 'Submit Vote' }}
    </button>
    </form>
    </div>
    </div>
    </div>
    @endif
    {{-- voted videos --}}
    <section class="top-4-videos">
        <div class="container">
            <h3 class="ml-0 mb-5">
                Your voted videos
            </h3>
            <div class="row">
                @forelse ($votedVidoes as $item)
                    @include('MainSite.Common.videoCard', ['item' => $item])
                @empty
                    <p class="col">No videos found</p>
                @endforelse
            </div>
    </section>
    {{-- liked videos --}}
    <section class="container">
        <h3 class="ml-0 my-5">
            Your liked videos
        </h3>
        <div class="row mb-4">
            @forelse  ($topLikedVideos as $item)
                @include('MainSite.Common.videoCard', ['item' => $item])
            @empty
                <p class="text-center">No videos found.</p>
            @endforelse
        </div>
    </section>
    {{-- history section --}}
    <section class="container mt-4 mb-4 pb-4">
        <h3 class="ml-0 my-5">
            Your History
        </h3>
        <div class="row">
            @forelse ($history as $item)
                @include('MainSite.Common.videoCard', ['item' => $item])
            @empty
                <p class="text-center">No videos found.</p>
            @endforelse
        </div>
    </section>
@endsection

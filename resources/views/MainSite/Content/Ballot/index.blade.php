@extends('MainSite.Content.index')
@section('content')
    @if ($selected_for_votes)
        <section class="top-4-videos">
            <div class="container">
                <h3>
                    Your video for vote
                </h3>
                <div class="container">
                    <div class="row">
                        @include('MainSite.Common.videoCard', ['item' => $selected_for_votes])
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if ($selected_for_votes)
        <div style="background: #fff;padding:20px 0px">
            <div class="container" style="margin-bottom: 20px">
                <h2 style="font-weight: bolder">Polling Questions</h2>
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
    <button type="submit"
        style="border: 1px solid black;padding:5px 10px;margin-top:10px;border-radius:5px">{{ isset($previousResonses) && count($previousResonses) > 0 ? 'Resubmit' : 'Submit' }}</button>
    </form>
    </div>
    </div>
    </div>
    @endif
    {{-- voted videos --}}
    <section class="top-4-videos">
        <div class="container">
            <h3>
                Your voted videos
            </h3>
            <div class="row  mt-4 pt-4 mb-4">
                @forelse ($votedVidoes as $item)
                    @include('MainSite.Common.videoCard', ['item' => $item])
                @empty
                    <p class="text-center">No videos found.</p>
                @endforelse
            </div>
    </section>
    {{-- liked videos --}}
    <section class="container mt-4 mb-4 pb-4">
        <h3>
            Your liked videos
        </h3>
        <div class="row mt-4 pt-4 mb-4">
            @forelse  ($topLikedVideos as $item)
                @include('MainSite.Common.videoCard', ['item' => $item])
            @empty
                <p class="text-center">No videos found.</p>
            @endforelse
        </div>
    </section>
    {{-- history section --}}
    <section class="container mt-4 mb-4 pb-4">
        <h3 class="mt-4">
            Your History
        </h3>
        <div class="row mt-4 pt-4 mb-4">
            @forelse ($history as $item)
                @include('MainSite.Common.videoCard', ['item' => $item])
            @empty
                <p class="text-center">No videos found.</p>
            @endforelse
        </div>
    </section>
@endsection

@extends('MainSite.Content.index')
@section('content')

<section class="top-4-videos">
    <div class="container">
        <h3>
            Top 100 based upon global, ranked choice votes
        </h3>
        <div class="container">
            <div class="row">
                @foreach ($videos as $key => $item)
                    @include('MainSite.Common.videoCard', ['item' => $item])
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
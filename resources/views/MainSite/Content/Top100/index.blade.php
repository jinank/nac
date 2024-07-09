@extends('MainSite.Content.index')
@section('content')

<section class="top-4-videos">
    <div class="container">
        <h3 class="ml-0 mb-2">
            Top 100 Videos
        </h3>
        <p>Based on global ranked choice votes</p>
        <div class="row">
            @foreach ($videos as $key => $item)
                @include('MainSite.Common.videoCard', ['item' => $item])
            @endforeach
        </div>
    </div>
</section>
@endsection

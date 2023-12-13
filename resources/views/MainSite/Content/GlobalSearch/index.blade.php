@extends('MainSite.Content.index')
@section('content')

<section class="top-4-videos">
    <div class="container">
        <h3>
            Searched result...
        </h3>
        <div class="container">
            <div class="row">
                @foreach ($videos as $key => $item)
                    @include('MainSite.Common.videoCard', ['item' => $item])
                @endforeach
            </div>
        </div>
        @if($videos->count()==0)
        <h5 class="text-center">Sorry! there is no video related to search term.</h5>
        @endif
    </div>
</section>
@endsection
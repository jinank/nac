@extends('MainSite.Content.index')
@section('content')
    @if (isset($Business))
        <section class="mx-4 mt-4">
            <h1>All Business</h1>
            <div class=" row">
                @foreach ($Business as $item)
                    <div class="card mx-2 mt-2" style="width: 18rem;">
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
        </section>
    @endif
    @if (isset($properties))
        <section class="mx-4 mt-4">
            <h1>All Properties</h1>
            <div class=" row">
                @foreach ($properties as $item)
                    <div class="card mx-2 mt-2" style="width: 18rem;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title font-weight-bold">{{ $item->name }}</h5>
                            <p class="card-text m-0"><span class="font-weight-bold mr-1">City:</span>{{ $item->cityName }}
                            </p>
                            <p class="card-text m-0"><span class="font-weight-bold mr-1">Price:</span>{{ $item->price }}
                            </p>
                            <div class="mt-auto">
                                {{-- <a target="_blank" href="{{ $item->website }}" class="btn btn-primary">Website</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
    @endif
@endsection

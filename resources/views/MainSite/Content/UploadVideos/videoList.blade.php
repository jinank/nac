@extends('MainSite.Content.index')
@section('content')
<style>
     .select-option-main {
            height: 100vh;
            background: linear-gradient(to left, white 30%, #bcf8a2 100%) !important;

        }
        .option-button{margin: 0px 80px;text-align: center}

        .select-option-main .buttons {
            display: flex;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }
</style>
{{-- descide options section  --}}
<div class="d-flex justify-content-between align-items-center mx-4 mt-4">
        <h1 class="m-0 pb-2">Your Uploaded Videos</h1>
    </div>
    <div class="mx-4 row">
        @if(count($Videos) > 0)
            @foreach ($Videos as $item)
                <div class="card mx-2" style="width: 18rem;">

                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title font-weight-bold mb-0">{{ $item->tags }}</h4>
                        <video width="200" height="240" controls>
                           <source src="{{ asset('Data/Video/' . $item->file_name)}}" type="video/mp4">
                        </video>
                        <p class="card-text mt-0"><span class="font-weight-bold mr-1">Creator Name:</span>{{ $item->creator_name }}</p>
                        <img src="{{ asset('Data/qrcodes/' . $item->id . '.png') }}" alt="QR Code" width="100" height="100">
                    </div>
                </div>
            @endforeach
        @else
            <h3 style="text-align: center; margin-top: 170px;">You don't uploaded any videos yet.</h3>
        @endif
    </div>

@endsection
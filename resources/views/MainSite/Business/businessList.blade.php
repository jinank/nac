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
        <h1 class="m-0 pb-2">Your Registred Businesses</h1>
    </div>
    <div class="mx-4 row">
        @if(count($Business) > 0)
            @foreach ($Business as $item)
                <div class="card mx-2" style="width: 18rem;">

                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title font-weight-bold mb-0">{{ $item->name }}</h4>
                        <p class="card-text mt-0"><span class="font-weight-bold mr-1">Website:</span>{{ $item->website }}</p>
                        <p class="card-text mt-0"><span class="font-weight-bold mr-1">Contact No:</span>{{ $item->phone_number }}</p>
                        <p class="card-text mt-0"><span class="font-weight-bold mr-1">Address:</span>{{ $item->address }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <h3 style="text-align: center; margin-top: 170px;">You don't have any registred business yet.</h3>
        @endif
    </div>

@endsection
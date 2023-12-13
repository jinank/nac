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
    <section class="select-option-main">
        <div class="buttons">
            <div class="option-button">
                <a href="{{ url('/coming-soon') }}" data-toggle="tooltip" title="NAC Ballot">
                    <div class="index-image">
                        <img src="{{ asset('/images/header-icons/radio1.png') }}">
                    </div>
                </a>
                <h4 class="font-weight-bold mt-3">NAC Radio</h4>
            </div>
            <div class="option-button">
                <a href="{{ url('/live') }}" data-toggle="tooltip" title="NAC Ballot">
                    <div class="index-image">
                        <img src="{{ asset('/images/header-icons/TV.png') }}">
                    </div>
                </a>
                <h4 class="font-weight-bold mt-3">NAC TV</h4>
            </div>
        </div>
    </section>

                        
@endsection

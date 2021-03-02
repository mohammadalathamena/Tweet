@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 vl flex-column text-center ">
            @if(request()->session()->get('error'))
            <div class="alert alert-danger" role="alert">
                {{ request()->session()->get('error') }}
            </div>
        @endif
            @if ($errors->has('token'))
                @foreach ($errors->get('token') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif
            @if ($errors->has('secretToken'))
                @foreach ($errors->get('secretToken') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif
            @if ($errors->has('error'))
                @foreach ($errors->get('error') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif

            <a class="twitter-share-button" href="{{ route('twitter.login') }}">
                <img src="{{ asset('img/twitterIcon.png') }}" class="twitter-image" alt="">
            </a>
            <span>{{ __('twitter.Log_in_With_Twitter') }}</span>
        </div>
        <div class="col-md-6 access-div">
            <form method="post" action="{{ route('twitter.credentials.store') }}">
                @csrf()
                <div class="input-group mb-3 ">
                    <div class="input-group-prepend">
                        <span class="input-group-text"
                            id="inputGroup-sizing-default">{{ __('twitter.ACCESS_TOKEN') }}</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" name="token"
                        aria-describedby="inputGroup-sizing-default" value="{{ old('token') }}" required>
                </div>
                <div class="input-group mb-3 ">
                    <div class="input-group-prepend">
                        <span class="input-group-text"
                            id="inputGroup-sizing-default">{{ __('twitter.ACCESS_TOKEN_SECRET') }}</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" name="secretToken"
                        aria-describedby="inputGroup-sizing-default" value="{{ old('token_secret') }}" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success ">{{ __('twitter.Add_Access_Key') }} </button>
                </div>
            </form>
        </div>
    </div>

@endsection

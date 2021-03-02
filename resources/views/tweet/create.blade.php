@extends('layouts.app')
@section('content')
    @if(request()->session()->get('error'))
        <div class="alert alert-danger" role="alert">
            {{ request()->session()->get('error') }}
        </div>
    @endif

    @if ($errors->has('error'))
        @foreach ($errors->get('error') as $message)
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endforeach
    @endif
    @if ($errors->has('tweet'))
        @foreach ($errors->get('tweet') as $message)
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endforeach
    @endif
    @if ($errors->has('counter'))
        @foreach ($errors->get('counter') as $message)
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endforeach
    @endif
    @if ($errors->has('success'))
    @foreach ($errors->get('success') as $message)
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endforeach
@endif

    <h1>{{ $counter }}/10{{ __('twitter.10_You_Can_Post_10_Time_At_Day') }}</h1>
    <form method="POST" action="{{ route('twitter.send') }}">
        @csrf()

        <div class="form-floating">
            <textarea class="form-control" placeholder="{{ __('twitter.Write_Your_tweet_here') }}" maxlength="280"
                name="tweet" id="tweetTextarea" style="height: 100px">{{ old('tweet') }}</textarea>
            <span>
                <p id="letterCounter">280</p>
            </span>
            <input type="hidden" name="counter" value="{{ old('tweet', $counter)  }}">

            <label for="floatingTextarea2"></label>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-info ">{{ __('twitter.tweet') }}</button>
        </div>
    </form>
@endsection

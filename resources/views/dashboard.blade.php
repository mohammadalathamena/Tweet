<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
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


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div class="row">
    <div class="col-md-6 vl flex-column text-center ">
        <a class="twitter-share-button" href="{{ route('twitter.credentials.create') }}">
            <img src="{{ asset('img/clipart303956.png') }}" class="twitter-image" alt="">
        </a>
        <span>{{ __('twitter.Add_Credential') }}</span>
    </div>
    <div class="col-md-6 flex-column text-center write-tweet-div">
        <a class="twitter-share-button" href="{{ route('twitter.create') }}">
            <img src="{{ asset('img/writeTweet.png') }}" class="twitter-image" alt="">
        </a>
        <span>{{ __('twitter.Write_Tweet') }}</span>
    </div>
</div>

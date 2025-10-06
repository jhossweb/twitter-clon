<?php

use App\Livewire\ShowTweet;
use App\Livewire\Tweets\ShowTweet as TweetsShowTweet;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/tweets', function () {
        return view('tweets.index');
    })->name('tweets.inedx');


    Route::get('/tweets/{tweet}', TweetsShowTweet::class)->name('tweet.show');  
      
});





























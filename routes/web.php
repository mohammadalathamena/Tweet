<?php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('twitter')->middleware(['auth'])->name('twitter.')->group(function () {
    Route::get('login', [TweetController::class, 'logInWithTwitter'])->name('login');
    Route::get('tweet',[TweetController::class, 'OauthTokenConfig'] )->name('tweet');
    Route::get('create',   [TweetController::class, 'posterPage'])->name('create');
    Route::post('send',[TweetController::class, 'send'])->name('send');
    Route::prefix('credentials')->name('credentials.')->group(function () {
        Route::view('create','credentials/create')->name('create');
        Route::post('store',  [TweetController::class, 'storeToken'])->name('store');
    });
});
Route::view('/', 'dashboard')->middleware(['auth'])->name('dashboard');


Auth::routes();



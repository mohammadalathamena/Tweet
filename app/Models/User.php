<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'post_counter',
        'access_token',
        'access_token_secret',
        'last_tweet'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Empty Post Counter
     * 
     * @return void
     */
    public static function emptyConter()
    {
        auth()->user()->update([
            'post_counter'=> 0,
        ]);
    }

    /**
     * Save Last Tweet 
     * 
     * @return void
     */
    public static function saveLastTweetDate()
    {
        auth()->user()->update([
            'last_tweet'=> \Carbon\Carbon::now(),
        ]);
    }

    /**
     * Save Access Token 
     * 
     * @param App\Http\Requests\addToken;
     * @return void 
     * 
     */
    public static function saveAccessToken($request)
    {
        auth()->user()->update([
            'access_token' => $request->token,
            'access_token_secret' => $request->secretToken,
        ]);
    }
}

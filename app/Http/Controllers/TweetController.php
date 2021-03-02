<?php

namespace App\Http\Controllers;

use App\Http\Requests\addPost;
use App\Http\Requests\addToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Thujohn\Twitter\Facades\Twitter;
use Illuminate\Support\Facades\Redirect;
use Session;
use Request;
use Illuminate\Http\Request as Rqst;

class TweetController extends Controller
{


    /**
     * Redirect To Poster Viwe With Post Counter Data
     * 
     * @return view 
     */
    public function posterPage()
    {
        return view('tweet/create', ['counter' => (10 - auth()->user()->post_counter)]);
    }

    /**
     * Send Tweet to twitter And Increase Tweet Counter In Database 
     * 
     * @param app\Http\Controllers\addPost
     * @return Redirect
     */
    public function send(addPost $request)
    {

        $user = auth()->user();
        $date = Carbon::createFromDate($user->last_tweet);

        try {
            if (!$date->isToday()) {
                User::emptyConter();
                User::saveLastTweetDate();
            } else {
                User::saveLastTweetDate();
            }
            Twitter::postTweet(['status' => $request->tweet, 'format' => 'json']);
            Auth::user()->increment('post_counter');
            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Set Oauth Token In Config 
     * 
     * @return Redirect  
     */
    public function OauthTokenConfig()
    {
        if (Session::has('oauth_request_token')) {

            Twitter::reconfig([
                'token'  => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ]);
            $oauth_verifier = false;

            if (Request::has('oauth_verifier')) {
                $oauth_verifier = Request::get('oauth_verifier');
                $token = Twitter::getAccessToken($oauth_verifier);
            }

            if (!isset($token['oauth_token_secret'])) {
                return Redirect::route('/')->with('error', 'We could not log you in on Twitter.');
            }

            $credentials = Twitter::getCredentials();

            if (is_object($credentials) && !isset($credentials->error)) {
                Session::put('access_token', $token);
                return Redirect::to('/twitter/create')->with('success', 'Congrats! You\'ve successfully signed in!');
            }

            return Redirect::route('/')->with('error', 'Crab! Something went wrong while signing you up!');
        } else {
            return Redirect::route('/')->with('error', 'Crab! Something went wrong while signing you up!');
        }
    }

    /**
     * Get  Oauth Token From twitter
     * 
     * @return Redirect
     */
    public function logInWithTwitter()
    {
        $sign_in_twitter = true;
        $force_login = false;

        Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = Twitter::getRequestToken(route('twitter.tweet'));

        if (isset($token['oauth_token_secret'])) {
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);
            $this->setTokenInSession($token['oauth_token'], $token['oauth_token_secret']);

            return Redirect::to($url);
        }

        return Redirect::route('/');
    }

    /**
     * Set Token In Session 
     * 
     * @return TweetController
     */
    public function setTokenInSession($token, $secretToken)
    {
        Session::put('oauth_state', 'start');
        Session::put('oauth_request_token', $token);
        Session::put('oauth_request_token_secret', $secretToken);
        return $this;
    }

    /**
     * save Token In Database
     * 
     * @param Illuminate\Http\Request
     * @return TweetController
     */
    public function saveTokenKey($request)
    {
        User::saveAccessToken($request);
        return $this;
    }

    /**
     * Validate Token Snd Save It In Database
     * 
     * @param @param app\Http\Controllers\addPost
     * @return Redirect
     */
    public function storeToken(addToken $request)
    {
        $this->saveTokenKey($request)->setTokenInSession($request->token, $request->secretToken);
        return redirect()->route('twitter.create');
    }

}

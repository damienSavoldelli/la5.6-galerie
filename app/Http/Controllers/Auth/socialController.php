<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Socialite;
use App\Models\ {User, socialUser};

class socialController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * redirectToProvider : Redirect the user to the OAuth Provider.
     * @param  string $provider
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = User::firstOrCreate(
            ['email'=> $user->email],
            ['name' => $user->name, 'email'=> $user->email, 'settings' => '{"pagination": 8}']
        );

        $socialUser = socialUser::firstOrCreate(
            ['user_id' => $authUser->id, 'provider_user_id' => $user->getId()],
            ['provider' => $provider, 'verified' => $user->user['verified'], 'provider_user_token' => $user->token, 'avatar' => $user->getAvatar()]
        );

        if ($socialUser->provider_user_token != $user->token) {
            $socialUser->provider_user_token = $user->token;
            $socialUser->save();
        }

        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }
}

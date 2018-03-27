<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Socialite;
use App\Models\User;

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
        // dd($user);
        $authUser = User::firstOrCreate(
          ['email'=> $user->email],
          ['name' => $user->name, 'email'=> $user->email, 'settings' => '{"pagination": 8}']
        );
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }
}

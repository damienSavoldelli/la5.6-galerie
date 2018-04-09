<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\Rule;

use App\Models\ { User, socialUser };

use Auth;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;



/**
 * @resource Authentication
 *
 * Authentication for user connexion and register
 */
class loginController extends Controller
{
    protected $client;


    public function __construct()
    {
        $this->client = Client::where('password_client', 1)->first();
    }

    /**
     * Login POST
     * Authorization: Bearer authentify
     *
     * @response {
     *  data: [
     *    "test"=>""
     *  ]
     * }
     *
     * @param  LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $params = [
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->username,
            'password' => $request->password,
            'scope' => ''
        ];


        $request->request->add($params);

        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);
    }

    /**
     * [login description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function social(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255',
            'name' => 'required',
            'provider_user_id' => 'required|string|max:191|min:4',
            'access_token' => 'required',
            'provider' => [
                'required',
                Rule::in(['facebook','google']),
            ],
        ]);

        $authUser = User::firstOrCreate(
            ['email'=> $request->email],
            ['name' => $request->name, 'settings' => '{"pagination": 8}']
        );

        $avatar = (!empty($request->avatar)) ? $request->avatar : '';
        $verified = (!empty($request->verified)) ? $request->verified : 0;

        $socialUser = socialUser::firstOrCreate(
            ['user_id' => $authUser->id, 'provider_user_id' => $request->provider_user_id],
            ['provider' => $request->provider, 'provider_user_token' => $request->access_token, 'verified' => $verified, 'avatar' => $avatar]
        );

        if ($socialUser->provider_user_token != $request->access_token) {
            $socialUser->provider_user_token = $request->access_token;
            $socialUser->save();
        }

        $params = [
            'grant_type' => 'social',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'network' => 'facebook',
            'access_token' => $request->access_token
        ];


        $request->request->add($params);

        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);
    }


    /**
     * Refresh token POST
     * Authorization: Bearer acces_token
     *
     * @param  RefreshRequest $request
     * @return \Illuminate\Http\Response
     */
    public function refresh(Request $request)
    {
        $this->validate($request, [
          'refresh_token' => 'required'
        ]);

        $params = [
          'grant_type' => 'refresh_token',
          'client_id' => $this->client->id,
          'client_secret' => $this->client->secret,
          'username' => $request->username,
          'password' => $request->password
        ];

        $request->request->add($params);

      	$proxy = Request::create('oauth/token', 'POST');

      	return Route::dispatch($proxy);
    }

    /**
     * Logout POST
     * Authorization: Bearer acces_token
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $accessToken = Auth::user()->token();

        $refreshToken = DB::tabel('oauth_refresh_token')
          ->where('acces_token_id', $accessToken->id)
          ->update(['revoked' => true]);

        $accessToken->revoke();

        return response()->json([], 204);
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
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
    public function login(LoginRequest $request)
    {
      // $this->validate($request, [
      //   'username' => 'required',
      //   'password' => 'required',
      // ]);

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
     * Refresh token POST
     * Authorization: Bearer acces_token
     *
     * @param  LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function refresh(Request $request)
    {
        // $this->validate($request, [
        //   'refresh_token' => 'required'
        // ]);

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

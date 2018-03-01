<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;

class loginController extends Controller
{
    protected $client;


    public function __construct()
    {
      $this->client = Client::where('password_client', 1)->first();
    }

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

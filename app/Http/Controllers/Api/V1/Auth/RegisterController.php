<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;

/**
 * @resource Authentication
 *
 * Authentication for user connexion and register
 */
class RegisterController extends Controller
{

  protected $client;


  public function __construct() {
    $this->client = Client::where('password_client', 1)->first();
  }

  /**
   * Register POST
   * Authorization: Bearer authentify
   *
   * @param  RegisterRequest $request
   * @return \Illuminate\Http\Response
   */
  public function register(RegisterRequest $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6|confirmed'
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'settings' => '{"pagination": 8}'
    ]);


    $params = [
      'grant_type' => 'password',
      'client_id' => $this->client->id,
      'client_secret' => $this->client->secret,
      'username' => $request->email,
      'password' => $request->password,
      'scope' => ''
    ];

    $request->request->add($params);

  	$proxy = Request::create('oauth/token', 'POST');

  	return Route::dispatch($proxy);


  }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;


class RegisterController extends Controller
{

  protected $client;


  public function __construct() {
    $this->client = Client::where('password_client', 1)->first();
  }

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function register(Request $request)
  {
    $this->validate ($request, [
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

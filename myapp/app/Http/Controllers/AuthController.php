<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWTAuth;
use Exception;

class AuthController extends Controller
{
    public function login(LoginRequest $r){
      $credentails =  $r->only('email','password');
      $token = auth('api')->attempt($credentails);
      if (!$token){
         throw new \Exception("походу вы не зарегестрированы");
      }
      error_log($token);
    /** @var \Tymon\JWTAuth\JWTGuard $auth */
$auth = auth('api');

     return response()->api([
          'token'=>$token,
           'token_type'=>'bearer',
           'time'=>$auth->factory()->getTTL() * 60
       ], 200);
    }
}

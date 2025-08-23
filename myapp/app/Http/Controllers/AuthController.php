<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Interfaces\AuthenticationServiceInterface;

class AuthController extends Controller
{
    private $authenticationJWT;

    public function __construct(AuthenticationServiceInterface $authenticationJWT){
       $this->authenticationJWT = $authenticationJWT;
    }


    public function login(LoginRequest $r){
      $credentails =  $r->only('email','password');
      $token = $this->authenticationJWT->authentication($credentails);
      //для тестов
      error_log($token);
      /** @var \Tymon\JWTAuth\JWTGuard $auth */
      $auth = auth('api');
      //возращяем токен
     return response()->api([
          'token'=>$token,
           'token_type'=>'bearer',
           'time'=>$auth->factory()->getTTL() * 60
       ], 200);
    }
}

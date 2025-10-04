<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Interfaces\AuthenticationServiceInterface;
use App\Models\User;
use Log;

class AuthController extends Controller
{
    private $authenticationJWT;

    public function __construct(AuthenticationServiceInterface $authenticationJWT){
       $this->authenticationJWT = $authenticationJWT;
    }
   /**
 * Аутентификация пользователя
 * @param LoginRequest $r емэйл и пароль
 * @return Json с Jwt токеном
   */
    public function login(LoginRequest $r){
      $email = $r->email;
      //Берем пользователя(может быть null если не найден)
      $user = User::where('email', $email)->first();
      //Проверяем подтвержден ли емэйл
      $this->authenticationJWT->EnsureEmailIsVerified($user);
      //забираем нужные данные
      $credentials =  $r->only('email','password');
      //Получаем JWT Токее
      $token = $this->authenticationJWT->authentication($credentials);
      Log::info("User JWT token: " . $token);
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

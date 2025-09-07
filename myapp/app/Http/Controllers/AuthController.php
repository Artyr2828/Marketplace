<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Interfaces\AuthenticationServiceInterface;
use App\Models\User;
use Exception;
class AuthController extends Controller
{
    private $authenticationJWT;

    public function __construct(AuthenticationServiceInterface $authenticationJWT){
       $this->authenticationJWT = $authenticationJWT;
    }

    /**
 * Аутентификация пользователя
 * @param LoginRequest $r специальный Request для валидации полученных данных
 * @return JSON
 * **/
    public function login(LoginRequest $r){
      $email = $r->email;
      $user = User::where('email', $email)->first();
      //Проверяем подтвержден ли емэйл
      $this->authenticationJWT->EnsureEmailIsVerified($user);
      //забираем нужные данные
      $credentials =  $r->only('email','password');
      //Получаем JWT Токее
      $token = $this->authenticationJWT->authentication($credentials);
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

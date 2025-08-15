<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthController extends Controller
{
    public function login(LoginRequest $r){
      $credentails =  $r->only('email','password');
      $token = Auth::attempt($credentails);
      if (!$token){
         throw new \Exception("походу вы не зарегестрированы");
      }
      error_log($token);
    }
}

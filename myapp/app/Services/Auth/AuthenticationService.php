<?php
namespace App\Services\Auth;
use App\Interfaces\AuthenticationServiceInterface;
use Exception;
class AuthenticationService implements AuthenticationServiceInterface{
  public function authentication(array $creditails): string{
   $token = auth('api')->attempt($creditails);

   if (!$token){
       throw new \Exception("походу вы не зарегестрированы");
   }
   return $token;
  }
}

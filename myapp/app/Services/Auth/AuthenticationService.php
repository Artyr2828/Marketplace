<?php
namespace App\Services\Auth;
use App\Interfaces\AuthenticationServiceInterface;
use Exception;
use App\Models\User;


class AuthenticationService implements AuthenticationServiceInterface{

  /**
 * Выдача токена клиенту
 * @param array $creditails данные для генерации JWT токена
 * @return string $token
   **/

  public function authentication(array $creditails): string{
   $token = auth('api')->attempt($creditails);

   if (!$token){
       throw new \Exception("похоже вы не зарегестрированы");
   }
   return $token;
  }


  /**
 * Проверка подтвержден ли email
 * @param User $user зарегестрированный пользователь
 * @throws Exception исключения если у пользователя не подтвержден email
  **/
  public function EnsureEmailIsVerified(?User $user): void{
        if ($user === null){
            throw new \Exception("Данного пользователя не существует");
        }
        if ($user->email_verified_at === null){                                        throw new \Exception("вы не можете войти в этот аккаунт, пользова
  тель не подтвержден");
        }
  }
}

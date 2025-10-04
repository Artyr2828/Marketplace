<?php
namespace App\Services\Auth;
use App\Interfaces\AuthenticationServiceInterface;
use Exception;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthenticationService implements AuthenticationServiceInterface{

  /**
 * Выдача токена клиенту
 * @param array $creditails данные для генерации JWT токена
 * @return string $token
   **/

  public function authentication(array $creditails): string{
   $token = auth('api')->attempt($creditails);

   if (!$token){
       throw new HttpResponseException(response()->json(["status"=>"error", "error"=>"Invalid password or email", "message"=>"пароль не действительный"], 400, [], JSON_UNESCAPED_UNICODE));
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
            throw new HttpResponseException(response()->json(["status"=>"error","error"=>"User not found", "message"=>"Данного пользователя не существует"], 404, [], JSON_UNESCAPED_UNICODE));
        }

        if ($user->email_verified_at === null){
          throw new HttpResponseException(response()->json(["status"=>"error"  ,"error"=>"Email not verified", "message"=>"вы не можете войти в этот аккаунт, пользователь не подтвержден"], 403, [], JSON_UNESCAPED_UNICODE));
        }
  }
}

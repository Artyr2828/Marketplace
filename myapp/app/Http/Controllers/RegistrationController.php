<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\Email\EmailVerificationService;
use App\Http\Requests\CheckCodeEmailRequest;
use App\Http\Requests\RegenerateCodeRequest;
use App\Interfaces\UserRegistrationInterface;
use Illuminate\Support\Facades\Hash;
use App\Jobs\DeleteUserJob;
use App\Interfaces\VerificationCodeInterface;
use Psy\Util\Json;

class RegistrationController extends Controller
{
   private $emailVerificationService;
   private $userRegistrationService;
   private $verificationCodeStorage;
   public function __construct(EmailVerificationService $emailVerificationService, UserRegistrationInterface $userRegistrationService, VerificationCodeInterface $verificationCodeStorage){
     $this->emailVerificationService = $emailVerificationService;
     $this->userRegistrationService = $userRegistrationService;
     $this->verificationCodeStorage = $verificationCodeStorage;
   }
   /**
 * Данные для регистрации
 * @param RegisterRequest $r,
 * return Json
 */
   public function handlePost(RegisterRequest $r){
      $dataUser = ['name'=>$r->name, 'email'=>$r->email, 'password'=> Hash::make($r->password)];
     //Проверяем нет ли в БД этого пользователя
      $this->userRegistrationService->ensureUserDoesNotExist($dataUser['email']);
      //если нет то добавляем
      $user = $this->userRegistrationService->addUserInDb($dataUser);
      //ставим задачу на через пять минут удалить пользователя если емэйл не подтвержден
      DeleteUserJob::dispatch($user->id)->delay(now()->addMinute(5));
      //отправляем код подтверждения
      $this->emailVerificationService->sendVerificationCodeToEmail($r->email, 300);

     return response()->api(["status"=>"ok",'message'=>"Registration successful, code confirmation required"]);

   }

   /**
 * Проверка кода подтверждения
 * @param CheckCodeEmailRequest $r емэйл и код подтверждения от него
 * return Json
 */


   public function checkCode(CheckCodeEmailRequest $r){
      $this->emailVerificationService->validateEmailVerificationCode($r->email, $r->code);
          $user = $this->userRegistrationService->getUser($r->email);
          $this->userRegistrationService->changeDataInDB($user, 'email_verified_at', now());
         $this->verificationCodeStorage->delKey("verify-code-$r->email");
         $this->verificationCodeStorage->delKey("cooldown-$r->email");

     return response()->api(["message"=>"код подтвержден, регистрация успешна"]);
   }

   /**
 * Регенерация кода подтверждения
 * @param RegenerateCodeRequest $r емэйл на который отправляем новый код
 * @return Json
 */

  public function regenerateCode(RegenerateCodeRequest $r){
      $this->emailVerificationService->regenerateCode($r->email);

      return response()->api(['message'=>"Новый код вышлен"]);
  }
}

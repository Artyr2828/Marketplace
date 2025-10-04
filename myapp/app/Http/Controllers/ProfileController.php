<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Email\EmailVerificationService;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\CheckCodeEmailRequest;
use App\Services\ProfileService\ProfileService;
use App\Services\ProfileService\EnsureDataNotNull;
use App\Http\Requests\DataChangeRequest;
use PHPUnit\Util\Json as UtilJson;
use Psy\Util\Json;

class ProfileController extends Controller
{
    private $emailVerificationService;
    private $profileService;
    private $ensureDataNotNull;

    public function __construct(EmailVerificationService $emailVerificationService, ProfileService $profileService, EnsureDataNotNull $ensureDataNotNull){
     $this->emailVerificationService = $emailVerificationService;
     $this->profileService = $profileService;
     $this->ensureDataNotNull = $ensureDataNotNull;
}

  /**
 * Отдать данные пользователя
 * @return Json
 */

    public function getDataUser(){
       $user = auth()->user();
       return response()->api($user->load('image'));
    }


/**
 * Изменить данные пользователя(имя и аватарку)
 **/
    public function changeDataUser(DataChangeRequest $r){
         $user = auth()->user();
       error_log("Doxodittt");
         $name = $r->input('name');
         $image = $r->file('image');
         //Проверка на отсутствие всех данных
         $this->ensureDataNotNull->check($name, $image);
         //Обновляем
         error_log("Doxodittt do suda");
         $this->profileService->changeDataUser($name, $image, $user);

         return response()->json(["status"=>"ok", 'message'=>"Data has been successfully added"], 200, [], JSON_UNESCAPED_UNICODE);
}

/**
 * Изменить пароль пользователя
 * @param PasswordRequest $r текущий пароль и новый пароль
 * @return Json
   */

    public function changePasswordUser(PasswordRequest $r){
       $user = auth()->user();
       $oldPassword = $r->old_password;
       $newPassword = $r->new_password;
       //Проверка переданных данных
       if ($newPassword === null || $oldPassword === null){
          return response()->json(["status"=>"error","error"=>"Invalid Data","message"=>"Вы не передали нужных данных"], 400, [], JSON_UNESCAPED_UNICODE);
       }
       //обновляем новый пароль если указанный старый пароль существует в БД
       $this->profileService->changePasswordUser($oldPassword, $newPassword, $user);

       return response()->json(["status"=>"ok", "message"=>"Пароль успешно обновлен"], 200, [], JSON_UNESCAPED_UNICODE);
    }


/**
 * Отправить код подтверждения на новый емэйл
 * @param EmailRequest $r новый емэйл
 * @return Json
 */
   public function sendEmailVerificationCode(EmailRequest $r){
       $user = auth()->user();
       $email = $r->email;
       if ($email === $user->email){
          return response()->json(["status"=>"error","error"=>"Invalid Data","message"=>"Указан текущий емэйл, требуется новый"], 400, [], JSON_UNESCAPED_UNICODE);
       }
       $this->emailVerificationService->sendVerificationCodeToEmail($email, 300);
       return response()->json(["status"=>"ok", "message"=>"Код подтверждения успешно отправлен на указанный email"], 200, [], JSON_UNESCAPED_UNICODE);
   }

/**
 * Изменяем Email
 * @param CheckCodeEmailRequest $r код подтверждения для верификации емэйл и сам емэйл
 * @return Json
 */
   public function changeEmailUser(CheckCodeEmailRequest $r){
      $user = auth()->user();

      $email = $r->email;
      $clientCode = $r->code;

      $this->emailVerificationService->validateEmailVerificationCode($email, $clientCode);
      //Если код от клиента совпадает с присылаемом кодом на емэйл то изменяем емэйл
      $user->update(['email'=>$email]);

      return response()->json(["status"=>"ok", "message"=>"Email Успешно обновлен"], 200, [], JSON_UNESCAPED_UNICODE);
   }
}

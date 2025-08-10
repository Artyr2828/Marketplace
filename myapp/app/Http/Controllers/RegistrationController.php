<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\Email\EmailVerificationService;
use App\Http\Requests\CheckCodeEmailRequest;
use App\Services\Verification\PendingUserStorage;
use App\Services\User\UserRegistrationService;
use Illuminate\Support\Facades\Hash;
//use App\Services\Verification\VerificationCodeStorage;
class RegistrationController extends Controller
{
   private $emailVerificationService;
   private $pendingUserStorage;
   private $userRegistrationService;
   public function __construct(EmailVerificationService $emailVerificationService, PendingUserStorage $pendingUserStorage, UserRegistrationService $userRegistrationService){
     $this->emailVerificationService = $emailVerificationService;
     $this->pendingUserStorage = $pendingUserStorage;
     $this->userRegistrationService = $userRegistrationService;
   }

   public function handlePost(RegisterRequest $r){
      $dataUser = ['name'=>$r->name, 'email'=>$r->email, 'password'=> Hash::make($r->password)];
      $this->userRegistrationService->ensureUserDoesNotExist($dataUser['email']);
      //добав. в Redis
      $this->pendingUserStorage->sendUser($r->email, $dataUser);
      $this->emailVerificationService->sendVerificationCodeToEmail($r->email);
     return response()->api(['message'=>"Регистрация Успешна, требуется подтвердить код"]);

   }

   //Пост проверки кода
   public function checkCode(CheckCodeEmailRequest $r){
      $this->emailVerificationService->validateEmailVerificationCode($r->email, $r->code);
      $dataUser = $this->pendingUserStorage->getUser($r->email);
      $this->userRegistrationService->addUserInDb($dataUser);

     //return response()->json(['status'=>"ok"]);
     return response()->api(["message"=>"код подтвержден, регистрация успешна"]);
   }
}

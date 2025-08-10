<?php
namespace App\Services\Email;

use App\Services\Email\GenerateEmailCode;
use App\Services\Email\EmailSender;
use App\Services\Verification\VerificationCodeStorage;
use App\Models\User;
use App\Services\Email\ValidationClientCode;
use App\Services\Verification\PendingUserStorage;
class EmailVerificationService{
    private $EmailSender;
    private $GenerateEmailCode;
    private $verificationCodeEmail;
    private $validationClientCode;
    function __construct(GenerateEmailCode $GenerateEmailCode, EmailSender $EmailSender, VerificationCodeStorage $verificationCodeEmail, ValidationClientCode $validationClientCode, PendingUserStorage $pendingUserStorage){
       $this->GenerateEmailCode = $GenerateEmailCode;
       $this->EmailSender = $EmailSender;
       $this->verificationCodeEmail = $verificationCodeEmail;
       $this->validationClientCode = $validationClientCode;
    }

    public function sendVerificationCodeToEmail(string $email){

       $code = $this->GenerateEmailCode->generate();
       $this->EmailSender->send($email, $code);
       $this->verificationCodeEmail->setCode($email, 140, $code);

     }


    public function validateEmailVerificationCode(string $email, string $clientCode){
       $validCode = $this->verificationCodeEmail->getCode($email);
       $this->validationClientCode->validation($clientCode, $validCode);

    }
}

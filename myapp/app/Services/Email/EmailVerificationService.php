<?php
namespace App\Services\Email;

use App\Services\Email\GenerateEmailCode;
use App\Services\Email\EmailSender;
use App\Interfaces\VerificationCodeInterface;
use App\Interfaces\ValidationCodeInterface;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmailVerificationService{
    private $EmailSender;
    private $GenerateEmailCode;
    private $verificationCodeEmail;
    private $validationClientCode;
    function __construct(GenerateEmailCode $GenerateEmailCode, EmailSender $EmailSender, VerificationCodeInterface $verificationCodeEmail, ValidationCodeInterface $validationClientCode){
       $this->GenerateEmailCode = $GenerateEmailCode;
       $this->EmailSender = $EmailSender;
       $this->verificationCodeEmail = $verificationCodeEmail;
       $this->validationClientCode = $validationClientCode;
    }

    public function sendVerificationCodeToEmail(string $email,?int $ttlSec){
       $code = $this->GenerateEmailCode->generate();
       $this->EmailSender->send($email, $code);
       $this->verificationCodeEmail->setCode($email, $ttlSec, $code);

     }


    public function validateEmailVerificationCode(string $email, string $clientCode){
       $validCode = $this->verificationCodeEmail->getCode($email);
       $this->validationClientCode->validation($clientCode, $validCode);

    }

    public function regenerateCode(string $email){
        $currentTtl = $this->verificationCodeEmail->getTtl($email);
error_log($currentTtl);
        $this->sendVerificationCodeToEmail($email, 300);
    }
}

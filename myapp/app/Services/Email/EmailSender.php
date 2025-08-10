<?php
namespace App\Services\Email;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmMail;
class EmailSender{
   public function send(string $email, string $code){
      Mail::to($email)->send(new ConfirmMail($code));
   }
}

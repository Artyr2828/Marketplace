<?php
namespace App\Services\Email;
use App\Exceptions\InvalidEmailCodeException;
class ValidationClientCode{
   public function validation(string $clientCode, string $validCode){
     if ($clientCode !== $validCode){
         throw new InvalidEmailCodeException("Код невалиден");
     }
   }
}

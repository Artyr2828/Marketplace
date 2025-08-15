<?php
namespace App\Services\Email;
use App\Exceptions\InvalidEmailCodeException;
use App\Interfaces\ValidationCodeInterface;
class ValidationClientCode implements ValidationCodeInterface{
   public function validation(string $clientCode, string $validCode){
     if ($clientCode !== $validCode){
         throw new InvalidEmailCodeException("Код невалиден");
     }
   }
}

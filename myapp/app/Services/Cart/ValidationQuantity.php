<?php
namespace App\Services\Cart;
use Exception;


class ValidationQuantity{
   public function validation(int $quantity, string $data){
     error_log($quantity);
      if ($quantity <= 1 && $data === 'decrement'){
        throw new \Exception("Товар достиг минимума");
      }
      //
   }
}

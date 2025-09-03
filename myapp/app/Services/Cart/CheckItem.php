<?php
namespace App\Services\Cart;
use App\Models\CartItems;
//Изменить
class CheckItem{
  public function check(?CartItems $cartItems){
     if ($cartItems === null){
         throw new \Exception("Продукт не найден");
     }
  }
}

<?php
namespace App\Services\Order;
use App\Models\Carts;
class OrderRequiredValidate{
  public function validate(?Carts $cart){
      if (!$cart || !$cart->items){
         throw new \Exception('данного продукта нет в корзинк');
      }
  }
}

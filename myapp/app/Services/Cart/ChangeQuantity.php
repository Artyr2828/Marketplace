<?php
namespace App\Services\Cart;
use App\Models\CartItems;

class ChangeQuantity{
  public function change(CartItems $item, string $data){
        $item->quantity = $data;
        return $item;
  }
}

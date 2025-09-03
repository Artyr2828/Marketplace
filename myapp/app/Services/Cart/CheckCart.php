<?php
namespace App\Services\Cart;
use App\Models\Carts;

class CheckCart{
    public function check(?Carts $cart):void{
        if ($cart === null){                                                            throw new \Exception("Данной корзины не существует");
       }
    }
}

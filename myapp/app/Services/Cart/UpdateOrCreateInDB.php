<?php
namespace App\Services\Cart;
use App\Models\Carts;
class UpdateOrCreateInDB{
  public function updateOrCreate($cart,int $productId): void{
    $item = $cart->items()->where('product_id', $productId)->first();
    $cart->items()->updateOrCreate(
        ['product_id'=>$productId],

        ['quantity'=> $item ? $item->quantity+=1 : 1]
    );
  }
}

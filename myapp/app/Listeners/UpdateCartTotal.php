<?php

namespace App\Listeners;

use App\Events\ProductAddedToCart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Carts;
class UpdateCartTotal
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductAddedToCart $event): void
    {
     $cart = $event->cart;
     $product = $event->product;
     $data = json_encode($product);
      error_log("e" . print_r($data, true));
      $allCartTotal = $cart->items->sum(function ($item){
         return $item->product->price * $item->quantity;
      });
      $cart->total = $allCartTotal;
      $cart->save();
      error_log($allCartTotal);
    }
}

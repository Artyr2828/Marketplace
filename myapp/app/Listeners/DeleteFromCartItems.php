<?php

namespace App\Listeners;

use App\Events\OrderStore;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteFromCartItems
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
    public function handle(OrderStore $event): void
    {
      error_log("Доходит");
        $user = $event->user;
        if ($user->cart === null || $user->cart->items === null){
           error_log("продукты из корзины уже удалены");
           return;
        }
        $user->cart->items()->delete();
    }
}

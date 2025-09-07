<?php

namespace App\Listeners;

use App\Events\ProductAddedToCart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteFromCart
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
        //
    }
}

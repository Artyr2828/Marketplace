<?php
  namespace App\States\OrderStatus;
  use App\States\OrderStatus\OrderStatus;

  class ShippedStatus extends OrderStatus{
    public function label():string{
        return 'передан в доставку';
     }
  }


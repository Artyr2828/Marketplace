<?php
  namespace App\States\OrderStatus;
  use App\States\OrderStatus\OrderStatus;

  class DeliveredStatus extends OrderStatus{
    public function label():string{
        return 'доставлен';
     }
  }


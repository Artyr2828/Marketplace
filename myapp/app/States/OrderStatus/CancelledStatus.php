<?php
  namespace App\States\OrderStatus;
  use App\States\OrderStatus\OrderStatus;

  class CancelledStatus extends OrderStatus{
    public function label():string{
        return 'отменен';
     }
  }


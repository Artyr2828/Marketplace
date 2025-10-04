<?php
  namespace App\States\OrderStatus;
  use App\States\OrderStatus\OrderStatus;

  class PaidStatus extends OrderStatus{
    public function label():string{
        return 'оплачено';
     }
  }


<?php
namespace App\States\OrderStatus;
use App\States\OrderStatus\OrderStatus;

class Pending extends OrderStatus{
  public function label():string{
      return 'ожидание';
   }
}

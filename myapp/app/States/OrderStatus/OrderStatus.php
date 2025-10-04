<?php
namespace App\States\OrderStatus;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

use App\States\OrderStatus\Pending;
use App\States\OrderStatus\PaidStatus;
use App\States\OrderStatus\ShippedStatus;
use App\States\OrderStatus\DeliveredStatus;
use App\States\OrderStatus\CancelledStatus;
abstract class OrderStatus extends State{
   abstract public function label():string;

    public static function config(): StateConfig{
      return parent::config()
       ->default(Pending::class)
       ->allowTransition(Pending::class, PaidStatus::class)
       ->allowTransition(Pending::class, CancelledStatus::class)
       ->allowTransition(PaidStatus::class, ShippedStatus::class)
       ->allowTransition(PaidStatus::class, CancelledStatus::class)
       ->allowTransition(ShippedStatus::class, DeliveredStatus::class);

    }


}

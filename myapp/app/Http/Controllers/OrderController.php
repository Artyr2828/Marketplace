<?php

namespace App\Http\Controllers;

use App\Services\Order\OrderService;
use App\Http\Requests\StoreOrderRequest;
use Psy\Util\Json;

class OrderController extends Controller
{
    private $orderService;
    public function __construct(OrderService $orderService){
       $this->orderService = $orderService;
    }

    /**
 * Отправить заказ
 * @param StoreOrderRequest $r данные заказа(телефон, коммент, адрес)
 * @return Json
 */
    public function store(StoreOrderRequest $r){
       $this->orderService->store($r->address, $r->phone, $r->comment);
       return response()->api(['status'=>'ok'], 200);
    }

    /**
 * Отдать список заказов пользователя
 * @return Json
 */

    public function getOrderItems(){
       $user = auth()->user();
error_log("Helo");

return response()->api([$user->order->load('orderItems')]);


}
}

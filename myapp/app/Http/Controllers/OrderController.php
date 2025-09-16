<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Order\OrderService;
use App\Http\Requests\StoreOrderRequest;
use Predis\Command\Redis\Json\JSONDEL;

class OrderController extends Controller
{
    private $orderService;
    public function __construct(OrderService $orderService){
       $this->orderService = $orderService;
    }

 /**
 * Записываем данные заказа в БД(POST)
 * @param StoreOrderRequest $r специальный Request для валидации данных заказа
 * @return JSON
 **/

    public function store(StoreOrderRequest $r){
       $this->orderService->store($r->product_id, $r->address, $r->phone, $r->comment);
       return response()->api(['status'=>'ok']);
    }

    /**
 * @return Collection Данные заказа пользователя
 **/

    public function getOrderItems(){
       $user = auth()->user();
       return response()->api([$user->order->load('orderItems')]);
    }
}

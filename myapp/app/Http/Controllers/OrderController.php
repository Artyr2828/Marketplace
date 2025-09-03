<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItems;
use App\Services\Order\OrderService;

class OrderController extends Controller
{
    private $orderService;
    public function __construct(OrderService $orderService){
       $this->orderService = $orderService;
    }
    //Post запрос на заказ
    public function store(Request $r){
      /*  //Берем айди продукта
        $product_id = $r->product_id;
        //берем пользователя
        $user = auth()->user();
        //делаем заказ(может быть null)
        $order = $user->order()->firstOrCreate([
           'address'=>$r->address,
           'phone'=>$r->phone
        ]);
        //берем продукт(может быть null)
        $product = Product::find($product_id);
        error_log($product);
        //берем quantity из CartItems(изменить вкдь может быть null)
    //    $quantity_from_cart = CartItems::where('product_id', $product_id)->first()->quantity;
        //добавляем предметы в заказ
        $orderItem = $order->orderItem()->firstOrCreate([
          'product_id'=>$product_id,
          'price'=> $product->price,
           'quantity'=>/*$quantity_from_cart 2
        ]);
*/
       $this->orderService->store($r->product_id, $r->address, $r->phone);
        return response()->api(['status'=>'ok']);
    }
}

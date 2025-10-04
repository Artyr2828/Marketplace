<?php
namespace App\Services\Order;

use App\Services\Order\OrderRequiredValidate;
use App\Models\Carts;
use App\Events\OrderStore;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\CartItems;
use App\Models\OrdersTable;
class OrderService{
    private $orderRequiredValidate;

    public function __construct(OrderRequiredValidate $orderRequiredValidate){
        $this->orderRequiredValidate = $orderRequiredValidate;
    }


    public function store(string $address, string $phone, string $comment){
        //Берем Пользователя
        $user = auth()->user();
        //Берем продукты которые будем добавлять в "заказы"(может быть null)
        $products = Carts::where('user_id', $user->id)->first();

        if ($products->items()->get()->isEmpty()){
           throw new HttpResponseException(response()->json(["status"=>"error","error"=>"Your cart is empty"], 500));
        }
        //Проверяем на null Корзину и ее содержимое
        $this->orderRequiredValidate->validate($user->cart);

        //Делаем Заказ(может быть null)
        $order = $user->order()->create([
           'address'=>$address,
           'phone'=>$phone,
           'comment'=>$comment
        ]);

        //Добавляем предметы в заказе
        foreach ($products->items as $item){
        error_log("item" . $item->price);
        $order->orderItems()->firstOrCreate([
            'seller_id'=>$item->product->user_id,
             'user_id'=>$user->id,
            'product_id'=>$item->product_id,
             'price'=>$item->product->price,
             'quantity'=>$item->quantity
        ]);
     }
        event(new OrderStore($user));

  }
}


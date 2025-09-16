<?php
namespace App\Services\Order;
use App\Models\Product;
use App\Services\Order\CheckNotNull;
use App\Services\Order\OrderRequiredValidate;
use App\Models\OrderItem;
class OrderService{
    private $checkNotNull;
    private $orderRequiredValidate;

    public function __construct(CheckNotNull $checkNotNull, OrderRequiredValidate $orderRequiredValidate){
        $this->checkNotNull = $checkNotNull;
        $this->orderRequiredValidate = $orderRequiredValidate;
    }

    /**
 * Добавляем заказ в БД
 * @param int $productId идентификатор продукта
 * @param string $address адрес пользователя
 * @param string $phone номер телефона пользователя
 *
 */

    public function store(int $productId, string $address, string $phone, string $comment){
        //Берем Пользователя
        $user = auth()->user();
        //Берем продукт который будем добавлять в "заказы"(может быть null)
        $product = Product::find($productId);
        //проверяем на null(валидируем)
        $this->checkNotNull->validate($product);
        //Берем quantity из CartItems
        $this->orderRequiredValidate->validate($user->cart);
        $quantity = $user->cart->items()->where('product_id', $productId);

        //Делаем Заказ(может быть null)
        $order = $user->order()->create([
           'address'=>$address,
           'phone'=>$phone,
           'comment'=>$comment
        ]);

        //Добавляем предметы в заказе
        $order->orderItems()->firstOrCreate([
            'product_id'=>$productId,
             'price'=>$product->price,
             'quantity'=>1
        ]);

    }
}

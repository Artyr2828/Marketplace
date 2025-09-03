<?php
namespace App\Services\Cart;
use App\Models\User;
use App\Events\ProductAddedToCart;
use App\Services\Cart\UpdateOrCreateInDB;
use App\Services\Cart\ValidaionQuantity;
use App\Services\Cart\ChangeQuantity;
use App\Services\Cart\CheckItem;
use App\Models\CartItems;
use App\Services\Cart\CheckCart;
use App\Services\Cart\CheckNotNull;

class CartService{
   private $updOrCreate;
   private $validationQuantity;
   private $changeQuantity;
   private $checkItem;
   private $checkCart;
   private $checkNotNull;

   public function __construct(UpdateOrCreateInDB $updOrCreate, ValidationQuantity $validationQuantity, ChangeQuantity $changeQuantity, CheckItem $checkItem, CheckCart $checkCart, CheckNotNull $checkNotNull){
     $this->updOrCreate = $updOrCreate;
     $this->validationQuantity = $validationQuantity;
     $this->changeQuantity = $changeQuantity;
     $this->checkItem = $checkItem;
     $this->checkCart = $checkCart;
     $this->checkNotNull = $checkNotNull;
   }
   //Добавляем Товар В Корзину
   public function addOrUpdate(int $productId): void{
     //Берем item пользователя(может быть null)
     $user = auth()->user();
     $cart = $user->cart()->firstOrCreate();
    // $this->checkCart->check($cart);
       $this->checkNotNull->check($cart, "Корзина пуста");
     $item = $cart->items()->where('product_id', $productId)->first();


     $this->updOrCreate->updateOrCreate($cart, $productId);
     $arrProduct = $cart->items->map(fn ($item)=>$item->product);
      //вызываем событие с аргументом корзины
     event(new ProductAddedToCart($cart, $arrProduct));
   }
   //Отдать Данные Из Корзины
   public function getCartItems(){
    $cart = auth()->user()->cart()->firstOrCreate()->load('items.product.img_Connect');
    return $cart;
   }

   //Изменить Данные(количество товаров)

   public function changeQuantity(string $dataQuantity, int $ItemId){
        //Берем Item(продукт в корзине)
        $item = CartItems::where('id', $ItemId)->first();
        //item может быть null(если не найдено)
        $this->checkNotNull->check($item, "item пуст");
        //Изменяем
        $updatedItem = $this->changeQuantity->change($item, $dataQuantity);

          //Сохраняем Изменения
          $updatedItem->save();
   }

   //Удаляем Товар Из Корзины
   public function deleteCartItem(CartItems $item){
        $item->delete();
   }
}

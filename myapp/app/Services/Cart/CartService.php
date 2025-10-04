<?php
namespace App\Services\Cart;
use App\Events\ProductAddedToCart;
use App\Services\Cart\UpdateOrCreateInDB;
use App\Services\Cart\ChangeQuantity;
use App\Models\CartItems;
use App\Services\Cart\CheckNotNull;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Product;

class CartService{
   private $updOrCreate;
   private $changeQuantity;
   private $checkNotNull;

   public function __construct(UpdateOrCreateInDB $updOrCreate, ChangeQuantity $changeQuantity, CheckNotNull $checkNotNull){
     $this->updOrCreate = $updOrCreate;
     $this->changeQuantity = $changeQuantity;
     $this->checkNotNull = $checkNotNull;
   }
   //Добавляем Товар В Корзину
   public function addOrUpdate(int $productId): void{
     //Берем item пользователя(может быть null)
     $user = auth()->user();
     $cart = $user->cart()->firstOrCreate();
     $this->checkNotNull->check($cart, "Корзина пуста");
     $item = $cart->items()->where('product_id', $productId)->first();
     if (!Product::where('id', $productId)->exists()){
        throw new HttpResponseException(response()->json(["status"=>"error", "error"=>"The specified product was not found"], 404));
     }

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
        $this->checkNotNull->check($item, "Specified product not found in the cart");
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

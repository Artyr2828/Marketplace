<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Cart\CartService;
use App\Http\Requests\AddToCartRequest;
class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }

     //Добавления Товара В Корзину
    public function addToCart(AddToCartRequest $r){
     error_log("Доходит");
       $idProduct = $r->product_id;
       $this->cartService->addOrUpdate($idProduct);

       return response()->api(["statys"=>"ok"],200);
    }

     //Отдаем Товары Из Корзина
     public function getToCart(){
        $cart = $this->cartService->getCartItems();
        return response()->api(['items'=>$cart->items, 'total'=>$cart->total, 'img'=>$cart->img_Connect]);
     }


    //Изменения Количество Товара В Корзине
    public function changeQuantity(Request $r, $itemId){
       $dataQuantity = $r->quantity;
       $this->cartService->changeQuantity($dataQuantity, $itemId);
       return response()->api(['statys'=>'ok']);
    }

    public function deleteItem(int $itemId){
        $user = auth()->user();
        $item = $user->cart->items()->where('id', $itemId)->first();
        if (!$item){
            return response()->api(['Error'=>'item not found'], 404);
        }
        $this->cartService->deleteCartItem($item);

        return response()->api(['status'=>'ok'], 200);
    }
}


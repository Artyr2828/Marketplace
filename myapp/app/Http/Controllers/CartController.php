<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Cart\CartService;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\QuantityRequest;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }

     //Добавления Товара В Корзину
    public function addToCart(AddToCartRequest $r){
       $idProduct = $r->product_id;
       $this->cartService->addOrUpdate($idProduct);

       return response()->api(["status"=>"ok", "message"=>"The product has been successfully added to the cart"],200);
    }

     //Отдаем Товары Из Корзина
     public function getToCart(){
        $cart = $this->cartService->getCartItems();
        return response()->api(['items'=>$cart->items, 'total'=>$cart->total, 'img'=>$cart->img_Connect]);
     }


    //Изменения Количество Товара В Корзине
    public function changeQuantity(QuantityRequest $r, $itemId){
       $dataQuantity =  $r->quantity;
       $this->cartService->changeQuantity($dataQuantity,(int) $itemId);
       return response()->api(['status'=>'ok', "message"=>"The quantity of the item in the cart has been successfully updated"]);
    }

    //Удаления Товара
    public function deleteItem($itemId){
        $user = auth()->user();
        $itemId = (int) $itemId;
        $item = $user->cart->items()->where('id', $itemId)->first();
        if ($item === null){
            return response()->api(['status'=>'error','error'=>'Cart product not found'], 404);
        }
        $this->cartService->deleteCartItem($item);

        return response()->api(['status'=>'ok', "message"=>"Product successfully removed from the cart"], 200);
    }
}


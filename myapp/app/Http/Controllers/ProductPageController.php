<?php

namespace App\Http\Controllers;

use App\Models\Product;
class ProductPageController extends Controller
{
    //Get запрос с показом конкретного товара
    public function show(int $id){
        //Отдать дополнительные сведения продукта(с самим продуктом)
        $product = Product::with(['desc_Connect','img_Connect'])->where('id', $id)->first();

      return response()->api(["desctiprion"=>$product->toArray()]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;


class ProductPageController extends Controller
{
    //Get запрос с показом конкретного товара
    public function show(int $id){
        //Отдать дополнительные сведения продукта(с самим продуктом)
        $product = Product::with(['desc_Connect','img_Connect'])->where('id', $id)->first();
      if ($product === null){
         return response()->json(["status"=>"error", "error"=>"Product not found"], 404);
       }

      return response()->json(["description"=>$product->toArray()], 200);
    }
}

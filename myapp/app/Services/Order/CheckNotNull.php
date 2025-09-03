<?php
namespace App\Services\Order;
use App\Models\Product;
use Exception;

class CheckNotNull{
   public function validate(?Product $product){
      if ($product === null){
         throw new \Exception("Похоже данного продукта нет в продаже");
      }

     return $product;
   }
}

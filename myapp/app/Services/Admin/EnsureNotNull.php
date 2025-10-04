<?php
namespace App\Services\Admin;
use App\Models\Product;

class EnsureNotNull{
   public function check(?Product $product){
     if ($product === null){
        throw new \Exception("Вы не можете изменить данный продукт");
     }
   }
}

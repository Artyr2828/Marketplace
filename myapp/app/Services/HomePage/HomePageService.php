<?php
namespace App\Services\HomePage;
use App\Models\ImgPath;
use App\Models\Product;
class HomePageService{
   public function getProducts(): array{
      $image = Product::with('img_Connect')->limit(20)->get();
      return $image->toArray();
   }

   public function searchProduct(string $dataSearch){
     $productFind = Product::with('img_Connect')->where('name', 'LIKE', "%" . $dataSearch . "%")->get();
      return $productFind->toArray();
   }
}

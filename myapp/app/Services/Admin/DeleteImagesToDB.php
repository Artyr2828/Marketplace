<?php
namespace App\Services\Admin;
use App\Models\Product;

/**
 * Удаляем продукт по айди
 * @param App\Models\Product $product Продукт картинки которого мы удаляем
 * @param array $idImg Список айди изображений
 **/
class DeleteImagesToDB{
   public function delete(Product $product, array $idImages){
    error_log("Стоп");
     $deleted = $product->img_Connect()->whereIn('id', $idImages)->delete();
     if ($deleted === 0){
        throw new \Exception("Ошибка удаления изображений");
     }
   }
}

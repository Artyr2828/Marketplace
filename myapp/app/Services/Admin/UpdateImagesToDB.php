<?php
namespace App\Services\Admin;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Product;

/**
 * Обновляем уже существующие картинки товара
 * @param App\Models\Product $product Продукт изображения которого меняем
 * array $files Список Изображений
 **/

class UpdateImagesToDB{

  public function update(Product $product, array $files){
         $manager = new ImageManager(new Driver());

         foreach ($files as $id => $file){
             $filename = uniqid() . '.jpg';
             $image = $manager->read($manager->read($file->getRealPath()));
             $image->resize(800, 800, function ($settings){
                     $settings->aspectRatio();
                     $settings->upsize();
                });
             $image->save('images/device/' . $filename);

             $updated = $product->img_Connect()->where('id', $id)->update(
                  ['path'=>'images/device/' . $filename]
              );
          }
          if ($updated === 0){
             throw new \Exception("Вы не можете обновить это изображения");
          }

  }

}


<?php
namespace App\Services\Admin;
use App\Models\Product;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Arr;

/**
 * Добавляем изображении/изображения в БД
 * @param Product $product Продукт которому мы добавляем/меняем изображения
 * @param array $files массив изображений(может быть одно)
   **/

class AddImagesToDB{
   public function add(Product $product, array $files){
      $manager = new ImageManager(new Driver());
     $files = Arr::flatten($files);

      foreach ($files as $file){                                               $filename = uniqid() . '.jpg';
           $image = $manager->read($file->getRealPath());
           $image->resize(800, 800, function ($settings){
                 $settings->aspectRatio();
                 $settings->upsize();
          });
          $image->save('images/device/' . $filename);

          $product->img_Connect()->updateOrCreate(                                       ['path'=>'images/device/' . $filename],

               ['path'=>'images/device/' . $filename]
           );
        }
   }

}

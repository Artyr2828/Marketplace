<?php
namespace App\Services\Admin;

use App\Models\User;
use App\Models\Product;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class AdminPanelService{
  /**
 * @param User $user получаем пользователя(админа) чтобы выдать ему продукты
 * @return Collection $product отдаем коллекцию продуктов
 **/
   public function get(User $user){
      $products = Product::where('user_id', $user->id)->with(['img_Connect', 'desc_Connect'])->get();
      return $products;
   }


   /**
 * @param array $dataProducts данные о продукте
 * @param User $user пользователь
    */

   public function store(array $dataProducts, User $user){
      $files = $dataProducts['image'];
      $manager = new ImageManager(new Driver());

      $user->products()->create([
         'name'=>$dataProducts['name'],
         'price'=>$dataProducts['price']
      ]);
      $product = Product::where('user_id', $user->id)->first();

      $product->desc_Connect()->create([
          'desc'=>$dataProducts['desc']                                               ]);

      //добавляем в БД изображения
      foreach ($files as $file){
         $filename = uniqid() . '.jpg';
         $image = $manager->read($manager->read($file->getRealPath()));

         $image->resize(800, 800, function ($settings){                                  $settings->aspectRatio();
               $settings->upsize();
        });

        $image->save('images/device/' . $filename);

        $product->img_Connect()->create([
            'path'=>'images/device/' . $filename
        ]);
      }
   }
}

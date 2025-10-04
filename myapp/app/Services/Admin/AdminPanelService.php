<?php
namespace App\Services\Admin;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ImageStorageInterface;
use Illuminate\Http\Request;
use App\Models\OrdersTable;
use Sebdesign\SM\Facade as StateMashine;
use App\Services\Admin\ArrayCaster;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminPanelService{
   private $imageStorage;
   private $arrayCaster;

   public function __construct(ImageStorageInterface $imageStorage, ArrayCaster $arrayCaster){
       $this->imageStorage = $imageStorage;
       $this->arrayCaster = $arrayCaster;
   }
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

      $product = $user->products()->create([
         'name'=>$dataProducts['name'],
         'price'=>$dataProducts['price']
      ]);
      //$product = Product::where('user_id', $user->id)->first();
      $product->desc_Connect()->create([
          'desc'=>$dataProducts['desc']
       ]);

      //добавляем в БД изображения
      $this->imageStorage->add($product, $files);
   }

   /**
 * @param array $modifiedData Массив текстовых данных продукта для апдейта
 * @param Product $product Продукт, данные которого должны изменить
 * @param Request $imageActions информация об действие с изображениями
   **/
   public function update(array $modifiedData, Product $product, Request $imageActions){

       DB::transaction(function() use ($modifiedData, $product, $imageActions){
           //Изменяем Текстовые Данные
           $product->update($modifiedData);
           if (isset($modifiedData['description'])){
           $product->desc_Connect()->updateOrCreate(['product_id'=>$product->id], ['desc' => $modifiedData['description']]);
          }
$images = $imageActions->file('images');

           //Добавляем картинку к уже существующим
           $images = $this->arrayCaster->cast($imageActions->file('images'), null);
           $replace = $this->arrayCaster->cast(null, $imageActions->file('replace'));

           if ($imageActions->hasFile('images')){

               $this->imageStorage->add($product,$images);
           }
           if ($imageActions->hasFile('replace')){
               $this->imageStorage->update($product, $replace);
           }
           if ($imageActions->has('delete')){
               $this->imageStorage->delete($product, $imageActions->input('delete'));
           }

           $product->save();
     });
}

   /**
 *  @param OrdersTable $order Заказ, статус которого должны изменить
 *  @param string $transition информация для изменения статуса
   **/

   public function updateStatus(OrdersTable $order, string $transition){
      $stateMashine = StateMashine::get($order, 'graphA');

      if ($stateMashine->can($transition)){
           $stateMashine->apply($transition);
           $order->save();
      }
      else{
        throw new \Symfony\Component\HttpKernel\Exception\HttpException(422, "Ошибка изменения статуса");
      }
   }

   /**
 * Удаления продукта
 * @param Product $product Продукт который должны удалить
 **/

   public function delete(Product $product){
     if ($product->orderItems()->exists()){
            throw new HttpResponseException(response()->json(["status"=>"error", "error"=>"This product cannot be deleted as there are existing orders for it"], 409));
     }

     $deleted = $product->delete();
     if ($deleted === 0){
            throw new HttpResponseException(response()->json(["status"=>"error" , "error"=>"Failed to delete product."  ], 409));
     }
   }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\Utils\Json;
use App\Services\Admin\AdminPanelService;
use App\Models\OrdersTable;
use App\Services\Admin\EnsureNotNull;
use App\Models\OrderItem;

class AdminPanelController extends Controller
{
   private $adminPanelService;
   private $ensureNotNull;

   public function __construct(AdminPanelService $adminPanelService, EnsureNotNull $ensureNotNull){
      $this->adminPanelService = $adminPanelService;
      $this->ensureNotNull = $ensureNotNull;
   }


   /**
 * Отдаем Админу Его Продукты
 * @return Json
 */
    public function getProductItems(){
       $user = auth()->user();
       $products = $this->adminPanelService->get($user);
       return response()->api($products->toArray());
    }

   /**
 * Публикация Нового Продукта
 * @param Request $r данные продукта(его картинка, название и тд.)
 * @return Json
 * */
    public function store(Request $r){
       //Берем Фото(одно или несколько)
      $files = $r->file('images');
      $files = [$files];
      if ($files === null) {
        return response()->json(["status"=>"error", "error"=>"Photo not uploaded"], 422);
    }

    $user = auth()->user();
    $this->adminPanelService->store([
           'name'=>$r->input('name'),
           'price'=>$r->input('price'),
           'desc'=>$r->input('description'),
           'image'=>$files],
           $user);
error_log("2Controller");

      return response()->api(["status"=>"ok", "message"=>"Product successfully listed"]);
}
   /**
 * Отдать Список Заказов Админу
 * @return Json
 * */
    public function getOrders(){
     $orders = OrderItem::with('orders.user','product.img_Connect')->where('seller_id', auth()->user()->id)->get();
    //  $orders = OrdersTable::with(['orderItems', 'user.image'])->where('user_id', auth()->user()->id)->get();
      return response()->api($orders->toArray());
    }

/**
 * Обновления уже опубликованного продукта
 * @param Request $r данные для изменения(название, цена, описание)
 * @param int $itemId айди изменяемого проодукта
 * @return Json
 */

   public function update(Request $r, $itemId){
      $itemId = (int) $itemId;
      $data = $r->only(['name', 'price', 'description']);
      //фильтруем
      $data = array_filter($data, fn ($v)=>$v !== null && $v !== '');
      //получаем изменяемый продукт
      $user = auth()->user();
      $product = $user->products()->where('id', $itemId)->first();
      //Проверяем на null
      $this->ensureNotNull->check($product);
      //Добвляем новый изобщражения к уже существующим
      $this->adminPanelService->update($data, $product, $r);
      return response()->json(["status"=>"ok"]);
}

  /**
   * Удаления доступного продукта по айди
   * @param $itemId айди продукта
   */
  public function delete(int $itemId){
     $user = auth()->user();
     $product = $user->products()->where('id', $itemId)->first();
     if ($product === null){
         return response()->json(["status"=>"error", "error"=>"You are not authorized to access this product"], 403);
    }

     $this->adminPanelService->delete($product);
     return response()->json(["status"=>"ok", "message"=>"Product successfully deleted"], 200);

   }
  /**
 * Обновления статуса заказа
 * @param int $orderId айди заказа
 * @param Request $r данные для изменения
 * @return Json
 */


  public function updateStatus(int $orderId, Request $r){
      $user = auth()->user();
      $order = $user->order()->where('id', $orderId)->first();
      $transition = $r->transition;
      if ($transition === null || $order === null){
         return response()->json("Status update error.", 500);
      }
      $this->adminPanelService->updateStatus($order, $transition);
      return response()->json(['status'=>'ok', "message"=>"Status successfully updated"]);
      }
}

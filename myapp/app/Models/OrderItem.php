<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdersTable;
use App\Models\Product;

class OrderItem extends Model
{
    use HasFactory;

   protected $table = 'order_items';

   protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'price',
        'quantity'
   ];
   //Подключаем Заказы
   public function orders(){
     return $this->belongsTo(OrdersTable::class, 'order_id', 'id');
   }
   //Подключаем Продукт
   public function product(){
     return $this->belongsTo(Product::class, 'product_id', 'id');
   }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdersTable;
use App\Models\Product;
use App\Models\User;
class OrderItem extends Model
{
    use HasFactory;

   protected $table = 'order_items';

   protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
        'seller_id',
         'user_id'
   ];
   //Подключаем Заказы
   public function orders(){
     return $this->belongsTo(OrdersTable::class, 'order_id', 'id');
   }
   //Подключаем Продукт
   public function product(){
     return $this->belongsTo(Product::class, 'product_id', 'id');
   }

   public function seller(){
     return $this->belongsTo(User::class, 'seller_id');
   }

   public function user(){                                       return $this->belongsTo(User::class, 'user_id');        }
}

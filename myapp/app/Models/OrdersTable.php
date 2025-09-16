<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
class OrdersTable extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
       'user_id',
       'address',
       'comment',
       'phone',
       'status'
    ];

    //Подключяем "предметы" заказа
    public function orderItems(){
      return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}

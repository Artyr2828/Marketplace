<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\User;
use App\States\OrderStatus\OrderStatus;


class OrdersTable extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
       'address',
       'comment',
       'phone',
       'status',
        'user_id'
    ];
    protected $casts = [
       //
    ];
    //Подключяем "предметы" заказа
    public function orderItems(){
      return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function user(){
       return $this->belongsTo(User::class);
     }
}

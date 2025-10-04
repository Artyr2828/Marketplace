<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ImgPath;
use App\Models\DescriptionProduct;
use App\Models\CartItems;
use App\Models\OrderItem;
use App\Models\User;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
   protected $fillable = [
     'name',
     'price'
   ];


  public function img_Connect(){
    return $this->hasMany(ImgPath::class, 'product_id', 'id');
  }


  public function desc_Connect(){
    return $this->hasOne(DescriptionProduct::class, 'product_id');
  }

  public function items(){
    return $this->hasMany(CartItems::class);
  }

  public function orderItems(){
    return $this->hasMany(OrderItem::class, 'order_id');
  }
  public function user(){
     return $this->belongsTo(User::class);
  }
}

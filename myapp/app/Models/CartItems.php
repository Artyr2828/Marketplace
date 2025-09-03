<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Carts;
use App\Models\Product;
class CartItems extends Model
{
    use HasFactory;
    protected $table = "cart_items";
    protected $fillable = [
       'carts_id',
       'product_id',
        'quantity'
    ];

    public function cart(){
      return $this->belongsTo(Carts::class, 'cart_id');
    }

    public function product(){
       return $this->belongsTo(Product::class);
    }
}

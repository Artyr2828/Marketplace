<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class DescriptionProduct extends Model
{
    use HasFactory;

    protected $table = "description_product";

    protected $fillable = [
       'product_id',
       'desc'
    ];

    public function product_Connect(){
    $this->belongsTo(Product::class);
    }
}

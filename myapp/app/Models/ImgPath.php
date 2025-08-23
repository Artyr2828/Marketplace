<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class ImgPath extends Model
{
    use HasFactory;
    protected $table = 'img_path';

    protected $fillable = [
       'product_id',
       'path'
    ];


    public function productConnect(){
       return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

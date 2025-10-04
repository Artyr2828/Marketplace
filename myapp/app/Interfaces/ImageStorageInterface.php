<?php
namespace  App\Interfaces;
use App\Models\Product;

interface ImageStorageInterface{
   public function add(Product $product, array $images);
   public function update(Product $product, array $images);
   public function delete(Product $product, array $idImages);
}

<?php
namespace App\Services\Admin;
use App\Interfaces\ImageStorageInterface;
use App\Models\Product;
class ImageStorageService implements ImageStorageInterface{
    private $addImagesToDB;
    private $updateImagesToDB;
    private $deleteImagesToDB;

     public function __construct(AddImagesToDB $addImagesToDB, UpdateImagesToDB $updateImagesToDB, DeleteImagesToDB $deleteImagesToDB){
        $this->addImagesToDB = $addImagesToDB;
        $this->updateImagesToDB = $updateImagesToDB;
        $this->deleteImagesToDB = $deleteImagesToDB;
     }
    public function add(Product $product, array $images){
       $this->addImagesToDB->add($product, $images);
    }
    public function update(Product $product, array $images){                    $this->updateImagesToDB->update($product, $images);
    }
    public function delete(Product $product, array $idImages){                    $this->deleteImagesToDB->delete($product, $idImages);
    }
}

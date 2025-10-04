<?php
namespace App\Services\Admin;

class ArrayCaster{
  public function cast($images, $replace){
    if ($images instanceof \Illuminate\Http\UploadedFile) {
      $images = [$images];
      return $images;
  }
  if ($replace instanceof \Illuminate\Http\UploadedFile) {
      $replace = [$replace];
     return $replace;
  }

  }
}

<?php
namespace App\Services\ProfileService;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\Exceptions\HttpResponseException;

class EnsureDataNotNull{
   public function check(?string $name, ?UploadedFile $file){
       if ($name === null && $file === null){
           throw new HttpResponseException(response()->json(["status"=>"error", "error"=>"Invalid Data", "message"=>"отправлены не валидные данные"], 400, [], JSON_UNESCAPED_UNICODE));
       }
   }
}

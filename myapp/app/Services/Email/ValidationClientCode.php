<?php
namespace App\Services\Email;
use App\Exceptions\InvalidEmailCodeException;
use App\Interfaces\ValidationCodeInterface;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidationClientCode implements ValidationCodeInterface{
   public function validation(?string $clientCode, ?string $validCode){
     if ($validCode === null){
        throw new HttpResponseException(response()->json(["status"=>"error", "error"=>"Email not found"], 404));
     }
     if ($clientCode !== $validCode){
         throw new HttpResponseException(response()->json(["status"=>"error", "error"=>"Invalid Code"], 422));
     }
   }
}

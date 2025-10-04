<?php
namespace App\Services\Cart;
use Illuminate\Http\Exceptions\HttpResponseException;
/**
 * @param string $message сообщения в исключении
 * @param object|null $object любой обьект который надо проверить на null
 */
class CheckNotNull{
   public function check(object|null $object, string $message = 'Object is null'){
      if ($object === null){
          throw new HttpResponseException(response()->json(["status"=>"error", "error"=>$message], 404));
      }
   }
}

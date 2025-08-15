<?php
namespace App\Services\Storage;
use Illuminate\Support\Facades\Redis;
use App\Interfaces\VerificationCodeInterface;

class VerificationCodeStorage implements VerificationCodeInterface{

    public function setCode(string $email, int $ttlSec, string $code){
       $cooldown = Redis::set("cooldown-$email", true, 'EX', 60, 'NX');
       if (!$cooldown){
          $ttl = Redis::ttl("cooldown-$email");

          throw new \Exception("подождите $ttl секунд до повторной отправки");
       }
       Redis::set("verify-code-$email", $code, 'EX', $ttlSec);
    }

    public function getCode(string $email){
        return Redis::get("verify-code-$email");
    }

    public function delKey(string $key){
       $ttl = Redis::ttl($key);

       if ($ttl === -2){
         throw new \Exception("Код не найден");
       }
       if ($ttl === -1){
          throw new \Exception("Код не имеет срока, удалять не нужно");
       }


        Redis::del($key);
    }


    public function getTtl(string $email):int{
      return Redis::ttl("verify-code-$email");
    }
}

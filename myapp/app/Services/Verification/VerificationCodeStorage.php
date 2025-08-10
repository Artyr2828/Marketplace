<?php
namespace App\Services\Verification;
use Illuminate\Support\Facades\Redis;

class VerificationCodeStorage{
    public function setCode(string $email, int $ttlSec, string $code){
       $wantTrue = Redis::set("verify-code-$email", $code, 'EX', $ttlSec);

      if (!$wantTrue){
          throw new \Exception("код уже отправлен подождите или попробуйте через время");
       }
    }

    public function getCode(string $email){
        return Redis::get("verify-code-$email");
    }
}

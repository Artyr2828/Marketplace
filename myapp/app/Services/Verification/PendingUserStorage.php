<?php
namespace App\Services\Verification;

use Illuminate\Support\Facades\Redis;

class PendingUserStorage{
    public function sendUser(string $email, array $dataUser){
        Redis::set("User-$email", json_encode($dataUser), 'EX', 150, 'NX');
    }

    public function getUser(string $email):array{
       return json_decode(Redis::get("User-$email"), true);
    }
}

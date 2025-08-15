<?php
namespace App\Services\Storage;

use Illuminate\Support\Facades\Redis;
use App\Interfaces\PendingUserStorageInterface;
class PendingUserStorage implements PendingUserStorageInterface{
    public function setUser(string $email, array $dataUser){
        Redis::set("User-$email", json_encode($dataUser),'NX', 'EX', 120, 'NX');
    }

    public function getUser(string $email):array{
       return json_decode(Redis::get("User-$email"), true);
    }
}

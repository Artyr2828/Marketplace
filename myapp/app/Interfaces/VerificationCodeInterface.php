<?php
namespace App\Interfaces;


interface VerificationCodeInterface{
  public function getCode(string $email);
  public function setCode(string $email, int $ttlSec, string $code);
  public function delKey(string $key);
  public function getTtl(string $email): int;
}

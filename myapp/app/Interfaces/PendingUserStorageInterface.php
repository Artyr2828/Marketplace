<?php
namespace App\Interfaces;
interface PendingUserStorageInterface{
    public function getUser(string $email);
    public function setUser(string $email, array $data);
  }

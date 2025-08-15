<?php
namespace App\Interfaces;

use App\Models\User;

interface UserRegistrationInterface{
   public function addUserInDb(array $data);
   public function getUser(string $email):object;
   public function ensureUserDoesNotExist(string $email);
   public function changeDataInDB(User $user, string $field, mixed $value):void;
}

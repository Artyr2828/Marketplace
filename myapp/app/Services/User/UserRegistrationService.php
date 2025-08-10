<?php
namespace App\Services\User;
use App\Models\User;
use App\Exceptions\EmailAlreadyInUseException;
use Illuminate\Support\Facades\Hash;
class UserRegistrationService{
  public function ensureUserDoesNotExist(string $email){
       if (User::where('email', $email)->exists()){
         throw new EmailAlreadyInUseException("Email in Used");
       }
    }

   public function addUserInDb(array $data){
       User::create([
          'name'=>$data['name'],
          'email'=>$data['email'],
          'password'=>Hash::make($data['password'])
      ]);
    }
}

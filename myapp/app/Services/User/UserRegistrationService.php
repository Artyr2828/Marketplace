<?php
namespace App\Services\User;
use App\Models\User;
use App\Exceptions\EmailAlreadyInUseException;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\UserRegistrationInterface;

class UserRegistrationService implements UserRegistrationInterface{
  public function ensureUserDoesNotExist(string $email){
       if (User::where('email', $email)->exists()){
         throw new EmailAlreadyInUseException("Email in Used");
       }
    }

   public function addUserInDb(array $data){
     return  User::create([
          'name'=>$data['name'],
          'email'=>$data['email'],
          'password'=>$data['password'],
           'email_verified_at'=>null
      ]);
    }

   public function getUser(string $email):object{
     return User::where('email', $email)->first();
   }

   public function changeDataInDB(User $user, string $field, mixed $value):void{
       $user->$field = $value;
       $user->save();
   }
}

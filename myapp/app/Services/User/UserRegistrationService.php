<?php
namespace App\Services\User;

use App\Models\User;
use App\Interfaces\UserRegistrationInterface;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegistrationService implements UserRegistrationInterface{
  public function ensureUserDoesNotExist(string $email){
       if (User::where('email', $email)->exists()){
         throw new HttpResponseException(response()->json(["status"=>"error","error"=>"Email in Used"], 422));
       }
    }

   public function addUserInDb(array $data){

     $user = User::create([
          'name'=>$data['name'],
          'email'=>$data['email'],
          'password'=>$data['password'],
          'email_verified_at'=>null
      ]);
      $user->image()->create();
      return $user;

    }

   public function getUser(string $email):object{
     return User::where('email', $email)->first();
   }

   public function changeDataInDB(User $user, string $field, mixed $value):void{
       $user->$field = $value;
       $user->save();
   }
}

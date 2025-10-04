<?php
namespace App\Services\ProfileService;
use Illuminate\Http\UploadedFile;
use App\Services\ProfileService\UpdateToDB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfileService{
    private $updateToDB;

    public function __construct(UpdateToDB $updateToDB){
        $this->updateToDB = $updateToDB;
    }


    public function changeDataUser(?string $name, ?UploadedFile $image, User $user){
         if ($image !== null){
             $this->updateToDB->update($image, $user);
          }

         if ($name !== null){
            $user->update(['name'=>$name]);
         }

    }


    public function changePasswordUser(string $oldPassword, string $newPassword, User $user){
        if (!Hash::check($oldPassword, $user->password)){
            throw new HttpResponseException(response()->json(["status"=>"error", "error"=>"The current password incorrect", "message"=>"текущий пароль не действительный"], 422, [], JSON_UNESCAPED_UNICODE));
        }

        $user->update(['password'=>$newPassword]);
    }
}

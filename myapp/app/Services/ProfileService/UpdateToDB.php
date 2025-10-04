<?php
namespace App\Services\ProfileService;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;
use App\Models\User;

class UpdateToDB{
  public function update(UploadedFile $image, User $user){
     $manager = new ImageManager(new Driver());

     $filename = uniqid() . '.jpg';
     $img = $manager->read($manager->read($image->getRealPath()));
     $img->resize(256, 256, function ($settings){
            $settings->aspectRatio();
            $settings->upsize();
      });
      $img->save('images/device/' . $filename);

      $user->image()->updateOrCreate(
      ['user_id'=>auth()->user()->id],
      ['path'=>'images/device/' . $filename]
      );
  }
}

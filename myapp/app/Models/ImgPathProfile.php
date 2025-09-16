<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class ImgPathProfile extends Model
{
    use HasFactory;

    protected $table = 'img_profile';

    protected $fillable = [
      'user_id',
      'path'
    ];

    public function user(){
       return $this->belongsTo(User::class);
    }
}

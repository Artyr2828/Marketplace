<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Carts;
use App\Models\Role;
use App\Models\OrdersTable;
use App\Models\Product;
use App\Models\ImgPathProfile;
class User extends Authenticatable implements JWTSubject
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $attributes = [
       'role_id'=>1
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier(){
       return $this->getKey();
    }

    public function getJWTCustomClaims(){
       return [];
    }
    public function cart(){
      return $this->hasOne(Carts::class);
    }
    public function order(){
       return $this->hasMany(OrdersTable::class);
    }
    public function role(){
         return $this->belongsTo(OrdersTable::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function image(){
       return $this->hasOne(ImgPathProfile::class);
    }
}

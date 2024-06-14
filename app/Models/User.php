<?php

namespace App\Models;

use App\Models\Sale\Cart;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
  use HasFactory, Notifiable, SoftDeletes;

  /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
  protected $fillable = [
    'name',
    'surname',
    'type_user',
    'avatar',
    'phone',
    'email',
    'uniqd',
    'code_verified',
    'password',
    'email_verified_at'
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

  public function getJWTIdentifier()
  {
    return $this->getKey();
  }
  /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */

  public function getJWTCustomClaims()
  {
    return [];
  }
  public function carts()
  {
    return $this->hasMany(Cart::class, "user_id");
  }
  public function address(){
    return $this->hasMany(UserAddres::class,"user_id");
}
}

<?php

namespace App\Models;

use App\Models\Sale\Cart;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
  use HasFactory, Notifiable, SoftDeletes;

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
  ];

  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  public function getJWTCustomClaims()
  {
    return [];
  }
  public function carts()
  {
    return $this->hasMany(Cart::class, "user_id");
  }
}

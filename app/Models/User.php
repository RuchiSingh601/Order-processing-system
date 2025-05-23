<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'usercode',
    'firstname',
    'lastname',
    'mobile_number',
    'address',
    'city',
    'country',
    'postal',
    'about',
    'is_active',
    'role_id',
    'role',
    'warehouse_id',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'role_id',
    'usercode',
    'firstname',
    'lastname',
    'mobile_number',
    'password',
    'address',
    'city',
    'country',
    'postal',
    'about'
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }
  // public function setPasswordAttribute($value)
  // {
  //     $this->attributes['password'] = bcrypt($value);
  // }


  public function role()
  {
      return $this->belongsTo(Role::class);
  }
  public function warehouse()
  {
    return $this->hasOne(Warehouse::class);
  }

  // public function users()
  // {
  //     return $this->belongsTo(User::class);
  // }
}
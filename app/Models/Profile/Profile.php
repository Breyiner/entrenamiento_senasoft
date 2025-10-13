<?php

namespace App\Models\Profile;

use App\Models\City\City;
use App\Models\Gender\Gender;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

  protected $fillable = [
    'user_id',
    'first_name',
    'last_name',
    'phone_number',
    'email',
    'gender_id',
    'city_id',
  ];


  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function gender()
  {
    return $this->belongsTo(Gender::class);
  }
  public function city()
  {
    return $this->belongsTo(City::class);
  }

  public function scopeNonClients($query)
  {
    return $query->whereHas('user', function ($user) {
      $user->whereDoesntHave('roles', function ($role) {
        $role->where('name', 'Cliente');
      });
    });
  }
}

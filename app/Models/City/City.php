<?php

namespace App\Models\City;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
  ];

}

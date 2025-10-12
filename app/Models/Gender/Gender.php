<?php

namespace App\Models\Gender;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
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

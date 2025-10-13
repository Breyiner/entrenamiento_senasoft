<?php

namespace App\Models\ARL;

use Illuminate\Database\Eloquent\Model;

class ARL extends Model
{
  protected $table = 'arls';

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'nit',
    'email',
  ];
}

<?php

namespace App\Models\OrderStatus;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
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

<?php

namespace App\Models\UserStatus;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class UserStatus extends Model
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
  ];

  /**
   * Get the users associated with the status.
   */
  public function users(): HasMany
  {
    return $this->hasMany(related: User::class);
  }
}

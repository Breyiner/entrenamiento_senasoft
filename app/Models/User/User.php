<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Notification\Notification;
use App\Models\Profile\ClientProfile\ClientProfile;
use App\Models\Profile\Profile;
use App\Models\userStatus\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable, HasApiTokens, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'document',
    'password',
    'status_id',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'password' => 'hashed',
    ];
  }

  /**
   * Get the status that owns the user.
   */
  public function status(): BelongsTo
  {
    return $this->belongsTo(UserStatus::class);
  }

    public function profile(): HasOne
    {
      return $this->hasOne(Profile::class);
    }

  public function notifications(): HasMany
  {
    return $this->hasMany(Notification::class);
  }

  public function clientProfile(): HasOne
  {
    return $this->hasOne(ClientProfile::class);
  }

  public function scopeClients($query)
  {
    return $query->whereHas('roles', function ($q) {
      $q->where('name', 'Cliente');
    });
  }

  public function scopeUsers($query)
  {
    return $query->whereDoesntHave('roles', function ($q) {
      $q->where('name', 'Cliente');
    });
  }
}

<?php

namespace App\Models\Notification;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
  protected $fillable = [
    'user_id',
    'title',
    'content',
    'read',
  ];

  // Relación con usuario destino
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}

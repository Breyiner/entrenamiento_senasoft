<?php

namespace App\Models\ServiceOrder;

use App\Models\Activity\Activity;
use App\Models\OrderStatus\OrderStatus;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
  use HasFactory;

  protected $fillable = [
    'client_id',
    'professional_id',
    'activity_id',
    'date',
    'hours',
    'observations',
    'status_id',
  ];

  // Relación con cliente (usuario)
  public function client()
  {
    return $this->belongsTo(User::class, 'client_id');
  }

  // Relación con profesional (usuario)
  public function professional()
  {
    return $this->belongsTo(User::class, 'professional_id');
  }

  // Relación con actividad
  public function activity()
  {
    return $this->belongsTo(Activity::class);
  }

  // Relación con estado de orden
  public function status()
  {
    return $this->belongsTo(OrderStatus::class);
  }
}
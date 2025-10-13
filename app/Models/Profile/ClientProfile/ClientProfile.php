<?php

namespace App\Models\Profile\ClientProfile;

use App\Models\ARL\ARL;
use App\Models\Profile\Profile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientProfile extends Profile
{

  protected $table = "profiles";

  public function __construct(array $attributes = [])
  {
    $this->fillable = array_merge($this->fillable, $this->clientFillable);
    parent::__construct($attributes);
  }

  protected $clientFillable = [
    'company_name',
    'arl_id',
    'address',
  ];

  public function arl(): BelongsTo
  {
    return $this->belongsTo(ARL::class);
  }

  public function scopeOnlyClients($query)
  {
    return $query->whereHas('user', function ($user) {
      $user->whereHas('roles', function ($role) {
        $role->where('name', 'Cliente');
      });
    });
  }
}

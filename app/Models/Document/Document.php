<?php

namespace App\Models\Document;

use App\Models\DocumentStatus\DocumentStatus;
use App\Models\Note\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Document extends Model
{
  protected $fillable = [
    'original_name',
    'path',
    'mime_type',
    'extension',
    'size',
    'documentable_id',
    'documentable_type',
    'status_id',
  ];

  public function status(): BelongsTo
  {
    return $this->belongsTo(DocumentStatus::class);
  }

  public function notes(): MorphMany
  {
    return $this->morphMany(Note::class, 'notable');
  }

  public function documentable()
  {
    return $this->morphTo();
  }
}

<?php

namespace App\Models\Note;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'author',
        'content',
        'notable_id',
        'notable_type',
    ];

    public function notable() {
        return $this->morphTo();
    }
}

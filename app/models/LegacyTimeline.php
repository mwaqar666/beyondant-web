<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LegacyTimeline extends Model
{
    protected $table = 'legacy_timeline';
    protected $fillable = ['legacy_id', 'year', 'heading', 'description'];

    final public function legacy(): BelongsTo
    {
        return $this->belongsTo(Legacy::class, 'legacy_id', 'id');
    }
}

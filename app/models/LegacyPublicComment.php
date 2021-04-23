<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LegacyPublicComment extends Model
{
    protected $table = 'legacy_public_comments';
    protected $fillable = ['legacy_id', 'comment'];

    final public function legacy(): BelongsTo
    {
        return $this->belongsTo(Legacy::class, 'legacy_id', 'id');
    }
}

<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LegacyPrivateComment extends Model
{
    protected $table = 'legacy_private_comments';
    protected $fillable = ['user_id', 'legacy_id', 'comment'];

    final public function legacy(): BelongsTo
    {
        return $this->belongsTo(Legacy::class, 'legacy_id', 'id');
    }

    final public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

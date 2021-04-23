<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Legacy extends Model
{
    protected $table = 'legacies';
    protected $fillable = ['user_id', 'cemetery_location', 'from', 'to', 'description'];

    final public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    final public function privateComments(): HasMany
    {
        return $this->hasMany(LegacyPrivateComment::class, 'legacy_id', 'id');
    }

    final public function publicComments(): HasMany
    {
        return $this->hasMany(LegacyPublicComment::class, 'legacy_id', 'id');
    }

    final public function usersOfPrivateComments(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 'legacy_private_comments', 'legacy_id', 'user_id'
        )->withPivot(['comment'])->withTimestamps();
    }

    final public function legacyTimeline(): HasMany
    {
        return $this->hasMany(LegacyTimeline::class, 'legacy_id', 'id');
    }
}

<?php

namespace App;

use App\models\Legacy;
use App\models\LegacyPrivateComment;
use App\models\LegacyTimeline;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'password', 'contact_number', 'occupation', 'profile_picture',
        'role_id', 'job_title', 'company_name', 'company_description', 'mobile_check', 'mobile_number', 'fax_number',
        'website_address', 'address', 'state', 'city', 'province', 'zipcode', 'website', 'linkedin_check', 'instagram_check',
        'facebook_check', 'linkedin', 'instagram', 'facebook', 'cover_image', 'acc_type', 'parent_id', 'reseller_code',
        'website_check', 'tiktok_check', 'tiktok', 'overridden_profile', 'cover_video', 'cover_selection', 'cover_slideshow',
        'cash_app', 'appointment_booking', 'date_of_legacy'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_legacy' => 'bool',
        'email_verified_at' => 'datetime',
    ];

    final public function legacy(): HasOne
    {
        return $this->hasOne(Legacy::class, 'user_id', 'id');
    }

    final public function privateComments(): HasMany
    {
        return $this->hasMany(LegacyPrivateComment::class, 'user_id', 'id');
    }

    final public function legaciesOfPrivateComments(): BelongsToMany
    {
        return $this->belongsToMany(
            Legacy::class, 'legacy_private_comments', 'user_id', 'legacy_id'
        )->withPivot(['comment'])->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'description',
        'total_licenses',
        'used_licenses',
        'pending_invitations',
        'is_personal',
    ];

    protected $casts = [
        'is_personal' => 'boolean',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(TeamMember::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_members')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(TeamInvitation::class);
    }

    public function pendingInvitations(): HasMany
    {
        return $this->invitations()->whereNull('accepted_at')->where('expires_at', '>', now());
    }

    public function getRemainingLicensesAttribute(): int
    {
        return $this->total_licenses - $this->used_licenses - $this->pending_invitations;
    }
}

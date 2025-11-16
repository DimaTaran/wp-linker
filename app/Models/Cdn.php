<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cdn extends Model
{
    protected $fillable = [
        'name',
        'provider',
        'zone_id',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function credentials(): HasMany
    {
        return $this->hasMany(CdnCredential::class);
    }

    public function sites(): BelongsToMany
    {
        return $this->belongsToMany(Site::class, 'site_cdns')
            ->withPivot('is_active')
            ->withTimestamps();
    }
}

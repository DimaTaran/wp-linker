<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Site extends Model
{
    protected $fillable = [
        'name',
        'domain',
        'description',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function wpCredentials(): HasMany
    {
        return $this->hasMany(WpCredential::class);
    }

    public function servers(): BelongsToMany
    {
        return $this->belongsToMany(Server::class, 'site_servers')
            ->withPivot('server_role', 'is_primary')
            ->withTimestamps();
    }

    public function cdns(): BelongsToMany
    {
        return $this->belongsToMany(Cdn::class, 'site_cdns')
            ->withPivot('is_active')
            ->withTimestamps();
    }
}

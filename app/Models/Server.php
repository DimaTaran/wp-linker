<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Server extends Model
{
    protected $fillable = [
        'name',
        'ip_address',
        'hostname',
        'provider',
        'location',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function credentials(): HasMany
    {
        return $this->hasMany(ServerCredential::class);
    }

    public function sites(): BelongsToMany
    {
        return $this->belongsToMany(Site::class, 'site_servers')
            ->withPivot('server_role', 'is_primary')
            ->withTimestamps();
    }
}

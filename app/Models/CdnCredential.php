<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cdn;

class CdnCredential extends Model
{
    protected $fillable = [
        'cdn_id',
        'api_key_encrypted',
        'api_secret_encrypted',
        'email',
        'notes',
    ];

    protected $hidden = [
        'api_key_encrypted',
        'api_secret_encrypted',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function cdn()
    {
        return $this->belongsTo(Cdn::class);
    }

    public function setApiKeyAttribute($value): void
    {
        if ($value) {
            $this->attributes['api_key_encrypted'] = encrypt($value);
        }
    }

    public function getApiKeyAttribute(): ?string
    {
        return isset($this->attributes['api_key_encrypted'])
            ? decrypt($this->attributes['api_key_encrypted'])
            : null;
    }

    public function setApiSecretAttribute($value): void
    {
        if ($value) {
            $this->attributes['api_secret_encrypted'] = encrypt($value);
        }
    }

    public function getApiSecretAttribute(): ?string
    {
        return isset($this->attributes['api_secret_encrypted'])
            ? decrypt($this->attributes['api_secret_encrypted'])
            : null;
    }
}

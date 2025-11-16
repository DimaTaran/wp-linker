<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WpCredential extends Model
{
    protected $fillable = [
        'site_id',
        'admin_url',
        'username',
        'password_encrypted',
        'role',
        'notes',
    ];

    protected $hidden = [
        'password_encrypted',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    // encrypting / decrypting
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password_encrypted'] = encrypt($value);
    }

    public function getPasswordAttribute(): ?string
    {
        return isset($this->attributes['password_encrypted'])
            ? decrypt($this->attributes['password_encrypted'])
            : null;
    }
}

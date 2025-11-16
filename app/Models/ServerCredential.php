<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerCredential extends Model
{
    protected $fillable = [
        'server_id',
        'credential_type',
        'username',
        'password_encrypted',
        'ssh_key_encrypted',
        'port',
        'notes',
    ];

    protected $hidden = [
        'password_encrypted',
        'ssh_key_encrypted',
    ];

    protected $casts = [
        'port' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function setPasswordAttribute($value): void
    {
        if ($value) {
            $this->attributes['password_encrypted'] = encrypt($value);
        }
    }

    public function getPasswordAttribute(): ?string
    {
        return isset($this->attributes['password_encrypted'])
            ? decrypt($this->attributes['password_encrypted'])
            : null;
    }

    public function setSshKeyAttribute($value): void
    {
        if ($value) {
            $this->attributes['ssh_key_encrypted'] = encrypt($value);
        }
    }

    public function getSshKeyAttribute(): ?string
    {
        return isset($this->attributes['ssh_key_encrypted'])
            ? decrypt($this->attributes['ssh_key_encrypted'])
            : null;
    }
}

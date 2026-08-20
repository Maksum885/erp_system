<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;


    // UUID sebagai primary key
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // ── Role check helpers ─────────────────────────────
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isAccountManager(): bool
    {
        return $this->role === 'account_manager';
    }

    public function isPurchasing(): bool
    {
        return $this->role === 'purchasing';
    }

    public function isFinance(): bool
    {
        return $this->role === 'finance';
    }

    public function hasRole(string|array $roles): bool
    {
        return in_array($this->role, (array) $roles);
    }

    // Label tampilan untuk UI
    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'admin'           => 'Admin',
            'account_manager' => 'Account Manager',
            'purchasing'      => 'Purchasing',
            'finance'         => 'Finance',
            default           => 'Unknown',
        };
    }
}

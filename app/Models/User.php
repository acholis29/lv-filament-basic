<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use BezhanSalleh\FilamentShield\FilamentShield;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasPanelShield;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    protected static function booted(): void
    {

        if (config('filament-shield.members.enabled', false)) {
            FilamentShield::createRole(name: config('filament-shield.members.name', 'member_user'));
            static::created(function (User $user) {
                $user->assignRole(config('filament-shield.members.name', 'member_user'));
            });
            static::deleting(function (User $user) {
                $user->assignRole(config('filament-shield.members.name', 'member_user'));
            });
        }
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // return $this->hasRole(config('filament-shield.super_admin.name')) ||
        //     $this->hasRole(config('filament-shield.members.name', 'member_user')) ||
        //     $this->hasRole(config('filament-shield.dashboard.name', 'dashboard_user'));

        return $this->hasRole(Role::all());
    }

    public function canAccessFilament(): bool
    {
        // Implement your logic here to determine if the user can access Filament
        // For example:
        return $this->isAdmin && $this->hasVerifiedEmail();
    }
}

<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements FilamentUser
{
    use HasFactory, HasRoles;

    protected $casts = [
        'password' => 'hashed',
        'status' => StatusEnum::class,
    ];

    protected $guarded = [];

    protected $hidden = ['password'];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->status == StatusEnum::Active;
    }
}

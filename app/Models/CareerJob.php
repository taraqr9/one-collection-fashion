<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CareerJob extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function applications(): HasMany
    {
        return $this->hasMany(CareerApplication::class, 'career_job_id');
    }
}

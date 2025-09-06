<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class AccommodationType extends Model
{
    use HasFactory, UsesTenantConnection;

    protected $fillable = [
        'name',
        'description',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}

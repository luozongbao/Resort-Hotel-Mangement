<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class RoomType extends Model
{
    use HasFactory, UsesTenantConnection;

    protected $fillable = [
        'name',
        'description',
        'capacity',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}

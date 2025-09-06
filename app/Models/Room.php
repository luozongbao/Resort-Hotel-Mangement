<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Room extends Model
{
    use HasFactory, UsesTenantConnection;

    protected $fillable = [
        'name',
        'status',
        'accommodation_location_id',
        'accommodation_type_id',
        'room_type_id',
    ];

    public function accommodationLocation()
    {
        return $this->belongsTo(AccommodationLocation::class);
    }

    public function accommodationType()
    {
        return $this->belongsTo(AccommodationType::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}

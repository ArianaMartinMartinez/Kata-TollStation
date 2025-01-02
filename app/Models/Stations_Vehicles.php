<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stations_Vehicles extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_station',
        'id_vehicle',
        'amount',
    ];

    public function station(): BelongsTo {
        return $this->belongsTo(Station::class);
    }

    public function vehicle(): BelongsTo {
        return $this->belongsTo(Vehicle::class);
    }
}

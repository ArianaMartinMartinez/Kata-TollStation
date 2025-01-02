<?php

namespace App\Models;

use App\Models\Station;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stations_Vehicles extends Model
{
    use HasFactory;

    protected $table = 'stations_vehicles';

    protected $fillable = [
        'id_station',
        'id_vehicle',
        'amount',
    ];

    public function station(): BelongsTo {
        return $this->belongsTo(Station::class, 'id_station');
    }

    public function vehicle(): BelongsTo {
        return $this->belongsTo(Vehicle::class, 'id_vehicle');
    }
}

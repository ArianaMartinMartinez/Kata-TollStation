<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'license',
        'axles',
        'id_type',
    ];

    public function type(): BelongsTo {
        return $this->belongsTo(Type::class, 'id_type');
    }

    public function tolls(): HasMany {
        return $this->hasMany(Stations_Vehicles::class, 'id_vehicle');
    }
}

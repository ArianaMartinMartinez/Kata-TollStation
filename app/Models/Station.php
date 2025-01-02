<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'total_collected',
    ];

    public function tolls(): HasMany {
        return $this->hasMany(Stations_Vehicles::class);
    }
}

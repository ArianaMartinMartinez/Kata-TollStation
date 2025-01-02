<?php

namespace App\Models;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
    ];

    public function vehicles(): HasMany {
        return $this->hasMany(Vehicle::class, 'id_type');
    }
}

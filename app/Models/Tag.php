<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

     /**
     * Get the vehicle that owns the tag.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'VIN');
    }
}

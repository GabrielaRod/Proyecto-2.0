<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antenna extends Model
{
    /**
     * Get the antena associated with the coordinates.
     */
    public function coordinate()
    {
        return $this->hasOne('App\Antenna');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    /**
     * Get the coordinates that locate the Antena.
     */
    public function antenna()
    {
        return $this->belongsTo('App\Coordinate');
    }
}

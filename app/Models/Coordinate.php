<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    /**
     * Get the coordinates that locate the Antena.
     */

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (Coordinate $coordinate) {
            if (!$coordinate->antennas()->get()->contains(2)) {
                $coordinate->antennas()->attach(2);
            }
        });
    }

    public function antennas()
    {
        return $this->belongsToMany(Antenna::class);
    }
}

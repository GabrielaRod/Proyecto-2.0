<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The tags can be located in many places
     */
    protected $table = 'locations';

    protected $fillable = [
        'Location',
        'TagID',
        'Latitude',
        'Longitude'
    ];

}

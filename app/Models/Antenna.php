<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Antenna extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description'
    ];
    
    /**
     * Get the antena associated with the coordinates.
     */
    public function coordinate()
    {
        return $this->hasOne('App\Antenna');
    }
}

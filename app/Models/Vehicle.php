<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the vehicle.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     /**
     * The tag that belongs to the vehicle.
     */
    public function tag()
    {
        return $this->hasOne(Tag::class, 'Tag');
    }
}

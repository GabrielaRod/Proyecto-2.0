<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'Status', 'app_user_id'
    ];
     /**
     * The tag that belongs to the vehicle.
     */
    public function tags()
    {
        return $this->hasOne(Tag::class, 'Tag');
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (Vehicle $vehicle) {
            if (!$vehicle->app_users()->get()->contains(2)) {
                $vehicle->app_users()->attach(2);
            }
        });
    }

    /**
     * Get the app user that owns the vehicle.
     */

    public function app_users()
    {
        return $this->belongsToMany(AppUser::class);
    }
}

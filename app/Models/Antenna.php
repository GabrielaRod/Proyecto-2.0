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
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (Antenna $antenna) {
            if (!$antenna->coordinates()->get()->contains(2)) {
                $antenna->coordinates()->attach(2);
            }
        });
    }

    public function coordinates()
    {
        return $this->belongsToMany(Coordinate::class);
    }
}

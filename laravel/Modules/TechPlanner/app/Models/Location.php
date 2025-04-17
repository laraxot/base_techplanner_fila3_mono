<?php

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\TechPlanner\Database\Factories\LocationFactoryFactory;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'address',
        'city',
        'postal_code',
        'country',
    ];

    protected static function newFactory(): LocationFactoryFactory
    {
        return LocationFactoryFactory::new();
    }
}

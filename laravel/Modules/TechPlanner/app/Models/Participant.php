<?php

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\TechPlanner\Database\Factories\ParticipantFactoryFactory;

class Participant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    protected static function newFactory(): ParticipantFactoryFactory
    {
        return ParticipantFactoryFactory::new();
    }
}

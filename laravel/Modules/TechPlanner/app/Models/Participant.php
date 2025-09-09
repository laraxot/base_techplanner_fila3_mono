<?php

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\TechPlanner\Database\Factories\ParticipantFactoryFactory;

/**
 * @method static \Modules\TechPlanner\Database\Factories\ParticipantFactoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant query()
 * @mixin \Eloquent
 */
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

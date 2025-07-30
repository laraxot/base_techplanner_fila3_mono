<?php

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\TechPlanner\Database\Factories\EventFactoryFactory;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return array_merge(parent::casts(), [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ]);
    }

    protected static function newFactory(): EventFactoryFactory
    {
        return EventFactoryFactory::new();
    }
}

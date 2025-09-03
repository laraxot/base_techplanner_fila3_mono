<?php

declare(strict_types=1);

namespace Modules\Employee\Enums;

/**
 * Work Hour Type Enum
 * 
 * Defines the types of time tracking entries available in the system.
 * Replaces constants from WorkHour model for better type safety.
 */
enum WorkHourTypeEnum: string
{
    case CLOCK_IN = 'clock_in';
    case CLOCK_OUT = 'clock_out'; 
    case BREAK_START = 'break_start';
    case BREAK_END = 'break_end';

    /**
     * Get all available types as array.
     *
     * @return array<string>
     */
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get human-readable label for the type.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::CLOCK_IN => 'Clock In',
            self::CLOCK_OUT => 'Clock Out',
            self::BREAK_START => 'Break Start',
            self::BREAK_END => 'Break End',
        };
    }

    /**
     * Get Italian translation for the type.
     */
    public function getItalianLabel(): string
    {
        return match ($this) {
            self::CLOCK_IN => 'Entrata',
            self::CLOCK_OUT => 'Uscita',
            self::BREAK_START => 'Inizio Pausa',
            self::BREAK_END => 'Fine Pausa',
        };
    }

    /**
     * Determine if this is a clock-in type entry.
     */
    public function isClockedIn(): bool
    {
        return match ($this) {
            self::CLOCK_IN, self::BREAK_END => true,
            self::CLOCK_OUT, self::BREAK_START => false,
        };
    }

    /**
     * Get the next expected action based on current type.
     */
    public function getNextAction(): self
    {
        return match ($this) {
            self::CLOCK_IN => self::BREAK_START,
            self::BREAK_START => self::BREAK_END,
            self::BREAK_END => self::CLOCK_OUT,
            self::CLOCK_OUT => self::CLOCK_IN,
        };
    }
}
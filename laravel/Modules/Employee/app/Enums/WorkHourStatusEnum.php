<?php

declare(strict_types=1);

namespace Modules\Employee\Enums;

/**
 * Work Hour Status Enum
 * 
 * Defines the approval status states for time tracking entries.
 * Replaces constants from WorkHour model for better type safety.
 */
enum WorkHourStatusEnum: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    /**
     * Get all available statuses as array.
     *
     * @return array<string>
     */
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get human-readable label for the status.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
        };
    }

    /**
     * Get Italian translation for the status.
     */
    public function getItalianLabel(): string
    {
        return match ($this) {
            self::PENDING => 'In Attesa',
            self::APPROVED => 'Approvato',
            self::REJECTED => 'Rifiutato',
        };
    }

    /**
     * Get CSS class for status styling.
     */
    public function getCssClass(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::APPROVED => 'success', 
            self::REJECTED => 'danger',
        };
    }

    /**
     * Determine if status represents an approved state.
     */
    public function isApproved(): bool
    {
        return $this === self::APPROVED;
    }

    /**
     * Determine if status is still pending approval.
     */
    public function isPending(): bool
    {
        return $this === self::PENDING;
    }

    /**
     * Determine if status represents a rejected state.
     */
    public function isRejected(): bool
    {
        return $this === self::REJECTED;
    }

    /**
     * Get color for status display.
     */
    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => '#fbbf24',
            self::APPROVED => '#10b981',
            self::REJECTED => '#ef4444',
        };
    }
}
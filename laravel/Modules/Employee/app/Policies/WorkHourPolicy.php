<?php

declare(strict_types=1);

namespace Modules\Employee\Policies;

use Modules\Employee\Models\WorkHour;
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\User\Models\User;

class WorkHourPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any work hours.
     */
    public function viewAnyOld(User $user): bool
    {
        return $user->hasPermissionTo('view_work_hours') ||
               $user->hasRole(['admin', 'manager', 'hr']);
    }

    /**
     * Determine whether the user can view the work hour.
     */
    public function viewOld(User $user, WorkHour $workHour): bool
    {
        // Users can view their own work hours (STI: employee_id = user->id)
        if ((int) $user->id === (int) $workHour->employee_id) {
            return true;
        }

        // Managers and admins can view all work hours
        return $user->hasPermissionTo('view_all_work_hours') ||
               $user->hasRole(['admin', 'manager', 'hr']);
    }

    /**
     * Determine whether the user can create work hours.
     */
    public function createOld(User $user): bool
    {
        return $user->hasPermissionTo('create_work_hours') ||
               $user->hasRole(['admin', 'manager', 'hr', 'employee']);
    }

    /**
     * Determine whether the user can update the work hour.
     */
    public function updateOld(User $user, WorkHour $workHour): bool
    {
        // Users can update their own work hours within 24 hours
        if ((int) $user->id === (int) $workHour->employee_id) {
            if ($workHour->created_at?->diffInHours(now()) < 24) {
                return true;
            }
        }

        // Managers and admins can update any work hours
        return $user->hasPermissionTo('update_all_work_hours') ||
               $user->hasRole(['admin', 'manager', 'hr']);
    }

    /**
     * Determine whether the user can delete the work hour.
     */
    public function deleteOld(User $user, WorkHour $workHour): bool
    {
        // Users cannot delete their own work hours
        if ((int) $user->id === (int) $workHour->employee_id) {
            return false;
        }

        // Only admins and managers can delete work hours
        return $user->hasPermissionTo('delete_work_hours') ||
               $user->hasRole(['admin', 'manager']);
    }

    /**
     * Determine whether the user can restore the work hour.
     */
    public function restoreOld(User $user, WorkHour $workHour): bool
    {
        return $user->hasPermissionTo('restore_work_hours') ||
               $user->hasRole(['admin']);
    }

    /**
     * Determine whether the user can permanently delete the work hour.
     */
    public function forceDeleteOld(User $user, WorkHour $workHour): bool
    {
        return $user->hasPermissionTo('force_delete_work_hours') ||
               $user->hasRole(['admin']);
    }

    /**
     * Determine whether the user can clock in/out for themselves.
     */
    public function clockInOutOld(User $user, ?int $targetUserId = null): bool
    {
        // If no target user specified, user is clocking for themselves
        if ($targetUserId === null || $targetUserId === (int) $user->id) {
            return true;
        }

        // Managers can clock in/out for their team members
        return $user->hasPermissionTo('manage_team_work_hours') ||
               $user->hasRole(['admin', 'manager', 'hr']);
    }

    /**
     * Determine whether the user can view work hour reports.
     */
    public function viewReportsOld(User $user): bool
    {
        return $user->hasPermissionTo('view_work_hour_reports') ||
               $user->hasRole(['admin', 'manager', 'hr']);
    }

    /**
     * Determine whether the user can export work hour data.
     */
    public function exportOld(User $user): bool
    {
        return $user->hasPermissionTo('export_work_hours') ||
               $user->hasRole(['admin', 'manager', 'hr']);
    }

    /**
     * Determine whether the user can manage work hour settings.
     */
    public function manageSettingsOld(User $user): bool
    {
        return $user->hasPermissionTo('manage_work_hour_settings') ||
               $user->hasRole(['admin', 'hr']);
    }
}

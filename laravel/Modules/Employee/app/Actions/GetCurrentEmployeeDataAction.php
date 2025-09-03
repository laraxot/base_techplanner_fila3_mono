<?php

declare(strict_types=1);

namespace Modules\Employee\Actions;

use Modules\Employee\Models\Employee;
use Modules\Employee\Models\User;
use Spatie\QueueableAction\QueueableAction;

/**
 * Get current employee data for authenticated user.
 *
 * Returns comprehensive employee information for the current session.
 */
class GetCurrentEmployeeDataAction
{
    use QueueableAction;

    /**
     * Execute employee data retrieval.
     *
     * @return array{
     *   id: int,
     *   name: string,
     *   email: string,
     *   employeeNumber?: string,
     *   department?: array{id: int, name: string},
     *   position?: array{id: int, name: string},
     *   status: string,
     *   hireDate?: string
     * }
     */
    public function execute(int $userId): array
    {
        /** @var User|null $user */
        $user = User::find($userId);
        
        if (!$user) {
            return [
                'id' => $userId,
                'name' => 'Unknown User',
                'email' => '',
                'status' => 'unknown',
            ];
        }

        // Base user data
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'status' => 'active',
        ];

        // Try to get employee-specific data
        /** @var Employee|null $employee */
        $employee = Employee::find($userId);
        
        if ($employee) {
            $data['employeeNumber'] = $employee->employee_number ?? '';
            $data['status'] = $employee->status->value ?? 'active';
            $data['hireDate'] = $employee->hire_date?->format('d/m/Y') ?? '';

            // Department info
            if ($employee->department) {
                $data['department'] = [
                    'id' => $employee->department->id,
                    'name' => $employee->department->name,
                ];
            }

            // Position info
            if ($employee->position) {
                $data['position'] = [
                    'id' => $employee->position->id,
                    'name' => $employee->position->name,
                ];
            }
        }

        return $data;
    }
}

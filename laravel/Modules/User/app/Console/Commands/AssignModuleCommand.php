<?php

declare(strict_types=1);

namespace Modules\User\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Modules\User\Models\Role;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
use Nwidart\Modules\Facades\Module;
use Symfony\Component\Console\Input\InputOption;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\text;

class AssignModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'user:assign-module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign or revoke modules to/from user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $email = text('email ?');
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        /**
         * @var UserContract $user
         */
        $user = XotData::make()->getUserByEmail($email);
<<<<<<< HEAD
        
        if (!$user) {
            $this->error("User with email '{$email}' not found.");
=======

        if (! $user) {
            $this->error("User with email '{$email}' not found.");

>>>>>>> 9831a351 (.)
            return;
        }

        // Get all available modules
        $modules_opts = array_keys(Module::all());
        $modules_opts = array_combine($modules_opts, $modules_opts);

        // Get user's current module roles
        $userModuleRoles = $this->getUserModuleRoles($user);
        $currentModules = array_keys($userModuleRoles);

        // Show current modules as default selected
<<<<<<< HEAD
        $this->info("Current modules for {$email}: " . implode(', ', $currentModules));
=======
        $this->info("Current modules for {$email}: ".implode(', ', $currentModules));
>>>>>>> 9831a351 (.)

        $selectedModules = multiselect(
            label: 'Select modules (checked = assigned, unchecked = will be revoked)',
            options: $modules_opts,
            default: $currentModules, // Show current modules as checked
            required: false, // Allow empty selection
            scroll: 10,
        );

        // Determine modules to assign and revoke
        $modulesToAssign = array_diff($selectedModules, $currentModules);
        $modulesToRevoke = array_diff($currentModules, $selectedModules);

        // Assign new modules
        foreach ($modulesToAssign as $module) {
            $module_low = Str::lower(is_string($module) ? $module : (string) $module);
            $role_name = $module_low.'::admin';

            // Create or get the role with the web guard
            $role = Role::firstOrCreate(
                ['name' => $role_name],
                []
            );

            // Assign the role to the user
            $user->assignRole($role);
<<<<<<< HEAD
            
=======

>>>>>>> 9831a351 (.)
            $this->info("✓ Assigned module: {$module}");
        }

        // Revoke unchecked modules
        foreach ($modulesToRevoke as $module) {
            $module_low = Str::lower(is_string($module) ? $module : (string) $module);
            $role_name = $module_low.'::admin';

            // Revoke the role from the user
            $user->removeRole($role_name);
<<<<<<< HEAD
            
=======

>>>>>>> 9831a351 (.)
            $this->warn("✗ Revoked module: {$module}");
        }

        // Summary
        if (empty($modulesToAssign) && empty($modulesToRevoke)) {
<<<<<<< HEAD
            $this->info("No changes made to user modules.");
=======
            $this->info('No changes made to user modules.');
>>>>>>> 9831a351 (.)
        } else {
            $this->info("Module assignment updated for {$email}");
        }
    }

    /**
     * Get user's current module roles.
     *
<<<<<<< HEAD
     * @param UserContract $user
=======
>>>>>>> 9831a351 (.)
     * @return array<string, string>
     */
    private function getUserModuleRoles(UserContract $user): array
    {
        $moduleRoles = [];
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        foreach ($user->roles as $role) {
            if (Str::endsWith($role->name, '::admin')) {
                $moduleName = Str::before($role->name, '::admin');
                $moduleRoles[$moduleName] = $role->name;
            }
        }
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        return $moduleRoles;
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}

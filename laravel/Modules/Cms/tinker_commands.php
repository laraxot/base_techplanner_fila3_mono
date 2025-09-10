<?php

/**
 * Tinker commands to generate 100 records for each business model
 * Run with: php artisan tinker < tinker_commands.php
 */

// Module: SaluteOra
echo "Generating Patient...";
\Modules\TechPlanner\Models\Patient::factory()->count(100)->create();
echo "✅ Patient completed\n";

echo "Generating Doctor...";
\Modules\TechPlanner\Models\Doctor::factory()->count(100)->create();
echo "✅ Doctor completed\n";

echo "Generating Studio...";
\Modules\TechPlanner\Models\Studio::factory()->count(100)->create();
echo "✅ Studio completed\n";

echo "Generating Appointment...";
\Modules\TechPlanner\Models\Appointment::factory()->count(100)->create();
echo "✅ Appointment completed\n";

echo "Generating Report...";
\Modules\TechPlanner\Models\Report::factory()->count(100)->create();
echo "✅ Report completed\n";

echo "Generating Profile...";
\Modules\TechPlanner\Models\Profile::factory()->count(100)->create();
echo "✅ Profile completed\n";

echo "Generating User...";
\Modules\TechPlanner\Models\User::factory()->count(100)->create();
echo "✅ User completed\n";


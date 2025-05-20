<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
<<<<<<< HEAD
use Illuminate\Support\Facades\Schema;
=======
>>>>>>> 0b525d2 (.)
// ---- models ---
use Modules\User\Models\Role;
use Modules\Xot\Database\Migrations\XotBaseMigration;
use Modules\Xot\Datas\XotData;

/*
 * Class CreateModelHasRolesTable.
 */
return new class extends XotBaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $team_class = XotData::make()->getTeamClass();
                $table->id();
<<<<<<< HEAD
=======
                // $table->foreignIdFor(Role::class, 'role_id')->nullable();
>>>>>>> 0b525d2 (.)
                $table->integer('role_id')->index()->nullable();
                $table->uuidMorphs('model');
                $table->foreignIdFor($team_class, 'team_id')->nullable();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                $team_class = XotData::make()->getTeamClass();
                if (! $this->hasColumn('team_id')) {
                    $table->foreignIdFor($team_class, 'team_id')->nullable();
                }
                if ($this->getColumnType('model_id') === 'uuid') {
                    $table->string('model_id', 36)->index()->change();
                }
                if ($this->getColumnType('role_id') === 'uuid') {
                    $table->integer('role_id')->index()->change();
                }
<<<<<<< HEAD
=======
                // $this->updateUser($table);
>>>>>>> 0b525d2 (.)
                $this->updateTimestamps($table);
            }
        );
    }
};

<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Notify\Enums\ContactTypeEnum;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->tableCreate(function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->string('name')->index();
            $table->string('vat_number')->nullable()->index();
            $table->string('fiscal_code')->nullable()->index();
            $table->string('address')->nullable();
            $table->string('city')->nullable()->index();
            $table->string('postal_code')->nullable();
            $table->string('province')->nullable()->index();
            $table->string('phone')->nullable();
            $table->string('email')->nullable()->index();
            $table->text('notes')->nullable();
        });
        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            $contact_types = ContactTypeEnum::cases();
            foreach ($contact_types as $contact_type) {
                if (!$this->hasColumn($contact_type->value)) {
                    $table->string($contact_type->value)->nullable();
                }
            }
            if (!$this->hasColumn('route')) {
                $table->string('route')->nullable();
            }
            if (!$this->hasColumn('administrative_area_level_1')) {
                $table->string('administrative_area_level_1')->nullable()->index();
            }
            if (!$this->hasColumn('administrative_area_level_2')) {
                $table->string('administrative_area_level_2')->nullable()->index();
            }
            if (!$this->hasColumn('administrative_area_level_3')) {
                $table->string('administrative_area_level_3')->nullable()->index();
            }
            if (!$this->hasColumn('locality')) {
                $table->string('locality')->nullable()->index();
            }
            if (!$this->hasColumn('sublocality')) {
                $table->string('sublocality')->nullable()->index();
            }
            if (!$this->hasColumn('sublocality_level_1')) {
                $table->string('sublocality_level_1')->nullable()->index();
            }
            if (!$this->hasColumn('sublocality_level_2')) {
                $table->string('sublocality_level_2')->nullable()->index();
            }

            $this->updateTimestamps(
                table: $table,
                hasSoftDeletes: true,
            );
        });
    }
};

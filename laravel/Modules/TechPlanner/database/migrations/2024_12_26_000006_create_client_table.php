<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration {
    public function up(): void
    {
        $this->tableCreate(function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('fiscal_code')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $this->addCommonFields($table);
        });

        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            $table->string('name')->nullable()->change();
            if (!$this->hasColumn('business_closed')) {
                $table->boolean('business_closed')->default(false);
            }
            if (!$this->hasColumn('competent_health_unit')) {
                $table->string('competent_health_unit')->nullable(); // az_ulss_competente
            }

            if (!$this->hasColumn('country')) {
                $table->string('country')->nullable();
            }

            if (!$this->hasColumn('address')) {
                $table->string('address')->nullable();
            }
            if (!$this->hasColumn('city')) {
                $table->string('city')->nullable();
            }

            if (!$this->hasColumn('vat_number')) {
                $table->string('vat_number')->nullable();
            }

            if (!$this->hasColumn('tax_code')) {
                $table->string('tax_code')->nullable(); // cf
            }

            if (!$this->hasColumn('company_name')) {
                $table->string('company_name')->nullable(); // ditta
            }
            if (!$this->hasColumn('company_office')) {
                $table->string('company_office')->nullable(); // sede_ditta
            }
            if (!$this->hasColumn('street_number')) {
                $table->string('street_number')->nullable(); // numero_civico
            }
            if (!$this->hasColumn('province')) {
                $table->string('province')->nullable(); // provincia
            }
            if (!$this->hasColumn('postal_code')) {
                $table->string('postal_code')->nullable(); // cap
            }
            if (!$this->hasColumn('phone')) {
                $table->string('phone')->nullable(); // telefono
            }
            if (!$this->hasColumn('fax')) {
                $table->string('fax')->nullable(); // fax
            }

            if (!$this->hasColumn('mobile')) {
                $table->string('mobile')->nullable(); // cellulare
            }
            if (!$this->hasColumn('email')) {
                $table->string('email')->nullable(); // email
            }
            if (!$this->hasColumn('pec')) {
                $table->string('pec')->nullable(); // pec
            }
            if (!$this->hasColumn('whatsapp')) {
                $table->string('whatsapp')->nullable(); // whatsapp
            }
            if (!$this->hasColumn('notes')) {
                $table->text('notes')->nullable(); // note
            }
            if (!$this->hasColumn('activity')) {
                $table->string('activity')->nullable(); // attivita
            }

            if (!$this->hasColumn('latitude')) {
                $table->decimal('latitude', 12, 8)->nullable();
            }
            if (!$this->hasColumn('longitude')) {
                $table->decimal('longitude', 12, 8)->nullable();
            }
            $this->updateTimestamps($table, true);
        });
    }
};

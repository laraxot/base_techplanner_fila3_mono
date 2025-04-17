<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    public function up(): void
    {
        $this->tableCreate(
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
                $table->string('name');
                $table->string('fiscal_code')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $this->addCommonFields($table);
            }
        );
    }
};

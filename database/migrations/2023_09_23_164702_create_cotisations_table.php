<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cotisations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('participation_id')->constrained();
            $table->string('periode')->nullable();
            $table->integer('nbr_cotisations')->default(0);
            $table->enum('prise', ['oui', 'non']); // Ajoutez la colonne 'nbr_cotisations'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotisations');
    }
};

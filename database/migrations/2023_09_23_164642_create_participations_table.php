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
        Schema::create('participations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('tontine_id')->constrained();
            $table->integer('nombre_bras');
            $table->integer('rank');
            $table->integer('nbr_cotisations')->default(0);
            $table->enum('prise', ['oui', 'non']);
            $table->date('date_prise')->nullable(); // Ajoutez la colonne date_prise de type date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participations');
    }
};

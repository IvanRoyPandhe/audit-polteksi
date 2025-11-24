<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add unit_id to indikator_kinerja
        Schema::table('indikator_kinerja', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->nullable()->after('standar_id');
            $table->foreign('unit_id')->references('unit_id')->on('unit')->onDelete('set null');
        });
        
        // Add unit_id to kriteria
        Schema::table('kriteria', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->nullable()->after('indikator_id');
            $table->foreign('unit_id')->references('unit_id')->on('unit')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('indikator_kinerja', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');
        });
        
        Schema::table('kriteria', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');
        });
    }
};

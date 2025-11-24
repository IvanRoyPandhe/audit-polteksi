<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add soft deletes to important tables
        Schema::table('data_kinerja', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('validasi', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('audit', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('audit_temuan', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('data_kinerja', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('validasi', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('audit', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('audit_temuan', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};

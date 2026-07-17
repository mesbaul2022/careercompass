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
        Schema::table('job_circulars', function (Blueprint $table) {
            $table->string('company_logo')->nullable()->after('company_name');
            $table->string('location')->nullable()->after('category');
            $table->string('experience')->nullable()->after('location');
            $table->string('salary')->nullable()->after('experience');
            $table->longText('requirements')->nullable()->after('description');
            $table->longText('responsibilities')->nullable()->after('requirements');
            $table->longText('benefits')->nullable()->after('responsibilities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_circulars', function (Blueprint $table) {
            //
        });
    }
};

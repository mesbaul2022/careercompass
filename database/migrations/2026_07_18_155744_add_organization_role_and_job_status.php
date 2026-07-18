<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up(): void
    {
        // Safely update the ENUM to include 'organization'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('user', 'admin', 'organization') NOT NULL DEFAULT 'user'");

        Schema::table('job_circulars', function (Blueprint $table) {
            // New jobs will default to pending will place it after the category column.
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('category');
        });

        // Auto-approve all existing jobs in the database
        DB::table('job_circulars')->update(['status' => 'approved']);
    }

    public function down(): void
    {
        Schema::table('job_circulars', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
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
        if (Schema::hasColumn('users', 'nom') && ! Schema::hasColumn('users', 'name')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->renameColumn('nom', 'name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'name') && ! Schema::hasColumn('users', 'nom')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->renameColumn('name', 'nom');
            });
        }
    }
};

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
        Schema::table('roles', function (Blueprint $table) {
            $table->string('group')->nullable()->after('name');
            $table->string('display_name')->nullable()->after('group');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('group')->nullable()->after('name');
            $table->string('display_name')->nullable()->after('group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('group');
            $table->dropColumn('display_name');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('group')->nullable();
            $table->dropColumn('display_name')->nullable();
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            if (!Schema::hasColumn('leads', 'first_name')) {
                $table->string('first_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('leads', 'last_name')) {
                $table->string('last_name')->nullable()->after('first_name');
            }
            if (!Schema::hasColumn('leads', 'preferred_location')) {
                $table->string('preferred_location')->nullable()->after('subject');
            }
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            if (Schema::hasColumn('leads', 'preferred_location')) {
                $table->dropColumn('preferred_location');
            }
            if (Schema::hasColumn('leads', 'last_name')) {
                $table->dropColumn('last_name');
            }
            if (Schema::hasColumn('leads', 'first_name')) {
                $table->dropColumn('first_name');
            }
        });
    }
};

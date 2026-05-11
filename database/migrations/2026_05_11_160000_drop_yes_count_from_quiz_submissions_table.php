<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quiz_submissions', function (Blueprint $table) {
            if (Schema::hasColumn('quiz_submissions', 'yes_count')) {
                $table->dropColumn('yes_count');
            }
        });
    }

    public function down(): void
    {
        Schema::table('quiz_submissions', function (Blueprint $table) {
            $table->integer('yes_count')->default(0)->after('answers_json');
        });
    }
};
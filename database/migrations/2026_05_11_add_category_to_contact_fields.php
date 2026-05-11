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
        Schema::table('contact_fields', function (Blueprint $table) {
            $table->enum('category', ['inclinic_visit', 'online_consultation', 'whatsapp', 'all'])->default('all')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_fields', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};

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
        Schema::create('treatment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Add foreign key to success_stories
        Schema::table('success_stories', function (Blueprint $table) {
            $table->unsignedBigInteger('treatment_type_id')->nullable()->after('treatment_type');
            $table->foreign('treatment_type_id')->references('id')->on('treatment_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('success_stories', function (Blueprint $table) {
            $table->dropForeign(['treatment_type_id']);
            $table->dropColumn('treatment_type_id');
        });

        Schema::dropIfExists('treatment_types');
    }
};

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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            // Listing Page Fields
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category_tag');
            $table->text('short_description');
            $table->string('accent_class')->default('ivf'); // ivf, pcos, male, obs, pres, surg
            $table->string('listing_image');
            
            // Detail Page Hero
            $table->string('hero_eyebrow')->default('Advanced Protocol');
            $table->text('hero_lead');
            $table->string('hero_pills'); // Comma separated tags
            $table->string('hero_image');
            
            // Detail Page Stats
            $table->string('stat1_num')->nullable();
            $table->string('stat1_label')->nullable();
            $table->string('stat2_num')->nullable();
            $table->string('stat2_label')->nullable();
            $table->string('stat3_num')->nullable();
            $table->string('stat3_label')->nullable();
            
            // Approach Section
            $table->string('approach_title')->default('The Approach');
            $table->longText('approach_text'); // HTML or double paragraph
            
            // Protocol Section
            $table->string('protocol_title')->default('Typical Protocol');
            $table->json('protocol_json')->nullable(); // Steps
            
            // Expectations Section
            $table->string('expect_title')->default('What to Expect');
            $table->json('expect_json')->nullable(); // List items
            
            // Safety Section
            $table->string('safety_title')->default('Safety & Ethical Practice');
            $table->longText('safety_text');

            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

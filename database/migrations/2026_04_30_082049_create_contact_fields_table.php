<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_fields', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('name');
            $table->string('type')->default('text'); // text, email, tel, select, textarea
            $table->text('options')->nullable(); // For select type, comma separated
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);
            $table->string('placeholder')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_fields');
    }
};

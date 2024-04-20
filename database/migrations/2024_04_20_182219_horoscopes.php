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
        Schema::create('horoscopes', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('horoscope')->nullable();
            $table->foreignId('sign_id')->constrained();
            $table->foreignId('time_id')->constrained();
            $table->string('lang_iso_code');
            $table->foreign('lang_iso_code')->references('iso_code')->on('langs');
            $table->integer('referenced_horoscope')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horoscopes');
    }
};

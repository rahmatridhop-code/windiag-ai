<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hypotheses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name');
            $table->string('category');
            $table->text('solution');
            $table->timestamps();
        });

        Schema::create('symptoms', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hypothesis_id');
            $table->unsignedBigInteger('symptom_id');
            $table->float('cf_pakar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rules');
        Schema::dropIfExists('symptoms');
        Schema::dropIfExists('hypotheses');
    }
};
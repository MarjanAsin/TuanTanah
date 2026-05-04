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
        Schema::create('properti_fotos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('properti_id');

            $table->string('path');

            $table->timestamps();

            $table->foreign('properti_id')
                ->references('properti_id')
                ->on('properti')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properti_fotos');
    }
};

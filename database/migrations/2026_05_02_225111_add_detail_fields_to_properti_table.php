<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properti', function (Blueprint $table) {
            $table->string('tipe_properti')->nullable();
            $table->integer('luas_tanah')->nullable();
            $table->integer('jumlah_kamar')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('properti', function (Blueprint $table) {
            $table->dropColumn(['tipe_properti', 'luas_tanah', 'jumlah_kamar']);
        });
    }
};

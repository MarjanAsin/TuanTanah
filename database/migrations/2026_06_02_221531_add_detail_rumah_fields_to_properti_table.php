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
        Schema::table('properti', function (Blueprint $table) {

            $table->integer('luas_bangunan')
                ->nullable()
                ->after('luas_tanah');

            $table->integer('kamar_mandi')
                ->nullable()
                ->after('jumlah_kamar');

            $table->integer('daya_listrik')
                ->nullable()
                ->after('kamar_mandi');
        });
    }

    public function down(): void
    {
        Schema::table('properti', function (Blueprint $table) {

            $table->dropColumn([
                'luas_bangunan',
                'kamar_mandi',
                'daya_listrik'
            ]);

        });
    }
};

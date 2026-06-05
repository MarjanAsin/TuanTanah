<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properti', function (Blueprint $table) {

            $table->dropColumn([
                'kontak_whatsapp',
                'alasan_penolakan_pembayaran'
            ]);

        });
    }

    public function down(): void
    {
        Schema::table('properti', function (Blueprint $table) {

            $table->string('kontak_whatsapp', 15)->nullable();

            $table->text('alasan_penolakan_pembayaran')->nullable();

        });
    }
};
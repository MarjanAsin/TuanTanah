<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properti', function (Blueprint $table) {

            $table->enum('status_pembayaran', ['pending', 'valid', 'ditolak'])
                  ->default('pending')
                  ->after('bukti_pembayaran');

            $table->text('alasan_penolakan_pembayaran')
                  ->nullable()
                  ->after('status_pembayaran');

        });
    }

    public function down(): void
    {
        Schema::table('properti', function (Blueprint $table) {

            $table->dropColumn('status_pembayaran');
            $table->dropColumn('alasan_penolakan_pembayaran');

        });
    }
};

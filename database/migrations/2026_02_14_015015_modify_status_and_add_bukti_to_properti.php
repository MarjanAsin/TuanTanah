<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('properti', function (Blueprint $table) {

            $table->string('bukti_pembayaran')->nullable();

        });

        DB::statement("
            ALTER TABLE properti
            MODIFY status ENUM(
                'menunggu_pembayaran',
                'menunggu_verifikasi_pembayaran',
                'menunggu',
                'disetujui',
                'ditolak'
            ) NOT NULL DEFAULT 'menunggu'
        ");
    }

    public function down()
    {
        Schema::table('properti', function (Blueprint $table) {
            $table->dropColumn('bukti_pembayaran');
        });
    }
};

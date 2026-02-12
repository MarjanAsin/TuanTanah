<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properti', function (Blueprint $table) {
            $table->id('properti_id');

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('nama_properti');
            $table->decimal('harga', 15, 2);
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->string('fasilitas');
            $table->string('kontak_whatsapp');
            $table->string('foto_properti');

            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])
                  ->default('menunggu');

            $table->boolean('is_unggulan')
                  ->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properti');
    }
};


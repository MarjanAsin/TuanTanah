<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properti', function (Blueprint $table) {

            $table->index('status');

            $table->index('status_pembayaran');

            $table->index('is_unggulan');

            $table->index('created_at');

            $table->index([
                'status',
                'status_pembayaran'
            ]);

            $table->index([
                'user_id',
                'status'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('properti', function (Blueprint $table) {

            $table->dropIndex(['status']);

            $table->dropIndex(['status_pembayaran']);

            $table->dropIndex(['is_unggulan']);

            $table->dropIndex(['created_at']);

            $table->dropIndex([
                'status',
                'status_pembayaran'
            ]);

            $table->dropIndex([
                'user_id',
                'status'
            ]);
        });
    }
};
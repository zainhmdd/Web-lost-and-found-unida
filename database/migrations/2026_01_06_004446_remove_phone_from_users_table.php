<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom phone (tidak dipakai lagi)
            if (Schema::hasColumn('users', 'phone')) {
                $table->dropColumn('phone');
            }
            
            // Pastikan telegram_username ada dan required
            if (!Schema::hasColumn('users', 'telegram_username')) {
                $table->string('telegram_username')->after('nim');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan phone kalau rollback
            $table->string('phone')->nullable()->after('nim');
        });
    }
};
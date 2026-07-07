<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('antrians', 'klinik')) {
            Schema::table('antrians', function (Blueprint $table) {
                $table->string('klinik')->after('id')->nullable();
            });
        }
        
        if (!Schema::hasColumn('pendaftarans', 'jenis_pendaftaran')) {
            Schema::table('pendaftarans', function (Blueprint $table) {
                $table->string('jenis_pendaftaran')->after('pasien_id')->nullable();
            });
        }
    }

    public function down(): void
    {
        // No rollback needed for this fix
    }
};

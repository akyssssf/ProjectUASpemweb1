<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom BPJS yang selama ini silent fail karena belum ada di tabel.
     * no_bpjs, faskes_asal, jenis_rujukan semuanya nullable supaya
     * pendaftaran umum (non-BPJS) tidak terpengaruh.
     */
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('no_bpjs', 13)->nullable()->after('pasien_id');
            $table->string('faskes_asal')->nullable()->after('no_bpjs');
            $table->string('jenis_rujukan')->nullable()->after('faskes_asal');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn(['no_bpjs', 'faskes_asal', 'jenis_rujukan']);
        });
    }
};

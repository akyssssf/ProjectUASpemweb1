<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Redesign tabel surveys agar bisa menyimpan 2 jenis survei:
     *
     * 1. Survei spesifik: terikat ke pendaftaran (kunjungan) tertentu yang
     *    statusnya sudah 'selesai'. Otomatis tahu klinik & poli dari
     *    pendaftaran terkait. Wajib login sebagai pasien.
     *
     * 2. Survei umum: rating bebas untuk sebuah klinik/RS secara keseluruhan,
     *    tanpa perlu pernah berkunjung. Bisa diisi siapa saja (publik),
     *    makanya pasien_id nullable.
     *
     * Tabel lama (user_id, rating, komentar) di-drop karena terikat ke
     * model User/Sanctum yang terpisah dari alur Pasien di sistem web ini.
     */
    public function up(): void
    {
        Schema::dropIfExists('surveys');

        Schema::create('surveys', function (Blueprint $table) {
            $table->id();

            // Nullable: survei umum boleh diisi tanpa login
            $table->foreignId('pasien_id')->nullable()->constrained('pasiens')->onDelete('cascade');

            // Selalu wajib: setiap survei pasti menilai 1 klinik/RS
            $table->foreignId('klinik_id')->constrained('kliniks')->onDelete('cascade');

            // Nullable: hanya diisi untuk survei spesifik per kunjungan
            $table->foreignId('poli_id')->nullable()->constrained('polis')->onDelete('cascade');

            // Nullable: hanya diisi untuk survei spesifik, satu kunjungan
            // hanya boleh disurvei sekali (unique di bawah)
            $table->foreignId('pendaftaran_id')->nullable()->constrained('pendaftarans')->onDelete('cascade');

            $table->enum('tipe', ['umum', 'spesifik']);
            $table->unsignedTinyInteger('rating'); // 1-5
            $table->text('komentar')->nullable();
            $table->timestamps();

            $table->unique('pendaftaran_id'); // satu kunjungan = satu survei
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};

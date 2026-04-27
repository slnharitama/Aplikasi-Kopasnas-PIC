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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('tb_anggota')->onDelete('cascade');
            $table->foreignId('opsi_id')->constrained('tb_opsi_voting')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['anggota_id', 'opsi_id']); // biar ga double vote
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};

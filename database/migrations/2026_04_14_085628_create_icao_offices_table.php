<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('icao_offices', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama pejabat
            $table->string('position'); // jabatan
            $table->string('photo')->nullable(); // foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('icao_offices');
    }
};

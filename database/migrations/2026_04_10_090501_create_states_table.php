<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('state_name');
            $table->string('capital_city')->nullable();
            $table->string('icao_region')->nullable();
            $table->string('icao_regional_office')->nullable();
            $table->string('rep_in_council')->nullable();
            $table->float('vote_probability_indonesia')->nullable();
            $table->integer('council_part')->nullable();
            $table->string('posisi_2016')->nullable();
            $table->string('posisi_2013')->nullable();
            
            // Parsed general info fields
            $table->text('informasi_umum')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('dialing_code')->nullable();
            $table->string('currency')->nullable();
            $table->string('population')->nullable();
            $table->string('leader')->nullable();
            $table->string('official_languages')->nullable();
            $table->text('points_of_interest')->nullable();
            $table->string('university')->nullable();
            $table->json('additional_info')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};

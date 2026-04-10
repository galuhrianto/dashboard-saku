<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('states', function (Blueprint $table) {
            $table->string('vote_probability_indonesia')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('states', function (Blueprint $table) {
            $table->double('vote_probability_indonesia')->nullable()->change();
        });
    }
};

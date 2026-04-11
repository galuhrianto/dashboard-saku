<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('states', function (Blueprint $table) {
            $table->enum('dctp_status', [
                'Sudah Menerima',
                'Penerima Potensial',
                'Prioritas Penerima Dewan ICAO',
                'Kompetitor',
                'Belum Menerima',
            ])->nullable()->after('council_part');
        });
    }

    public function down()
    {
        Schema::table('states', function (Blueprint $table) {
            $table->dropColumn('dctp_status');
        });
    }
};

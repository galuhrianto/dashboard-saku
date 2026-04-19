<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kerjasamas', function (Blueprint $table) {
            $table->string('type_kerjasama')->nullable()->after('id');
            $table->string('mou')->nullable()->after('type_kerjasama');
             $table->string('status_penerimaan')->nullable()->after('deskripsi');
        });
    }

    public function down(): void
    {
        Schema::table('kerjasamas', function (Blueprint $table) {
            $table->dropColumn(['type_kerjasama', 'mou', 'status_penerimaan']);
        });
    }
};
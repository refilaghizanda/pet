<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->string('code_pesanan', 20)->nullable()->after('id');
        });

        // Update existing records with temporary codes
        DB::table('pesanans')->get()->each(function ($pesanan) {
            DB::table('pesanans')
                ->where('id', $pesanan->id)
                ->update(['code_pesanan' => 'PS-' . date('Ymd') . '-' . str_pad($pesanan->id, 4, '0', STR_PAD_LEFT)]);
        });

        // Make it unique after populating
        Schema::table('pesanans', function (Blueprint $table) {
            $table->string('code_pesanan', 20)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('code_pesanan');
        });
    }
};

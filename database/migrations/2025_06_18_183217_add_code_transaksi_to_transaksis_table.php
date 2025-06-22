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
        Schema::table('transaksis', function (Blueprint $table) {
            $table->string('code_transaksi', 20)->nullable()->after('id');
        });

        // Update existing records with temporary codes
        DB::table('transaksis')->get()->each(function ($transaksi) {
            DB::table('transaksis')
                ->where('id', $transaksi->id)
                ->update(['code_transaksi' => 'TRX-' . date('Ymd') . '-' . str_pad($transaksi->id, 4, '0', STR_PAD_LEFT)]);
        });

        // Make it unique after populating
        Schema::table('transaksis', function (Blueprint $table) {
            $table->string('code_transaksi', 20)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn('code_transaksi');
        });
    }
};

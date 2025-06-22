<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'id_pesanan', 'metode_pembayaran', 'jumlah_bayar', 'bukti_transfer'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($transaksi) {
            $date = date('Ymd');
            $count = self::whereDate('created_at', now()->toDateString())->count() + 1;
            $transaksi->code_transaksi = 'TRX-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        });
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}

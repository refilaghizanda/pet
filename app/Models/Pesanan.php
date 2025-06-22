<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'id_user', 'id_hewan', 'id_layanan', 'tanggal_layanan', 'tanggal_mulai', 'tanggal_kembali', 'status_pembayaran', 'status_pesanan', 'catatan'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($pesanan) {
            $date = date('Ymd');
            $count = self::whereDate('created_at', now()->toDateString())->count() + 1;
            $pesanan->code_pesanan = 'PS-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function hewan()
    {
        return $this->belongsTo(Hewan::class, 'id_hewan');
    }
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }
    public function transaksi()
    {
        return $this->hasOne(\App\Models\Transaksi::class, 'id_pesanan');
    }
}

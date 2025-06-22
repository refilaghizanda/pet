<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    protected $fillable = [
        'id_user', 'nama', 'jenis', 'umur', 'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_sesi', 'total_opening', 'total_pos', 'total_kasir', 'opening_next_day', 'selisih', 'setoran'
    ];

    public function transaksis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaksi::class);
    }
}

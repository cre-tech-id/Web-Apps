<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananKesenian extends Model
{
    use HasFactory;
    protected $table = 'pemesanan_kesenian';
    protected $fillable = [
        'pemesan_id',
        'kesenian_id',
        'lokasi',
        'tanggal_book',
        'status',
        'pembayaran',
    ];
}

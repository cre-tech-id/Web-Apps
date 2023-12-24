<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananKarya extends Model
{
    use HasFactory;
    protected $table = 'pemesanan_karya';
    protected $fillable = [
        'pemesan_id',
        'karya_id',
        'alamat',
        'jumlah',
        'tanggal_pemesanan',
        'total_harga',
        'status',
        'pembayaran',
        'resi',
    ];
}

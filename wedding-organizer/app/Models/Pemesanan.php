<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan';
    protected $fillable = [
        'pemesan_id',
        'paket_id',
        'lokasi',
        'tanggal_book',
        'status',
        'harga_paket',
        'pembayaran',
        'selesai',
    ];
}

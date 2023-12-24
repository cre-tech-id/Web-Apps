<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'paket';
    protected $fillable = [
        'nama_paket',
        'penyedia_id',
        'detail',
        'harga',
        'min_dp',
        'gambar',
        'status',
    ];
}

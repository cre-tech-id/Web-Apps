<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Karya extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'karya';
    protected $fillable = [
        'nama_karya',
        'id_seniman',
        'deskripsi',
        'kategori',
        'harga',
        'stok',
        'foto',
    ];

}
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Kesenian extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'kesenian';
    protected $fillable = [
        'nama_kesenian',
        'id_seniman',
        'deskripsi',
        'kategori',
        'harga',
        'foto',
    ];

}
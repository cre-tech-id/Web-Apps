<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $fillable = [
        'users_id',
        'penyedia_id',
        'paket_id',
        'komentar',
    ];

}

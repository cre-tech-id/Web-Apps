<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'rating';
    protected $fillable = [
        'users_id',
        'penyedia_id',
        'rating',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}

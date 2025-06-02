<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Jika nama tabel bukan "users", tentukan secara eksplisit
    protected $table = 'user';

    /**
     * Atribut yang dapat diisi massal
     */
    protected $fillable = [
        'nama',
        'email',
        'role',
        'status',
        'password',
        'hp',
        'foto',
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe casting untuk atribut
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi: Satu User memiliki satu Customer
     */
    public function customer()
{
    return $this->hasOne(Customer::class);
}


}

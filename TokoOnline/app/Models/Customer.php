<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer'; // atau 'customers' jika mengikuti konvensi Laravel

    protected $fillable = [
        'user_id',
        'alamat',
        'pos',
        'foto',
        'google_id',
        'google_token',
        // tambahkan kolom lain sesuai kebutuhan
    ];

    /**
     * Relasi ke User
     */
// Customer.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($customer) {
            if ($customer->user) {
                $customer->user->delete();
            }
        });
    }
}

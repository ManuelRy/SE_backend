<?php




namespace App\Models;

// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'user_type',
        'receiver_phone_number',
        'sender_phone_number',
        'locker_pin',
    ];

    public function lockers()
    {
        return $this->hasMany(Locker::class);
    }
}

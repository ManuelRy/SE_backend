<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryUser extends Model
{
    use HasFactory;

    protected $table = 'delivery_users';
    protected $fillable = ['sender','receiver', 'user_type', 'package_size', 'locker_number'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryUser extends Model
{
    use HasFactory;

    protected $fillable = ['receiver', 'user_type', 'package_size', 'pin_code', 'locker_number'];
}

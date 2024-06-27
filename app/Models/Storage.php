<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageUser extends Model
{
    use HasFactory;

    protected $fillable = ['user', 'user_type', 'package_size', 'locker_pin', 'locker_number'];
}

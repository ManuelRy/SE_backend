<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageUser extends Model
{
    use HasFactory;

    protected $table = 'storage_users';
    protected $fillable = ['user', 'user_type', 'package_size', 'locker_number'];
}

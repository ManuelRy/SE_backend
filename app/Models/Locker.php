<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Locker extends Model
{
    use HasFactory;

    protected $table = 'lockers';
    protected $fillable = [
        'locker_number',
        'size',
        'status',
        'pin',
    ];

}

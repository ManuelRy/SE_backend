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
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($locker) {
    //         $locker->pin = Hash::make($locker->pin);
    //     });

    //     static::updating(function ($locker) {
    //         if ($locker->isDirty('pin')) {
    //             $locker->pin = Hash::make($locker->pin);
    //         }
    //     });
    // }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;

    protected $table = 'pin';

    protected $fillable = ['pin_code', 'is_used', 'receiver_id', 'storage_id'];

    public function receiver()
    {
        return $this->belongsTo(DeliveryUser::class, 'receiver_id');
    }

    public function storage()
    {
        return $this->belongsTo(StorageUser::class, 'storage_id');
    }
}

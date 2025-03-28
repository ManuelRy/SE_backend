<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LockerController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->query('size');

        $lockers = Locker::with(['pin.receiver', 'pin.storage'])
            ->when($size, function ($query) use ($size) {
                return $query->where('size', $size);
            })
            ->get()
            ->map(function ($locker) {
                if ($locker->status == 'Rented') {
                    if ($locker->pin->receiver) {
                        $locker->user_type = 'Delivery';
                        $locker->phone_number = $locker->pin->receiver->receiver;
                    } elseif ($locker->pin->storage) {
                        $locker->user_type = 'Storage';
                        $locker->phone_number = $locker->pin->storage->user;
                    }
                }
                return $locker;
            });

        return view('lockers.index', compact('lockers'));
    }
}

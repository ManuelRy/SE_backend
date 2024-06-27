<?php

namespace App\Http\Controllers;

use App\Models\DeliveryUser;
use App\Models\StorageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // public function index()
    // {
    //     $deliveryUsers = DeliveryUser::all();
    //     $storageUsers = StorageUser::all();

    //     return view('user.index', compact('deliveryUsers', 'storageUsers'));
    // }
    public function index()
    {
        $deliveryUsers = DB::table('delivery_users')
            ->leftJoin('pin', 'delivery_users.id', '=', 'pin.receiver_id')
            ->select('delivery_users.*', 'pin.pin_code')
            ->get();

        $storageUsers = DB::table('storage_users')
            ->leftJoin('pin', 'storage_users.id', '=', 'pin.storage_id')
            ->select('storage_users.*', 'pin.pin_code as locker_pin')
            ->get();

        return view('users.index', compact('deliveryUsers', 'storageUsers'));
    }
}

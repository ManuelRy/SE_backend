<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $section = $request->input('section', 'delivery');

        $deliveryUsers = DB::table('delivery_users')
            ->leftJoin('pin', 'delivery_users.id', '=', 'pin.receiver_id')
            ->select('delivery_users.*', 'pin.pin_code')
            ->orderBy('delivery_users.created_at', 'desc');

        $storageUsers = DB::table('storage_users')
            ->leftJoin('pin', 'storage_users.id', '=', 'pin.storage_id')
            ->select('storage_users.*', 'pin.pin_code as locker_pin')
            ->orderBy('storage_users.created_at', 'desc');

        if ($query) {
            $deliveryUsers->where('delivery_users.receiver', 'like', "%{$query}%");
            $storageUsers->where('storage_users.user', 'like', "%{$query}%");
        }

        $deliveryUsers = $deliveryUsers->paginate(1, ['*'], 'page_delivery');
        $storageUsers = $storageUsers->paginate(1, ['*'], 'page_storage');

        return view('users.index', compact('deliveryUsers', 'storageUsers', 'query', 'section'));
    }
}

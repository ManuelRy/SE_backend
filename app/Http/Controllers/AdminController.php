<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryUser;
use App\Models\StorageUser;

class AdminController extends Controller
{
    public function dashboard()
    {
        $deliveryUserCount = DeliveryUser::count();
        $storageUserCount = StorageUser::count();

        return view('admin.dashboard', compact('deliveryUserCount', 'storageUserCount'));
    }
}

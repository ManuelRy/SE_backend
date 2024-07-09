<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DeliveryUser;
use App\Models\StorageUser;
use App\Models\Locker;

class AdminController extends Controller
{
    public function dashboard()
    {
        $deliveryUserCount = DeliveryUser::count();
        $storageUserCount = StorageUser::count();
        $totalUserCount = $deliveryUserCount + $storageUserCount;
        $totalLockerCount = Locker::count();

        return view('admin.dashboard', compact('totalUserCount', 'totalLockerCount', 'deliveryUserCount', 'storageUserCount'));
    }
    public function verifyPassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if (Hash::check($request->password, $admin->password)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}

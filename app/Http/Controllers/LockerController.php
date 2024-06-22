<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LockerController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->input('size');
        if ($size) {
            $lockers = Locker::where('size', $size)->get();
        } else {
            $lockers = Locker::all();
        }
        return view('lockers.index', compact('lockers'));
    }

    public function create()
    {
        return view('lockers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'locker_number' => 'required|integer|unique:lockers',
            'size' => 'required|string|in:Small,Medium,Large',
            'status' => 'required|string|in:Free,Rented',
            'user_id' => 'nullable|exists:users,id',
            'pin' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['pin'] = Hash::make($request->input('pin'));

        Locker::create($data);

        return redirect()->route('lockers.index')
                         ->with('success', 'Locker created successfully.');
    }

    public function show(Locker $locker)
    {
        return view('lockers.show', compact('locker'));
    }

    public function edit(Locker $locker)
    {
        return view('lockers.edit', compact('locker'));
    }

    public function update(Request $request, Locker $locker)
    {
        $request->validate([
            'locker_number' => 'required|integer|unique:lockers,locker_number,' . $locker->id,
            'size' => 'required|string|in:Small,Medium,Large',
            'status' => 'required|string|in:Free,Rented',
            'user_id' => 'nullable|exists:users,id',
            'pin' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        if ($request->filled('pin')) {
            $data['pin'] = Hash::make($request->input('pin'));
        }

        $locker->update($data);

        return redirect()->route('lockers.index')
                         ->with('success', 'Locker updated successfully.');
    }

    public function destroy(Locker $locker)
    {
        $locker->delete();

        return redirect()->route('lockers.index')
                         ->with('success', 'Locker deleted successfully.');
    }
}

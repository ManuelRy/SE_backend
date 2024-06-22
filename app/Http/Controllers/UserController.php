<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Display a listing of the users, with optional filtering by user_type.
    public function index(Request $request)
    {
        $userType = $request->get('user_type');
        if ($userType) {
            $users = User::with('lockers')->where('user_type', $userType)->get();
        } else {
            $users = User::with('lockers')->get();
        }

        return view('users.index', compact('users'));
    }

    // Show the form for creating a new user.
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created user in the database.
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15|unique:users',
            'user_type' => 'required|string|in:delivery,storage', // Ensure user_type is valid
        ]);

        User::create($request->all());

        return redirect()->route('users.index')
                         ->with('success', 'User created successfully.');
    }

    // Display the specified user.
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show the form for editing the specified user.
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update the specified user in the database.
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15|unique:users,phone_number,' . $user->id,
            'user_type' => 'required|string|in:delivery,storage', // Ensure user_type is valid
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')
                         ->with('success', 'User updated successfully.');
    }

    // Remove the specified user from the database.
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'User deleted successfully.');
    }
}

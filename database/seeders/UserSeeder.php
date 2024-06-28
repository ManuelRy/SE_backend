<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Delivery users
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => '1234567890',
            'user_type' => 'delivery',
            'receiver_phone_number' => '0987654321',
            'sender_phone_number' => '1122334455',
        ]);

        User::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'phone_number' => '1234567891',
            'user_type' => 'delivery',
            'receiver_phone_number' => '2233445566',
            'sender_phone_number' => '6677889900',
        ]);

        // Storage users
        User::create([
            'first_name' => 'Alice',
            'last_name' => 'Smith',
            'phone_number' => '9876543210',
            'user_type' => 'storage',
            'locker_pin' => '1234',
        ]);

        User::create([
            'first_name' => 'Bob',
            'last_name' => 'Smith',
            'phone_number' => '9876543211',
            'user_type' => 'storage',
            'locker_pin' => '5678',
        ]);

        // Additional users from factory
        User::factory()->count(10)->create();
    }
}





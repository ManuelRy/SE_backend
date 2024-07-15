<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryUser;

class DeliveryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryUser::create([
            'receiver' => '012345678',
            'user_type' => 'Delivery',
            'package_size' => 'Small',
            'locker_number' => 101,
        ]);

        DeliveryUser::create([
            'receiver' => '098765432',
            'user_type' => 'Delivery',
            'package_size' => 'Medium',
            'locker_number' => 101,
        ]);
    }
}

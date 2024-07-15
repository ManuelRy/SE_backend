<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call([
            // UserSeeder::class, // Ensure this creates users with IDs 1, 2, 3, etc.
            DeliveryUserSeeder::class,
            StorageUserSeeder::class,
            PINSeeder::class,
            LockerSeeder::class,
        ]);
    }
}

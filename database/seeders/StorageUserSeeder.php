<?php

namespace Database\Seeders;

use App\Models\StorageUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorageUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StorageUser::create([
            'user' => '098745637',
            'user_type' => 'Storage',
            'storage_size' => 'Large',
            'locker_number' => 'L-01',
        ]);
    }
}

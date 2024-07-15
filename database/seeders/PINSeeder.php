<?php

namespace Database\Seeders;

use App\Models\Pin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\NullOutput;

class PINSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pin::create([
            'pin_code' => 234164,
            'is_used' => 0,
            'receiver_id' => 1,
            'storage_id' => NULL,
        ]);
        Pin::create([
            'pin_code' => 129628,
            'is_used' => 0,
            'receiver_id' => 2,
            'storage_id' => NULL,
        ]);
        Pin::create([
            'pin_code' => 252645,
            'is_used' => 0,
            'receiver_id' => NULL,
            'storage_id' => 1,
        ]);
    }
}

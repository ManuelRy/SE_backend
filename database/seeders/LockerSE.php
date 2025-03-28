<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Locker;

class LockerSE extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lockers = [
            [
                'locker_number' => 'M-01',
                'size' => 'Medium',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'M-02',
                'size' => 'Medium',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
        ];
        foreach ($lockers as $locker) {
            Locker::create($locker);
        }
    }
}

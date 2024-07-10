<?php

// database/seeders/LockerSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Locker;

class LockerSeeder extends Seeder
{
    public function run()
    {
        $lockers = [
            [
                'locker_number' => 'S-01',
                'size' => 'Small',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'S-02',
                'size' => 'Small',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'S-03',
                'size' => 'Small',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
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
            [
                'locker_number' => 'L-01',
                'size' => 'Large',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'L-02',
                'size' => 'Large',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'L-03',
                'size' => 'Large',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
        ];

        foreach ($lockers as $locker) {
            Locker::create($locker);
        }
    }
}

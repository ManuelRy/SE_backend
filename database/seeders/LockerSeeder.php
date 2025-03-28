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
            // [
            //     'locker_number' => 'S-02',
            //     'size' => 'Small',
            //     'status' => 'Free',
            //     'pin_id' => NULL,
            // ],
            [
                'locker_number' => 'S-03',
                'size' => 'Small',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'S-04',
                'size' => 'Small',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'S-05',
                'size' => 'Small',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'S-06',
                'size' => 'Small',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'M-07',
                'size' => 'Medium',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'M-08',
                'size' => 'Medium',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'M-09',
                'size' => 'Medium',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'M-10',
                'size' => 'Medium',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'M-11',
                'size' => 'Medium',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'M-12',
                'size' => 'Medium',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'M-13',
                'size' => 'Medium',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'M-14',
                'size' => 'Medium',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'M-15',
                'size' => 'Medium',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'L-16',
                'size' => 'Large',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'L-17',
                'size' => 'Large',
                'status' => 'Free',
                'pin_id' => NULL,
            ],
            [
                'locker_number' => 'L-18',
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

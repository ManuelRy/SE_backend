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
                'locker_number' => 106,
                'size' => 'Small',
                'status' => 'Rented',
                'user_id' => 1,
                'pin' => '23635',
            ],
            [
                'locker_number' => 107,
                'size' => 'Medium',
                'status' => 'Rented',
                'user_id' => 2,
                'pin' => '34746',
            ],
            [
                'locker_number' => 108,
                'size' => 'Large',
                'status' => 'Free',
                'user_id' => 3,
                'pin' => '45857',
            ],
            [
                'locker_number' => 109,
                'size' => 'Small',
                'status' => 'Free',
                'user_id' => 4,
                'pin' => '56968',
            ],
            [
                'locker_number' => 110,
                'size' => 'Medium',
                'status' => 'Rented',
                'user_id' => 5,
                'pin' => '67879',
            ],
        ];

        foreach ($lockers as $locker) {
            Locker::create($locker);
        }
    }
}

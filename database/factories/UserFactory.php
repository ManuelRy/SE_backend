<?php
// database/factories/UserFactory.php

// database/factories/UserFactory.php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $userType = $this->faker->randomElement(['delivery', 'storage']);

        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone_number' => $this->faker->unique()->phoneNumber,
            'user_type' => $userType,
        ];

        if ($userType === 'delivery') {
            $data['receiver_phone_number'] = $this->faker->unique()->phoneNumber;
            $data['sender_phone_number'] = $this->faker->unique()->phoneNumber;
        } else {
            $data['locker_pin'] = $this->faker->numberBetween(1000, 9999);
        }

        return $data;
    }
}


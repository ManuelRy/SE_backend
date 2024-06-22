<?php
namespace Database\Factories;

use App\Models\Locker;
use Illuminate\Database\Eloquent\Factories\Factory;

class LockerFactory extends Factory
{
    protected $model = Locker::class;

    public function definition()
    {
        return [
            'locker_number' => $this->faker->unique()->numberBetween(100, 999),
            'size' => $this->faker->randomElement(['Small', 'Medium', 'Large']),
            'status' => $this->faker->randomElement(['Free', 'Rented']),
            'user_id' => null,
            'pin' => $this->faker->numerify('####'),
        ];
    }
}

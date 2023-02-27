<?php

namespace Database\Factories;

use App\Models\Singer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Singer>
 */
class SingerFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}

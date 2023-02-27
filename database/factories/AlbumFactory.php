<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Singer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Album>
 */
class AlbumFactory extends Factory
{
    public function definition(): array
    {
        return [
            'singer_id' => Singer::query()->inRandomOrder()->value('id'),
            'name' => ucfirst($this->faker->words(2, true)),
            'year' => $this->faker->numberBetween(1980, now()->year),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Singer;
use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Song>
 */
class SongFactory extends Factory
{
    public function definition(): array
    {
        return [
            'singer_id' => Singer::query()->inRandomOrder()->value('id'),
            'name' => ucfirst($this->faker->words(3, true)),
        ];
    }
}

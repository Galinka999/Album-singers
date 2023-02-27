<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\AlbumSong;
use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AlbumSong>
 */
class AlbumSongFactory extends Factory
{
    public function definition(): array
    {
        return [
            'album_id' => Album::query()->inRandomOrder()->value('id'),
            'song_id' => Song::query()->inRandomOrder()->value('id'),
            'place' => $this->faker->numberBetween(1,100),
        ];
    }
}

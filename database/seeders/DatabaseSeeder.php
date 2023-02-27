<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\AlbumSong;
use App\Models\Singer;
use App\Models\Song;
use Database\Factories\AlbumSongFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Singer::factory(5)->create();

        $singer = Singer::query()->inRandomOrder()->value('id');

        $albumOne = Album::factory(1)
            ->create([
                'singer_id' => $singer,
            ]);

        $albumTwo = Album::factory(1)
            ->create([
                'singer_id' => $singer,
            ]);

        Song::factory(5)
            ->create([
                'singer_id' => $albumOne[0]->singer_id,
            ]);

        for( $i = 1; $i < 6; $i++ ) {
            AlbumSongFactory::new([
                'song_id' => Song::query()->select('id')->find($i)->id,
                'place' => $i,
            ])
                ->sequence(
                    ['album_id' => $albumOne[0]->id,],
                    ['album_id' => $albumTwo[0]->id,]
                )
                ->count(2)->create();
        }

    }
}

<?php

use App\Models\Album;
use App\Models\Song;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('album_song', function (Blueprint $table) {
            $table->foreignIdFor(Album::class)->constrained();
            $table->foreignIdFor(Song::class)->constrained();
            $table->unsignedInteger('place');
            $table->timestamps();

            $table->primary(['album_id', 'place']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('album_song');
    }
};

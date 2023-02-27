<?php

namespace App\Providers;

use App\Http\Resources\AlbumResource;
use App\Http\Resources\SingerResource;
use App\Http\Resources\SongResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        SingerResource::withoutWrapping();
        AlbumResource::withoutWrapping();
        SongResource::withoutWrapping();
    }
}

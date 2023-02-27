<?php

use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\SingerController;
use App\Http\Controllers\Api\SongController;
use Illuminate\Support\Facades\Route;


Route::resource('/singers', SingerController::class);

Route::resource('/albums', AlbumController::class);

Route::post('/albums/{album}/attachSongList', [AlbumController::class, 'attachSongList']);

Route::resource('/songs', SongController::class);

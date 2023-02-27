<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SongStoreRequest;
use App\Http\Requests\SongUpdateRequest;
use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::query()->with('singer')->orderBy('id')->get();
        return SongResource::collection($songs);
    }

    public function store(SongStoreRequest $request)
    {
        $song = Song::query()->create($request->validated());

        return new SongResource($song);
    }

    public function show(Song $song)
    {
        return new SongResource($song);
    }

    public function update(SongUpdateRequest $request, Song $song)
    {
        $song->update($request->validated());

        return new SongResource($song);
    }

    public function destroy(Song $song)
    {
        $song->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

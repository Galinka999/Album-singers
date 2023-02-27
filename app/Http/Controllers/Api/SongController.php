<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SongStoreRequest;
use App\Http\Requests\SongUpdateRequest;
use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SongController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $songs = Song::query()->with('singer')->orderBy('id')->get();
        return SongResource::collection($songs);
    }

    public function store(SongStoreRequest $request): SongResource
    {
        $song = Song::query()->create($request->validated());

        return new SongResource($song);
    }

    public function show(Song $song): SongResource
    {
        return new SongResource($song);
    }

    public function update(SongUpdateRequest $request, Song $song): SongResource
    {
        $song->update($request->validated());

        return new SongResource($song);
    }

    public function destroy(Song $song): Response|Application|ResponseFactory
    {
        $song->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

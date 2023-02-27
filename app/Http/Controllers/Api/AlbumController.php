<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlbumAddSongRequest;
use App\Http\Requests\AlbumStoreRequest;
use App\Http\Requests\AlbumUpdateRequest;
use App\Http\Resources\AlbumResource;
use App\Models\Album;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $albums = Album::query()->with('singer')->orderBy('id')->get();
        return AlbumResource::collection($albums);
    }

    public function store(AlbumStoreRequest $request): AlbumResource
    {
        $album = Album::query()->create($request->validated());

        return new AlbumResource($album);
    }

    public function show(Album $album): AlbumResource
    {
        return new AlbumResource($album);
    }

    public function update(AlbumUpdateRequest $request, Album $album): AlbumResource
    {
        $album->update($request->validated());

        return new AlbumResource($album);
    }

    public function destroy(Album $album): Response|Application|ResponseFactory
    {
        $album->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeSongList(AlbumAddSongRequest $request, Album $album)
    {
        DB::transaction(function () use ($album, $request) {
            $album->songs()->detach();
            $album->songs()->attach($request->songs);
        });
    }
}

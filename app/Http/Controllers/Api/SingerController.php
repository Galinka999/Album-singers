<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SingerStoreRequest;
use App\Http\Requests\SingerUpdateRequest;
use App\Http\Resources\SingerResource;
use App\Models\Singer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SingerController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $singers = Singer::query()->orderBy('id')->get();
        return SingerResource::collection($singers);
    }

    public function store(SingerStoreRequest $request): SingerResource
    {
        $singer = Singer::query()->create($request->validated());

        return new SingerResource($singer);
    }

    public function show(Singer $singer): SingerResource
    {
        return new SingerResource($singer);
    }

    public function update(SingerUpdateRequest $request, Singer $singer): SingerResource
    {
        $singer->update($request->validated());

        return new SingerResource($singer);
    }

    public function destroy(Singer $singer): Response|Application|ResponseFactory
    {
        $singer->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

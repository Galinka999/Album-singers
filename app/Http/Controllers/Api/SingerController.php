<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SingerStoreRequest;
use App\Http\Requests\SingerUpdateRequest;
use App\Http\Resources\SingerResource;
use App\Models\Singer;
use Illuminate\Http\Response;

class SingerController extends Controller
{
    public function index()
    {
        $singers = Singer::query()->orderBy('id')->get();
        return SingerResource::collection($singers);
    }

    public function store(SingerStoreRequest $request)
    {
        $singer = Singer::query()->create($request->validated());

        return new SingerResource($singer);
    }

    public function show(Singer $singer)
    {
        return new SingerResource($singer);
    }

    public function update(SingerUpdateRequest $request, Singer $singer)
    {
        $singer->update($request->validated());

        return new SingerResource($singer);
    }

    public function destroy(Singer $singer)
    {
        $singer->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

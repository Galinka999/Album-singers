<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SingerStoreRequest;
use App\Http\Requests\SingerUpdateRequest;
use App\Http\Resources\SingerResource;
use App\Models\Singer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * @OA\Tag(
 *     name="Singers",
 *     description="API for Singers",
 * )
 */
class SingerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/singers",
     *     operationId="singersAll",
     *     tags={"Singers"},
     *     summary="Display a listing of the resource",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     *      @OA\Response(
     *         response="404",
     *         description="Not found",
     *     ),
     * )
     *
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $singers = Singer::query()->orderBy('id')->paginate(10);
        return SingerResource::collection($singers);
    }


    /**
     * @OA\Post(
     *     path="/singers",
     *     operationId="singerCreate",
     *     tags={"Singers"},
     *     summary="Create yet another singer record",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  description="Name of key for storring",
     *                  example="Alex",
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Created siccessful",
     *              @OA\JsonContent(ref="#/components/schemas/SingerShowResource")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Not found",
     *     ),
     * )
     * Store a newly created resource in storage.
     *
     * @param SingerStoreRequest $request
     *
     * @return SingerResource
     */
    public function store(SingerStoreRequest $request): SingerResource
    {
        $singer = Singer::query()->create($request->validated());

        return new SingerResource($singer);
    }

    /**
     * @OA\Get(
     *     path="/singers/{id}",
     *     operationId="singersOne",
     *     tags={"Singers"},
     *     summary="Display a listing of the resource",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of singer",
     *         required=true,
     *         example="5",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/SingerShowResource")
     *     ),
     *      @OA\Response(
     *         response="404",
     *         description="Not found",
     *     ),
     * )
     *
     * Display a listing of the resource.
     *
     * @param Singer $singer
     * @return SingerResource
     */
    public function show(Singer $singer): SingerResource
    {
        return new SingerResource($singer);
    }

    /**
     * @OA\Patch(
     *     path="/singers/{id}",
     *     operationId="singerUpdate",
     *     tags={"Singers"},
     *     summary="Update yet another singer record",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of singer",
     *         required=true,
     *         example="5",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  description="Name of key for storring",
     *                  example="Alex",
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Created siccessful",
     *              @OA\JsonContent(ref="#/components/schemas/SingerShowResource")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Not found",
     *     ),
     * )
     * Store a newly updated resource in storage.
     *
     * @param SingerUpdateRequest $request
     * @param Singer $singer
     * @return SingerResource
     */
    public function update(SingerUpdateRequest $request, Singer $singer): SingerResource
    {
        $singer->update($request->validated());

        return new SingerResource($singer);
    }

    /**
     * @OA\Delete(
     *     path="/singers/{id}",
     *     operationId="singersDelete",
     *     tags={"Singers"},
     *     summary="Delete singer by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of singer",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Deleted successful",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param Singer $singer
     * @return Response|Application|ResponseFactory
     */
    public function destroy(Singer $singer): Response|Application|ResponseFactory
    {
        $singer->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

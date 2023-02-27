<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SongStoreRequest;
use App\Http\Requests\SongUpdateRequest;
use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * @OA\Tag(
 *     name="Songs",
 *     description="API for Songs",
 * )
 */
class SongController extends Controller
{
    /**
     * @OA\Get(
     *     path="/songs",
     *     operationId="songsAll",
     *     tags={"Songs"},
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
     *     @OA\Response(
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
        $songs = Song::query()->with('singer')->orderBy('id')->paginate(10);
        return SongResource::collection($songs);
    }

    /**
     * @OA\Post(
     *     path="/songs",
     *     operationId="songCreate",
     *     tags={"Songs"},
     *     summary="Create yet another song record",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  description="Name of key for storring",
     *                  example="Example",
     *              ),
     *              @OA\Property(
     *                  property="singer_id",
     *                  type="integer",
     *                  description="Name of key for storring",
     *                  example="5",
     *              ),
     *          )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Created siccessful",
     *                  @OA\JsonContent(
     *                      @OA\Property(
     *                          property="id",
     *                          type="integer",
     *                          example="1",
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string",
     *                          description="Name of key for storring",
     *                          example="Name of Song",
     *                      ),
     *                      @OA\Property(
     *                          property="singer",
     *                          type="array",
     *                          @OA\Items(ref="#/components/schemas/SingerShowResource")
     *                      )
     *                  ),
     *      ),
     *     @OA\Response(
     *         response="404",
     *         description="Not found",
     *     ),
     * )
     * Store a newly created resource in storage.
     *
     * @param SongStoreRequest $request
     *
     * @return SongResource
     */
    public function store(SongStoreRequest $request): SongResource
    {
        $song = Song::query()->create($request->validated());

        return new SongResource($song);
    }

    public function show(Song $song): SongResource
    {
        return new SongResource($song);
    }

    /**
     * @OA\Patch(
     *     path="/songs/{id}",
     *     operationId="songUpdate",
     *     tags={"Songs"},
     *     summary="Update yet another song record",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of song",
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
     *                  example="Name of song",
     *              ),
     *              @OA\Property(
     *                  property="singer_id",
     *                  type="integer",
     *                  description="Name of key for storring",
     *                  example="5",
     *              ),
     *          )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Created siccessful",
     *                  @OA\JsonContent(
     *                      @OA\Property(
     *                          property="id",
     *                          type="integer",
     *                          example="1",
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string",
     *                          description="Name of key for storring",
     *                          example="Name of Song",
     *                      ),
     *                      @OA\Property(
     *                          property="singer",
     *                          type="array",
     *                          @OA\Items(ref="#/components/schemas/SingerShowResource")
     *                      )
     *                  ),
     *      ),
     *     @OA\Response(
     *         response="404",
     *         description="Not found",
     *     ),
     * )
     * Store a newly updated resource in storage.
     *
     * @param SongUpdateRequest $request
     * @param Song $song
     * @return SongResource
     */
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

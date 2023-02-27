<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AlbumAddSongRequest;
use App\Http\Requests\AlbumStoreRequest;
use App\Http\Requests\AlbumUpdateRequest;
use App\Http\Resources\AlbumResource;
use App\Models\Album;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Tag(
 *     name="Albums",
 *     description="API for Albums",
 * )
 */
class AlbumController extends Controller
{
    /**
     * @OA\Get(
     *     path="/albums",
     *     operationId="albumsAll",
     *     tags={"Albums"},
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
        $albums = Album::query()->with('singer')->orderBy('id')->paginate(10);
        return AlbumResource::collection($albums);
    }

    /**
     * @OA\Post(
     *     path="/albums",
     *     operationId="albumCreate",
     *     tags={"Albums"},
     *     summary="Create yet another album record",
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
     *              @OA\Property(
     *                  property="year",
     *                  type="integer",
     *                  description="Name of key for storring",
     *                  example="2022",
     *              )
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
     *                          example="Example",
     *                      ),
     *                      @OA\Property(
     *                          property="singer",
     *                          type="array",
     *                          @OA\Items(ref="#/components/schemas/SingerShowResource")
     *                      ),
     *                      @OA\Property(
     *                          property="year",
     *                          type="integer",
     *                          description="Name of key for storring",
     *                          example="2022",
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
     * @param AlbumStoreRequest $request
     *
     * @return AlbumResource
     */
    public function store(AlbumStoreRequest $request): AlbumResource
    {
        $album = Album::query()->create($request->validated());

        return new AlbumResource($album);
    }

    /**
     * @OA\Get(
     *     path="/albums/{id}",
     *     operationId="albumsOne",
     *     tags={"Albums"},
     *     summary="Display a listing of the resource",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of album",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *      @OA\Response(
     *         response="200",
     *         description="Siccessful",
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
     *                          example="Example",
     *                      ),
     *                      @OA\Property(
     *                          property="singer",
     *                          type="array",
     *                          @OA\Items(ref="#/components/schemas/SingerShowResource")
     *                      ),
     *                      @OA\Property(
     *                          property="year",
     *                          type="integer",
     *                          description="Name of key for storring",
     *                          example="2022",
     *                      )
     *                  ),
     *      ),
     * )
     *
     * Display a listing of the resource.
     *
     * @param Album $album
     * @return AlbumResource
     */
    public function show(Album $album): AlbumResource
    {
        return new AlbumResource($album);
    }

    /**
     * @OA\Patch (
     *     path="/albums/{id}",
     *     operationId="albumUpdate",
     *     tags={"Albums"},
     *     summary="Update yet another album record",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of album",
     *         required=true,
     *         example="2",
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
     *                  example="Example",
     *              ),
     *              @OA\Property(
     *                  property="singer_id",
     *                  type="integer",
     *                  description="Name of key for storring",
     *                  example="5",
     *              ),
     *              @OA\Property(
     *                  property="year",
     *                  type="integer",
     *                  description="Name of key for storring",
     *                  example="2022",
     *              )
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
     *                          example="Example",
     *                      ),
     *                      @OA\Property(
     *                          property="singer",
     *                          type="array",
     *                          @OA\Items(ref="#/components/schemas/SingerShowResource")
     *                      ),
     *                      @OA\Property(
     *                          property="year",
     *                          type="integer",
     *                          description="Name of key for storring",
     *                          example="2022",
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
     * @param AlbumUpdateRequest $request
     * @param Album $album
     * @return AlbumResource
     */
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

    public function storeSongList(AlbumAddSongRequest $request, Album $album): JsonResponse
    {
        try {

            DB::transaction(function () use ($album, $request) {
                $album->songs()->detach();
                $album->songs()->attach($request->songs);
            });

            return response()->json(['success' => true]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}

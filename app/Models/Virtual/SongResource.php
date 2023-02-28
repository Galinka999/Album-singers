<?php

namespace App\Models\Virtual;
/**
 * @OA\Schema(
 *     description="Model song",
 *     type="object",
 *     title="Model song",
 * )
 */

class SongResource
{
 /**
  * @OA\Property(
  *      property="id",
  *      type="integer",
  *      example="1",
  *)
  * @var integer
  */
 public $id;

 /**
  * @OA\Property(
  *     property="name",
  *     type="string",
  *     description="The name",
  *     example="One song"
  * )
  *
  * @var string
  */
 public $name;

 /**
  * @OA\Property(
  *      property="singer",
  *      @OA\Schema(ref="#/components/schemas/SingerShowResource")
  *)
  * @var SingerShowResource
  */
 public $singer;
}

<?php

namespace App\Http\Resources\Virtual;
/**
 * @OA\Schema(
 *     description="Some simple request createa as example",
 *     type="object",
 *     title="Singer model",
 * )
 */

class SingerShowResource
{
 /**
  * @OA\Property(
  *      property="id",
  *      type="integer",
  *      example="5",
  *)
  * @var integer
  */
 public $id;

 /**
  * @OA\Property(
  *     property="name",
  *     type="string",
  *     description="The name",
  *     example="Alex"
  * )
  *
  * @var string
  */
 public $name;
}

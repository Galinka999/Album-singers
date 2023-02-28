<?php

namespace App\Models\Virtual;
/**
 * @OA\Schema(
 *     description="Short model Song",
 *     type="object",
 *     title="Short model Song",
 * )
 */

class SongShortResource
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
}

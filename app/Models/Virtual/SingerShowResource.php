<?php

namespace App\Models\Virtual;

/**
 * @OA\Schema(
 *     description="Model singer",
 *     type="object",
 *     title="Model singer",
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

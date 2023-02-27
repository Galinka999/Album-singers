<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'singer' => new SingerResource($this->singer),
            'name' => $this->name,
            'year' => $this->year,
        ];
    }
}

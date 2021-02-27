<?php

namespace App\Http\Resources\Api\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookCollectionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            new BookResource($this)
        ];
    }
}

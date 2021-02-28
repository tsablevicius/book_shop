<?php

namespace App\Http\Resources\Api\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request): array
    {
        $price = $this->discount ? $this->price_with_discount : $this->price;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $price,
            'coverImg' => public_path('storage/cover_images/' . $this->cover_img_path),
            'authors' => $this->authors[0]->author,
            'genres' => $this->genres[0]->genre,
            'description' => $this->whenAppended('description', $this->description)
        ];
    }
}

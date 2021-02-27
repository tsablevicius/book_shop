<?php

namespace App\Http\Resources\Api\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'year' => $this->year,
            'price' => $this->price,
            'discount' => $this->discount,
            'coverImg' => $this->cover_img_path,
            'confirmedDate' => $this->is_confirmed,
            'priceWithDoscount' => $this->price_with_discount,
            'authors' => $this->authors[0]->author,
            'genres' => $this->genres[0]->genre,
        ];
    }
}

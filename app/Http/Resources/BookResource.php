<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'isbn' => $this->isbn,
            'authors' => unserialize($this->authors),
            'country' => $this->country,
            'number_of_pages' => $this->number_of_pages,
            'publisher' => $this->publisher,
            'release_date' => $this->release_date,
        ];
    }
}

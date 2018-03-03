<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
          "id" => $this->id,
          "name" => $this->name,
          "thumb" => url("/thumbs").'/'.$this->name,
          "large" => url("/images").'/'.$this->name,
          "description" => $this->description,
          "user" => new UserResource($this->user),
          "category" => new CategoryResource($this->category),
      ];
    }
}

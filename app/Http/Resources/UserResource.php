<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

class UserResource extends JsonResource
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
        "id"   => $this->id,
        "name" => $this->name,
        $this->mergeWhen((Auth::check()) AND (Auth::id() == $this->id), [
            "role" => $this->role,
            'settings' => \json_decode($this->settings),
            'created_at' => $this->created_at,
        ]),
      ];
    }
}

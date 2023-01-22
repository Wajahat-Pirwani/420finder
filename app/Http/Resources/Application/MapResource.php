<?php

namespace App\Http\Resources\Application;

use Illuminate\Http\Resources\Json\JsonResource;

class MapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'business_type' => $this->business_type,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'top_business' => $this->top_business == 1 ? true : false,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MapDetailResource extends JsonResource
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
            'id' => $this->id,
            'introduction' => $this->introduction,
            'about' => $this->about,
            'amenities' => $this->amenities,
            'customers' => $this->customers,
            'announcement' => $this->announcement,
            'license' => $this->license,
            'business_id' => $this->business_id
        ];
    }
}

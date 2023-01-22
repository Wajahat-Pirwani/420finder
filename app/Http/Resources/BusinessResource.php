<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
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
            'profile_picture' => $this->profile_picture,
            'slug' => $this->slug??"retailer",
            'business_name' => $this->business_name,
            'business_type' => $this->business_type,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'route_url' => URL::to('/'),
        ];
    }
}

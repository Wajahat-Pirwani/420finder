<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class MapResource extends JsonResource
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
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "phone_number" => $this->phone_number,
            "email" => $this->email,
            "role" => $this->role,
            "profile_picture" => $this->profile_picture,
            "business_name" => $this->business_name,
            "business_type" => $this->business_type,
            "country" => $this->country,
            "address_line_1" => $this->address_line_1,
            "address_line_2" => $this->address_line_2,
            "city" => $this->city,
            "state_province" => $this->state_province,
            "postal_code" => $this->postal_code,
            "opening_time" => $this->opening_time,
            "closing_time" => $this->closing_time,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "website" => $this->website,
            "instagram" => $this->instagram,
            "license_number" => $this->license_number,
            "license_type" => $this->license_type,
            "license_expiration" => $this->license_expiration,
            "order_online" => $this->order_online,
            "delivery" => $this->delivery,
            "status" => $this->status,
            "top_business" => $this->top_business,
            "order" => $this->order,
            "icon" => $this->icon,
            "distance" => $this->distance,
            "z_index" => is_null($this->z_index) || empty($this->z_index) ? 'n' : $this->z_index,
            "route" => URL::to('/'),
            "reviewCount" => $this->review_count(),
            "rating" => $this->calculatedRating(),
            'custom_icon' => $this->custom_icon,
            'monday_open' => $this->monday_open,
            'monday_close' => $this->monday_close,
            'tuesday_open' => $this->tuesday_open,
            'tuesday_close' => $this->tuesday_close,
            'wednesday_open' => $this->wednesday_open,
            'wednesday_close' => $this->wednesday_close,
            'thursday_open' => $this->thursday_open,
            'thursday_close' => $this->thursday_close,
            'friday_open' => $this->friday_open,
            'friday_close' => $this->friday_close,
            'saturday_open' => $this->saturday_open,
            'saturday_close' => $this->saturday_close,
            'sunday_open' => $this->sunday_open,
            'sunday_close' => $this->sunday_close,
            'open_status' => $this->checkOpenStatus(),
            'slug' => $this->slug??"retailer",
        ];
    }
}

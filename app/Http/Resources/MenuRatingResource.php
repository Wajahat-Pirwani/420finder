<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuRatingResource extends JsonResource
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
            'customer_id' => $this->id,
            'customer_name' => $this->name,
            'customer_profile' => is_null($this->profile) || empty($this->profile) ? 'true' : $this->profile,
            'retailer_id' => $this->retailer_id,
            'product_id' => $this->product_id,
            'description' => $this->description,
            'rating' => number_format($this->rating, 1),
            'date_time' => $this->created_at->diffForHumans()
        ];
    }
}

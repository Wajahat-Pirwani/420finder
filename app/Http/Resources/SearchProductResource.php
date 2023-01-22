<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'business_type' => $this->business_type,
            'product_route' => route('retailerproduct', [
                'business_type' => $this->business_type,
                'slug' => $this->slug,
                'product_id' => $this->id ])
        ];
    }
}

<?php

namespace App\Http\Resources\Application;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name??"",
            'image' => $this->image??"",
            'business_name' => $this->business->business_name??"",
            'business_type' => $this->business->business_type??"",
            'business_id' => $this->business->id,
            'brand_verified' => $this->brand_id == 0 ? false : true,
            'category_name' => $this->category->name??"",
            'price' => $this->price??$this->suggested_price??"",
            'description' => $this->description??"",
            'sku' => $this->sku??"",
            'strain' => $this->strain->name??"",
            'genetics' => $this->genetics->name??"",
            'thc_percentage' => (int)$this->thc_percentage??0,
            'cbd_percentage' => (int)$this->cbd_percentage??0,
            'grams' => $this->fp1??"",
            'total_reviews' => $this->reviews()->count(),
            'rating' => (int)$this->productRating(),
            'reviews' => $this->reviews()
        ];
    }
}

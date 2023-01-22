<?php

namespace App\Http\Resources;

use App\Models\Brand;
use App\Models\Business;
use App\Models\Strain;
use App\Models\Genetic;
use App\Models\Category;
use App\Models\DeliveryProducts;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

       $category = Category::where('id', $this->category_id)->pluck('name')->toArray();
       $strain = Strain::where('id', $this->strain_id)->pluck('name')->toArray();
       $genetic = Genetic::where('id', $this->genetic_id)->pluck('name')->toArray();

        return [
            'id' => $this->id,
            'delivery_id' => $this->delivery_id,
            'name' => $this->name,
            'verify' => $this->verify,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'off' => $this->off,
            'image' => $this->image,
            'flower_price_name' => $this->flower_price_name,
            'sku' => $this->sku,
            'category_id' => $this->category_id,
            'strain' => $strain,
            'genetic' => $genetic,
            'category_name' => $category,
            'thc_percentage' => $this->thc_percentage,
            'cbd_percentage' => $this->cbd_percentage,
            'is_featured' => $this->is_featured,
            'brand_product' => $this->brand_product,
            'brand_product_id' => $this->brand_product_id,
            'brand_id' => $this->brand_id,
            'reviewCount' => $this->reviewCount,
            'product_route' => route('retailerproduct', [
                'business_type' => $this->business->business_type,
                'slug' => $this->slug,
                'product_id' => $this->id ]),
            'rating' => $this->rating,
            'business_name' => $this->business->business_name,
            'brand' => Business::where('id', $this->brand_id)->select('business_name')->first()
        ];
    }
}

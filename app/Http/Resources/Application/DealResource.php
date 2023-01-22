<?php

namespace App\Http\Resources\Application;

use App\Models\DealProduct;
use App\Models\DeliveryProducts;
use App\Models\DispenseryProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class DealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $deal_products = DealProduct::where('deal_id', $this->id)->pluck('product_id');
        if ($this->business->business_type == 'Delivery'){
            $products = DeliveryProducts::whereIn('id', $deal_products)->get();
        }elseif ($this->business->business_type == 'Dispensary'){
            $products = DispenseryProduct::whereIn('id', $deal_products)->get();
        }
        return [
            'id' => $this->id,
            'image' => json_decode($this->picture)[0]??"",
            'business' => new BusinessResource($this->business),
            'title' => $this->title??"",
            'deal_price' => $this->deal_price??"",
            'percentage' => $this->percentage??"",
            'description' => $this->description??"",
            'claimed' => false,
            'products' => ProductResource::collection($products)
        ];
    }
}

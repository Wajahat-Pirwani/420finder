<?php

namespace App\Http\Resources\Application;

use App\Models\BrandProduct;
use App\Models\Deal;
use App\Models\DeliveryProducts;
use App\Models\DispenseryProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->order_type == "Product"){
            if ($this->type == 'Delivery'){
                $product = DeliveryProducts::find($this->product_id);
            }elseif ($this->type == 'Dispensary'){
                $product = DispenseryProduct::find($this->product_id);
            }elseif ($this->type == 'Brand'){
                $product = BrandProduct::find($this->product_id);
            }
        }else{
            $product = null;
        }
        if ($this->order_type == "Deal"){
            $deal = Deal::find($this->product_id);
        }else{
            $deal = null;
        }
        return [
            'id' => $this->id,
            'name' => $this->name??"",
            'price' => (string)$this->price??"",
            'quantity' => (int)$this->quantity??0,
            'type' => (string)$this->type??"",
            'size' => $this->size??"",
            'order_type' => $this->order_type??"",
            'product' => new ProductResource($product),
            'deal' => new DealResource($deal)
        ];
    }
}

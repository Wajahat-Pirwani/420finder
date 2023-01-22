<?php

namespace App\Http\Resources\Application;

use App\Models\BrandProduct;
use App\Models\Deal;
use App\Models\DeliveryProducts;
use App\Models\DispenseryProduct;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [];
        $price = 0;
        $products = Order::where('tracking_number', $this->tracking_number)->get();
        foreach ($products as $key=>$product){
            if ($product->deal_id == null){
                if ($this->business->business_type == 'Delivery'){
                    $produDetail = DeliveryProducts::find($product->product_id);
                } elseif ($this->business->business_type == 'Brand'){
                    $produDetail = BrandProduct::find($product->product_id);
                }else{
                    $produDetail = DispenseryProduct::find($product->product_id);
                }
                $p = $produDetail->name;
                $pi = $produDetail->image;
            }else{
                $produDetail = Deal::find($product->deal_id);
                $p = $produDetail->title;
                $pi = json_decode($produDetail->picture)[0];
            }
            $data[$key] = [
                'product_name' => $p??"",
                'product_image' => $pi??"",
                'product_price' => $product->price??"",
                'product_quantity' => $product->qty??"",
            ];
            $price = $price+$product->price;
        }
        return [
            'id' => $this->id,
            'tracking_number' => $this->tracking_number??"",
            'business_id' => $this->business->id,
            'business_name' => $this->business->business_name??"",
            'business_type' => $this->business->business_type??"",
            'business_image' => $this->business->profile_picture??"",
            'price' => (string)$price??"",
            'status' => $this->status??"",
            'created_at' => $this->created_at,
            'order_type' => "Product",
            'products' => $data,
        ];
    }
}

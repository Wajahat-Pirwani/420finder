<?php

namespace App\Models;

use App\Http\Resources\Application\ProductResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function types() {
        return $this->hasMany('App\Models\CategoryType');
    }
    public function deliveryProducts($delivery_id){
        $products = DeliveryProducts::where('category_id', $this->id)->where('delivery_id', $delivery_id)->get();
        return ProductResource::collection($products);
    }
    public function dispensaryProducts($dispensary_id){
        $products = DispenseryProduct::where('category_id', $this->id)->where('dispensery_id', $dispensary_id)->get();
        return ProductResource::collection($products);
    }
    public function brandProducts($brand_id){
        $products = BrandProduct::where('category_id', $this->id)->where('brand_id', $brand_id)->get();
        return ProductResource::collection($products);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealProduct extends Model
{
    use HasFactory;

     // FOR DEAL SINGLE PAGE
     public function reviewsResolver($productId)
     {
         $products = RetailerReview::where('product_id', $productId)->get();

         return [
             'reviewAvg' => number_format($products->avg('rating'), 1),
             'reviewCount' => $products->count()
         ];
     }

     public function categories()
     {
         return $this->belongsTo(Strain::class, 'strain_id');
     }

     public function retailer()
     {
         return $this->belongsTo(Business::class, 'delivery_id');
     }

     public function disRetailer()
     {
         return $this->belongsTo(Business::class, 'dispensery_id');
     }

}

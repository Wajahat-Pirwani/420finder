<?php

namespace App\Models;

use App\Models\Traits\CanBeScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryProducts extends Model
{
    use HasFactory, CanBeScoped;


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(RetailerReview::class, 'product_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'delivery_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function strain()
    {
        return $this->belongsTo(Strain::class, 'strain_id');
    }

    public function genetics()
    {
        return $this->belongsTo(Genetic::class, 'genetic_id');
    }
    public function productRating(){
        if ($this->reviews()->count() > 0) {
            $sum = 0;
            foreach ($this->reviews() as $review) {
                $sum = $sum + $review->rating;
            }
            $totalratings = $sum / $this->reviews()->count();
        } else {
            $totalratings = 0;
        }
        return $totalratings;
    }
}

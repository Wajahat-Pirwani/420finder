<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandProduct extends Model
{
    use HasFactory;

    public function brand()
    {

        return $this->belongsTo('App\Models\Brand');

    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'brand_id');
    }

    public function gallery()
    {

        return $this->hasMany('App\Models\BrandProductGallery');

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

    public function productRating()
    {
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

    public function reviews()
    {

        return $this->hasMany('App\Models\BrandProductReview');

    }
}

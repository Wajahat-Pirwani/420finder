<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RetailerReview;

class RatingController extends Controller
{
    public function index($id){
  
    $reviews = RetailerReview::where('retailer_id', $id)->get();
    $count = RetailerReview::where('retailer_id', $id)->count();

     if (count($reviews) > 0) {

    $sum = 0;
    foreach ($reviews as $review) {
        $sum = $sum + $review->rating;

        }
        $totalratings = $sum / $reviews->count();

        } else {
        $totalratings = 0;
        }

        return response()->json([
            'totalratings'=>$totalratings,
            'count' => $count, 
        ]);
                                 
    }
}

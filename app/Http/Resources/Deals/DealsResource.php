<?php

namespace App\Http\Resources\Deals;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DealsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $reviews = App\Models\RetailerReview::where('retailer_id', $this->retailer_id)->get();
dd($reviews);
        if (count($reviews) > 0) {

            $sum = 0;
            foreach ($reviews as $review) {

                $sum = $sum + $review->rating;

            }
            $totalratings = $sum / $reviews->count();

        } else {
            $totalratings = 0;
        }
        
        return [
            'id' => $this->id,
            'dispensary' => $this->dispensary,
            'picture' => $this->picture,
            'title' => $this->title,
            'deal_price' => $this->deal_price,
            'totalratings' =>  $totalratings,
            'reviews' => $this->id
        
        ]; 
    }
}

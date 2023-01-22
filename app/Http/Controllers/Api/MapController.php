<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\MapCategoryResource;
use App\Http\Resources\MapDetailResource;
use App\Http\Resources\MapResource;
use App\Http\Resources\RatingResource;
use App\Models\Business;
use App\Models\Category;
use App\Models\Detail;
use App\Models\RetailerReview;
use App\Scoping\Scopes\MapScopes\BestofScope;
use App\Scoping\Scopes\MapScopes\MapCategoryScope;
use App\Scoping\Scopes\MapScopes\MapSortScope;
use App\Scoping\Scopes\MapScopes\OpennowScope;
use App\Scoping\Scopes\MapScopes\OrderonlineScope;
use App\Scoping\Scopes\MapScopes\StoredeliveryScope;
use Carbon\Carbon;
class MapController extends Controller
{
    public function map()
    {
        $requestData = request()->all();
        $businesses = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$requestData['latitude'], $requestData['longitude'], $requestData['latitude']])
            ->having("distance", "<", 17000)
            // ->withCount([
            // 'reviews as reviewCount',
            // 'reviews as rating' => function($query) {
            // $query->select(DB::raw('coalesce(avg(rating),0)'));}
            // ])
            ->when(!request()->has('sort'), function ($query) {
                return $query->orderBy('distance', 'asc');
            })
            ->withScopes($this->scopes())
            ->where('approve', 1)
            ->where('business_type', '!=', 'Brand')
            ->paginate(1000);
        $businessCount = Business::selectRaw("businesses.* ,
        ( 6371000 * acos( cos( radians(?) ) *
          cos( radians( latitude ) )
          * cos( radians( longitude ) - radians(?)
          ) + sin( radians(?) ) *
          sin( radians( latitude ) ) )
        ) AS distance", [$requestData['latitude'], $requestData['longitude'], $requestData['latitude']])
            ->having("distance", "<", 17000)
            ->withScopes($this->scopes())
            ->orderBy("distance", 'asc')->where('approve', 1)->where('business_type', '!=', 'Brand')->count();
        return MapResource::collection($businesses)->additional(['business_count' => $businessCount]);
    }
    protected function scopes()
    {
        return [
            'opennow' => new OpennowScope(),
            'storedelivery' => new StoredeliveryScope(),
            'orderonline' => new OrderonlineScope(),
            'bestof' => new BestofScope(),
            'category' => new MapCategoryScope(),
            'sort' => new MapSortScope()
        ];
    }
    // =================== GET ALL CATEGORIES =====================
    public function categories()
    {
        $categories = Category::all();
        return MapCategoryResource::collection($categories);
    }
    // =================== GET RETAILOR DETAILS ===================
    public function getRetailerDetails($id)
    {
        $details = Detail::where('business_id', $id)->first();
        return new MapDetailResource($details);
    }
    // =================== GET RETAILOR REVIEWS ===================
    public function getRetailerReviews($id)
    {
        $reviews = RetailerReview::where('retailer_id', $id)->get();
        $reviewTotalRating = $reviews->count();
        $reviewAvgRating = number_format($reviews->avg('rating'), 1);
        $reviewFiveRating = $this->filterRatingResolver($reviews, 5, 6);
        $reviewFourRating = $this->filterRatingResolver($reviews, 4, 5);
        $reviewThreeRating = $this->filterRatingResolver($reviews, 3, 4);
        $reviewTwoRating = $this->filterRatingResolver($reviews, 2, 3);
        $reviewOneRating = $this->filterRatingResolver($reviews, 1, 2);
        $reviewNumbers = [
            'reviewTotalRating' => $reviewTotalRating,
            'reviewAvgRating' => $reviewAvgRating,
            'reviewFiveRating' => $reviewFiveRating,
            'reviewFourRating' => $reviewFourRating,
            'reviewThreeRating' => $reviewThreeRating,
            'reviewTwoRating' => $reviewTwoRating,
            'reviewOneRating' => $reviewOneRating
        ];
        return RatingResource::collection($reviews)->additional(['reviewsNumbers' => $reviewNumbers]);
    }
    private function filterRatingResolver($reviews, $numStart, $numEnd)
    {
        $reviewCount = $reviews->filter(function ($review) use ($numStart, $numEnd) {
            return $review->rating >= $numStart && $review->rating < $numEnd;
        })->count();
        return $reviewCount;
    }
    // ======================== GET ALL STORE FRONTS =======================
    public function getAllStores($lat, $lng)
    {
        $businesses = Business::selectRaw("businesses.* ,
        ( 6371000 * acos( cos( radians(?) ) *
          cos( radians( latitude ) )
          * cos( radians( longitude ) - radians(?)
          ) + sin( radians(?) ) *
          sin( radians( latitude ) ) )
        ) AS distance", [$lat, $lng, $lat])
            ->having("distance", "<", 17000)
            //    ->withCount([
            //     'reviews as reviewCount',
            //     'reviews as rating' => function($query) {
            //     $query->select(DB::raw('coalesce(avg(rating),0)'));}
            //    ])
            ->orderBy("distance", 'asc')
            ->has('deals')->with(['deals' => function ($q) {
                return $q->where(
                    'ending_date', '>=', Carbon::now()->format('Y-m-d')
                );
            }])->where('approve', 1)->get();
        return $businesses;
    }
}

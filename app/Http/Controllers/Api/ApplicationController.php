<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Application\BusinessResource;
use App\Http\Resources\Application\CartResource;
use App\Http\Resources\Application\DealResource;
use App\Http\Resources\Application\MapResource;
use App\Http\Resources\Application\ProductResource;
use App\Http\Resources\Application\RatingResource;
use App\Http\Resources\Application\SlideCollection;
use App\Http\TrackHistory;
use App\Models\Admin;
use App\Models\BrandProduct;
use App\Models\Business;
use App\Models\Category;
use App\Models\Deal;
use App\Models\DeliveryProducts;
use App\Models\DispenseryProduct;
use App\Models\Favorite;
use App\Models\MobileCart;
use App\Models\Order;
use App\Models\RetailerReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function settings()
    {
        $settings = Admin::select('name', 'email', 'privacypolicy', 'cookiepolicy', 'referalprogram')->first();
        return $settings;
    }

    public function slides($latitude, $longitude)
    {
        $slidesde = DB::table('sliders')
            ->selectRaw("sliders.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", DB::raw("slide_radius * 1000"))
            ->orderBy("distance", 'asc')
            ->where('display_type', 'Desktop')
            ->get();
        $data = SlideCollection::collection($slidesde);
        return response()->json($data);
    }

    public function middleSLides($latitude, $longitude)
    {
        $middleslides = DB::table('middle_sliders')
            ->selectRaw("middle_sliders.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", DB::raw("slide_radius * 1000"))
            ->orderBy("distance", 'asc')
            ->where('display_type', 'Desktop')
            ->get();
        $data = SlideCollection::collection($middleslides);
        return response()->json($data);
    }
    public function brandSlides($latitude, $longitude)
    {
        $brandslides = DB::table('brand_slides')
            ->selectRaw("brand_slides.* ,
                       ( 6371000 * acos( cos( radians(?) ) *
                         cos( radians( latitude ) )
                         * cos( radians( longitude ) - radians(?)
                         ) + sin( radians(?) ) *
                         sin( radians( latitude ) ) )
                       ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", DB::raw("slide_radius * 1000"))
            ->orderBy("distance", 'asc')
            ->where('display_type', 'Desktop')
            ->get();
        $data = SlideCollection::collection($brandslides);
        return response()->json($data);
    }


    public function top10($latitude, $longitude)
    {
        $topBusinesses = Business::selectRaw("businesses.* ,
            ( 6371000 * acos( cos( radians(?) ) *
            cos( radians( latitude ) )
            * cos( radians( longitude ) - radians(?)
            ) + sin( radians(?) ) *
            sin( radians( latitude ) ) )
            ) AS distance", [$latitude, $longitude, $latitude])
            ->orderBy('order', 'ASC')
            ->having("distance", "<", 17000)
            ->orderBy('distance', 'asc')
            ->where('top_business', 1)
            ->where('approve', 1)
            ->limit(10)->get();
        return response()->json(BusinessResource::collection($topBusinesses));
    }

    public function map($latitude, $longitude, $business_type, $filter_type)
    {
        $busineeses = Business::selectRaw("businesses.* ,
            ( 6371000 * acos( cos( radians(?) ) *
            cos( radians( latitude ) )
            * cos( radians( longitude ) - radians(?)
            ) + sin( radians(?) ) *
            sin( radians( latitude ) ) )
            ) AS distance", [$latitude, $longitude, $latitude])
            ->orderBy('order', 'ASC')
            ->having("distance", "<", 17000)
            ->orderBy('distance', 'asc')
            ->where('approve', 1);
        if ($business_type == 'Delivery') {
            $topBusinesses = $busineeses->where('business_type', 'Delivery')->get();
        } elseif ($business_type == 'Dispensary') {
            $topBusinesses = $busineeses->where('business_type', 'Dispensary')->get();
        } else {
            $topBusinesses = $busineeses->get();
        }
        if ($filter_type == "Top") {
            $topBusinesses = $busineeses->where('top_business', 1)->get();
        }
        return response()->json(MapResource::collection($topBusinesses));
    }

    public function mapall()
    {
        $topBusinesses = Business::orderBy('order', 'ASC')
            ->where('approve', 1)
            ->get();
        return response()->json(BusinessResource::collection($topBusinesses));
    }

    public function businesses($business_type, $latitude, $longitude)
    {
        $businesses = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", 17000)
            ->orderBy("distance", 'asc')
            ->where('business_type', $business_type)
            ->where('approve', 1)
            ->paginate(10);
        return BusinessResource::collection($businesses);
    }

    public function brands($latitude, $longitude){
        $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");
        $dat = json_decode($geo, true);
        $getstate = $dat['results'][0]['address_components'];
        $state = 5;
        foreach ($getstate as $row) {
            if ($row['types'][0] == 'administrative_area_level_1') {
                $state = $row['long_name'];
            }
        }
        $state_id = DB::table('states')->where('name', $state)->first();
        if ($state_id != null) {
            $brands_id = DB::table('brand_addresses')
                ->where('state_id', $state_id->id)
                ->where('status', '1')
                ->pluck('brand_id');
            $brands = Business::whereIn('id', $brands_id)
                ->where('business_type', 'Brand')
                ->where('status', 1)
                ->where('approve', 1)
                ->paginate(10);
            return BusinessResource::collection($brands);
        } else {
            return response()->json(['error' => 'no brand found'], 400);
        }
    }

    public function deals($latitude, $longitude)
    {
        $businesses = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", 17000)
            ->where('approve', 1)
            ->orderBy("distance", 'asc')
            ->pluck('id');
//        $businessIds = [4699, 10977];
//        foreach ($businesses as $business) {
//            array_push($businessIds, $business->id);
//        }
        $deals = Deal::whereIn('retailer_id', $businesses)->get();
        return response()->json(DealResource::collection($deals));
    }

    public function products($business_type, $business_id)
    {
        if ($business_type == 'Delivery') {
            $products = DeliveryProducts::where('delivery_id', $business_id)->where('is_featured', 0)->paginate(10);
            return ProductResource::collection($products);
        } else if ($business_type == 'Dispensary') {
            $products = DispenseryProduct::where('dispensery_id', $business_id)->where('is_featured', 0)->paginate(10);
            return ProductResource::collection($products);
        }  else if ($business_type == 'Brand') {
            $products = BrandProduct::where('brand_id', $business_id)->paginate(10);
            return ProductResource::collection($products);
        } else {
            return 'no found';
        }
    }

    public function productFilter($business_type, $business_id, $category_id, $genetics, $thc, $cbd, $brand, $price)
    {
        if ($business_type == 'Delivery') {
            $products = DeliveryProducts::where('delivery_id', $business_id)
                ->where('is_featured', 0);
            if ($thc == "Thc") {
                $data = $products->where('thc_percentage', '!=', null);
            } elseif ($cbd == "Cbd") {
                $data = $products->where('cbd_percentage', '!=', null);
            } elseif ($brand == "Brand") {
                $data = $products->where('brand_id', '!=', 0);
            } elseif ($genetics != "no") {
                $data = $products->where('genetic_id', $genetics);
            } elseif ($category_id != "no") {
                $data = $products->where('category_id', $category_id);
            } else {
                $data = $products;
            }
            return ProductResource::collection($data->paginate(10));
        } else if ($business_type == 'Dispensary') {
            $products = DispenseryProduct::where('dispensery_id', $business_id)
                ->where('is_featured', 0);
            if ($thc == "Thc") {
                $data = $products->where('thc_percentage', '!=', null);
            } elseif ($cbd == "Cbd") {
                $data = $products->where('cbd_percentage', '!=', null);
            } elseif ($brand == "Brand") {
                $data = $products->where('brand_id', '!=', 0);
            } elseif ($genetics != "no") {
                $data = $products->where('genetic_id', $genetics);
            } elseif ($category_id != "no") {
                $data = $products->where('category_id', $category_id);
            }else {
                $data = $products;
            }
            return ProductResource::collection($data->paginate(10));
        } else {
            return 'no found';
        }
    }

    public function productsWithCategories($business_type, $business_id)
    {
        if ($business_type == 'Delivery') {
            $categories = Category::latest()->get();
            $data = [];
            foreach ($categories as $key => $category) {
                $data[$key] = [
                    "id" => $category->id,
                    "name" => $category->name,
                    "products" => $category->deliveryProducts($business_id)
                ];
            }
            return $data;
        } else if ($business_type == 'Dispensary') {
            $categories = Category::latest()->get();
            $data = [];
            foreach ($categories as $key => $category) {
                $data[$key] = [
                    "id" => $category->id,
                    "name" => $category->name,
                    "products" => $category->dispensaryProducts($business_id)
                ];
            }
            return $data;
        } else if ($business_type == 'Brand') {
            $categories = Category::latest()->get();
            $data = [];
            foreach ($categories as $key => $category) {
                $data[$key] = [
                    "id" => $category->id,
                    "name" => $category->name,
                    "products" => $category->brandProducts($business_id)
                ];
            }
            return $data;
        } else {
            return 'no found';
        }
    }

    public function featuredProducts($business_type, $business_id)
    {
        if ($business_type == 'Delivery') {
            $products = DeliveryProducts::where('delivery_id', $business_id)->where('is_featured', 1)->get();
            return response()->json(ProductResource::collection($products));
        } else if ($business_type == 'Dispensary') {
            $products = DispenseryProduct::where('dispensery_id', $business_id)->where('is_featured', 1)->get();
            return response()->json(ProductResource::collection($products));
        } else {
            return 'no found';
        }
    }

    public function singleBusiness($id)
    {
        $business = Business::find($id);
        $data = new BusinessResource($business);
        return response()->json($data);
    }

    public function singleBusinessDeals($id)
    {
        $deals = Deal::where('retailer_id', $id)->get();
        $data = DealResource::collection($deals);
        return response()->json($data);
    }

    public function addtocart(Request $request)
    {
        $checkAlreadyAvailable = MobileCart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->first();
        if ($checkAlreadyAvailable) {
            return response()->json(['error' => 'Product Already Added'], 400);
        } else {
            $cart = new MobileCart();
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $request->product_id;
            $cart->vendor_id = $request->vendor_id;
            $cart->name = $request->name;
            $cart->price = $request->price;
            $cart->quantity = $request->quantity;
            $cart->type = $request->type;
            $cart->size = $request->size;
            $cart->order_type = $request->order_type;
            $cart->save();
            return response()->json(['success' => 'Added Successfully'], 200);
        }
    }

    public function checkout(Request $request){
        $user = Auth::user();
        $tracking_number = Str::random(6);
        $request->validate([
            'customer_name' => 'required',
            'phone_number' => 'required',
            'name_on_id' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
            'delivery_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required'
        ]);
        $cartItems = MobileCart::where('user_id', $user->id)->get();

        foreach ($cartItems as $item){
            $order = new Order;
            $order->tracking_number = $tracking_number;
            $order->retailer_id = $item->vendor_id;
            $order->customer_id = $user->id;
            $order->product_id = $item->product_id;
            $order->price = $item->price * $item->quantity;
            $order->customer_address = $request->delivery_address;
            $order->qty = $item->quantity;
            $order->order_date = date('Y-m-d');
            $order->customer_name = $user->name;
            $order->customer_email = $user->email;
            $order->customer_phone = $request->phone_number;
            $order->nameonorder = $request->customer_name;
            $order->delivery_address = $request->delivery_address;
            $order->nameonid = $request->name_on_id;
            $order->id_type = $request->id_type;
            $order->id_number = $request->id_number;
            $order->additional_notes = $request->additional_notes;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->zip_code = $request->zip_code;
            $order->read = 1;
            if ($item->order_type == "Deal"){
                $order->deal_id = $item->product_id;
            }
            $order->save();
        }
        TrackHistory::addNotification($user->id, 'Order', 'Thanks for your order!');
        $checkAlreadyAvailable = MobileCart::where('user_id', $user->id)->get();
        $checkAlreadyAvailable->each->delete();
        return response()->json(['success' => 'Order Succesfully Placed']);

    }

    public function cartitems()
    {
        $cartitems = MobileCart::where('user_id', Auth::user()->id)->latest()->get();
        $data = CartResource::collection($cartitems);
        return response()->json(['items' => $data, 'total' => $cartitems->sum('price')]);
    }

    public function removeCartItem($id)
    {
        $item = MobileCart::find($id);
        $item->delete();
        return response()->json(['success' => 'Item Deleted Successfully'], 200);
    }
    public function updateCartItem($id, $quantity)
    {
        $item = MobileCart::find($id);
        $item->quantity = $quantity;
        $item->update();
        return response()->json(['success' => 'Item Update Successfully'], 200);
    }

    public function categories()
    {
        $categories = Category::orderBy('id', 'DESC')->select('id', 'name', 'image')->get();
        return $categories;
    }

    public function categoryProducts($business_type, $latitude, $longitude, $category_id)
    {
        $businesses = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", 17000)
            ->where('approve', 1)
            ->orderBy("distance", 'asc')
            ->pluck('id');
        if ($business_type == "Delivery") {
            $data = DeliveryProducts::whereIn('delivery_id', $businesses)->where('category_id', $category_id)->paginate(10);
        } elseif ($business_type == "Dispensary") {
            $data = DispenseryProduct::whereIn('dispensery_id', $businesses)->where('category_id', $category_id)->paginate(10);
        }
        return ProductResource::collection($data);
    }

    public function singleProduct($business_type, $id){
        if ($business_type == "Delivery") {
            $data = DeliveryProducts::where('id', $id)->first();
        } elseif ($business_type == "Dispensary") {
            $data = DispenseryProduct::where('id', $id)->first();
        } elseif ($business_type == "Brand") {
            $data = BrandProduct::where('id', $id)->first();
        }
        return new ProductResource($data);
    }

    public function addToFavourite($business_id, $business_type)
    {
        $user = Auth::user();
        $check = Favorite::where('customer_id', $user->id)
            ->where('type_id', $business_id)
            ->where('fav_type', $business_type)
            ->first();
        if ($check) {
            $check->delete();
            return response()->json(['success' => 'Unlike']);
        } else {
            $fav = new Favorite;
            $fav->customer_id = $user->id;
            $fav->type_id = $business_id;
            $fav->fav_type = $business_type;
            if ($fav->save()) {
                return response()->json(['success' => 'Like Done']);
            } else {
                return response()->json(['success' => 'SOmething wrong'], 400);
            }
        }
    }

    public function favourites()
    {
        $user = Auth::user();
        $favourites = Favorite::where('customer_id', $user->id)->pluck('type_id');
        $business = Business::whereIn('id', $favourites)->get();
        return response()->json(BusinessResource::collection($business));
    }

    public function businessReviews($bsiness_id, $product_id)
    {
        if ($product_id == 'no') {
            $reviews = RetailerReview::where('retailer_id', $bsiness_id)->whereNull('product_id')->whereNotNull('rating')->paginate(10);
        }else{
            $reviews = RetailerReview::where('retailer_id', $bsiness_id)->where('product_id', $product_id)->whereNotNull('rating')->paginate(10);
        }
        return RatingResource::collection($reviews);
    }

    public function reviewsData($bsiness_id, $product_id)
    {
        if ($product_id == 'no'){
            $reviews = RetailerReview::where('retailer_id', $bsiness_id)->whereNull('product_id')->whereNotNull('rating')->get();
            $business = Business::find($bsiness_id);
            $data['total_reviews'] = $business->review_count();
            $data['rating'] = $business->calculatedRating();
            $data['stars_5'] = $this->filterRatingResolver($reviews, 5, 6);
            $data['stars_4'] = $this->filterRatingResolver($reviews, 4, 5);
            $data['stars_3'] = $this->filterRatingResolver($reviews, 3, 4);
            $data['stars_2'] = $this->filterRatingResolver($reviews, 2, 3);
            $data['stars_1'] = $this->filterRatingResolver($reviews, 1, 2);
        }else{
            $reviews = RetailerReview::where('retailer_id', $bsiness_id)->where('product_id', $product_id)->whereNotNull('rating')->get();
            $data['total_reviews'] = $reviews->count();
            if ($reviews->count() == 0){
                $rating = 0;
            }else{
                $rating = $reviews->sum('rating')/$reviews->count();
            }
            $data['rating'] = number_format($rating, 1);
            $data['stars_5'] = $this->filterRatingResolver($reviews, 5, 6);
            $data['stars_4'] = $this->filterRatingResolver($reviews, 4, 5);
            $data['stars_3'] = $this->filterRatingResolver($reviews, 3, 4);
            $data['stars_2'] = $this->filterRatingResolver($reviews, 2, 3);
            $data['stars_1'] = $this->filterRatingResolver($reviews, 1, 2);
        }
        return $data;
    }
    private function filterRatingResolver($reviews, $numStart, $numEnd)
    {
        $reviewCount = $reviews->filter(function ($review) use ($numStart, $numEnd) {
            return $review->rating >= $numStart && $review->rating < $numEnd;
        })->count();
        return $reviewCount;
    }

    public function businessGallery($bsiness_id)
    {
        $gallery = DB::table('business_galleries')->where('business_id', $bsiness_id)->select('image', 'caption')->get();
        return $gallery;
    }

    public function reviewSubmit(Request $request)
    {
        $user = Auth::user();
        $review = new RetailerReview();
        $review->retailer_id = $request->retailer_id;
        $review->product_id = $request->product_id;
        $review->customer_id = $user->id;
        $review->description = $request->review;
        $review->rating = $request->rating;
        if ($review->save()) {
            return response()->json(['success' => 'Review Add Success']);
        } else {
            return response()->json(['success' => 'Something wrong'], 400);
        }
    }
}

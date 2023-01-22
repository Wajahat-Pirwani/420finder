<?php
namespace App\Http\Controllers;
use App\Http\TrackHistory;
use App\Jobs\AddBusinessMailJob;
use App\Jobs\ForgotPasswordMailJob;
use App\Mail\ForgotPassword;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\BrandFeed;
use App\Models\BrandProduct;
use App\Models\Business;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Deal;
use App\Models\DealsClaimed;
use App\Models\DeliveryBanner;
use App\Models\DeliveryCart;
use App\Models\DeliveryProductGallery;
use App\Models\DeliveryProducts;
use App\Models\Detail;
use App\Models\DispensaryCart;
use App\Models\DispenseryProduct;
use App\Models\DispenseryProductGallery;
use App\Models\Favorite;
use App\Models\Notifications;
use App\Models\ProductRequest;
use App\Models\RecentlyViewed;
use App\Models\RetailerReview;
use App\Models\StrainBanner;
use App\Models\StrainPost;
use App\Models\SubCategory;
use App\Models\TermOfUse;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class WebsiteController extends Controller
{
    public function index()
    {
        if (!empty(session('latitude')) and !empty(session('longitude'))) {
            $latitude = session('latitude');
            $longitude = session('longitude');
            $categories = Category::orderBy('id', 'DESC')->get();
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
            $dispensaries = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", 17000)
                ->orderBy("distance", 'asc')
                ->where('business_type', 'Dispensary')
                ->where('approve', 1)
                ->limit(10)->get();
            $deliveries = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", 17000)
                ->orderBy("distance", 'asc')
                ->where('business_type', 'Delivery')
                ->where('approve', 1)
                ->limit(10)->get();
            $businesses =Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", 17000)
                ->orderBy("distance", 'asc')
                ->where('approve', 1)
                ->get();
            if (!empty(session('customer_id'))) {
                $recentlyvieweds = RecentlyViewed::where('customer_id', session('customer_id'))->get();
            } else {
                $recentlyvieweds = [];
            }
            $slidesdesktop = DB::table('sliders')
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
            $middleslidesdesktop = DB::table('middle_sliders')
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
        } else {
            // Los Angeles California By Default
            $latitude = "34.0201613";
            $longitude = "-118.6919234";
            $categories = Category::orderBy('id', 'DESC')->get();
            $dispensaries = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", 17000)
                ->orderBy("distance", 'asc')
                ->where('business_type', 'Dispensary')
                ->where('approve', 1)
                ->limit(10)->get();
            $deliveries = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", 17000)
                ->orderBy("distance", 'asc')
                ->where('business_type', 'Delivery')
                ->where('approve', 1)
                ->limit(10)->get();
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
                ->limit(10)->get();
            $topBusinesses = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", 17000)
                ->where('top_business', 1)
                ->where('approve', 1)
                ->orderBy('order', 'asc')
                ->limit(10)->get();
            if (!empty(session('customer_id'))) {
                $recentlyvieweds = RecentlyViewed::where('customer_id', session('customer_id'))->get();
            } else {
                $recentlyvieweds = [];
            }
            $slidesdesktop = DB::table('sliders')
                ->selectRaw("sliders.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", DB::raw("slide_radius * 1000"))
                ->orderBy("distance", 'asc')
                ->get();
            $middleslidesdesktop = DB::table('middle_sliders')
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
        }
        return view('index')
            ->with('slidesdesktop', $slidesdesktop)
            ->with('middleslidesdesktop', $middleslidesdesktop)
            ->with('categories', $categories)
            ->with('dispensaries', $dispensaries)
            ->with('deliveries', $deliveries)
            ->with('businesses', $businesses)
            ->with('recentlyvieweds', $recentlyvieweds)
            ->with('topBusinesses', $topBusinesses);
    }
    public function managemybusiness()
    {
        if (!empty(session('customer_email'))) {
            $business = Business::where('email', session('customer_email'))->first();
            $business_id = session()->put('business_id', $business->id);
            $business_fn = session()->put('business_fn', $business->first_name);
            $business_ln = session()->put('business_ln', $business->last_name);
            $business_email = session()->put('business_email', $business->email);
            session()->forget('customer_id');
            session()->forget('customer_name');
            session()->forget('customer_email');
            return redirect()->route('businessprofile');
        } else {
            return redirect()->route('businesssignin');
        }
    }
    public function managecustomeraccount()
    {
        if (!empty(session('business_email'))) {
            $user = User::where('email', session('business_email'))->first();
            $customer_id = session()->put('customer_id', $user->id);
            $customer_name = session()->put('customer_name', $user->name);
            $customer_email = session()->put('customer_email', $user->email);
            session()->forget('business_id');
            session()->forget('business_fn');
            session()->forget('business_ln');
            session()->forget('business_email');
            return redirect()->route('profile');
        } else {
            return redirect()->route('signin');
        }
    }
    public function search(Request $request)
    {
        $string = $request->keyword;
        $searchValues = preg_split('/\s+/', $string, -1, PREG_SPLIT_NO_EMPTY);
        if (!empty(session('latitude')) and !empty(session('longitude'))) {
            // dd("1");
            $latitude = session('latitude');
            $longitude = session('longitude');
            // $user_ip = getenv('REMOTE_ADDR');
            // $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
            // $latitude = $geo['geoplugin_latitude'];
            // $longitude = $geo['geoplugin_longitude'];
            $businesses = DB::table('businesses')
                ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", 17000)
                ->orderBy("distance", 'asc')
                ->where(function ($q) use ($searchValues) {
                    foreach ($searchValues as $value) {
                        $q->orWhere('businesses.first_name', 'like', "%{$value}%");
                        $q->orWhere('businesses.last_name', 'like', "%{$value}%");
                        $q->orWhere('businesses.business_name', 'like', "%{$value}%");
                    }
                })->where('approve', 1)->get();
        } else {
            $businesses = [];
        }
        return view('search')
            ->with('businesses', $businesses);
    }
    public function getlocationforcurrentuser(Request $request)
    {
        session()->put('latitude', $request->lat);
        session()->put('longitude', $request->lon);
        $lat = $request->lat;
        $lon = $request->lon;
        // $url = 'https://maps.googleapis.com/maps/api/geocode/json?key= AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8&latlng='.trim(session('latitude')).','.trim(session('longitude')).'&sensor=false';
        $url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8&latlng={$lat},{$lon}&sensor=false";
        $json = @file_get_contents($url);
        $data = json_decode($json);
        // $key = array_search("formatted_address", $data->results);
        $index = count($data->results) - 1;
        // dd($data->results);
        // $slides = Slider::where('location', 'like', $data->results[$index]->formatted_address)->get();
        // dd($data->results);
        $location = $data->results[3]->formatted_address;
        // $location = $data->results[$index]->formatted_address;
        // $user_ip = getenv('REMOTE_ADDR');
        // $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
        // $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $lat . "," . $lon . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");
        // $dat = json_decode($geo, true);
        // $index = count($dat->results) - 1;
        // $location = $dat->results[$index]->formatted_address;
        $response =
            [
                'statuscode' => 200,
                'message' => $location
            ];
        echo json_encode($response);
    }
    public function dispensaries()
    {
        if (!empty(session('latitude')) and !empty(session('longitude'))) {
            $latitude = session('latitude');
            $longitude = session('longitude');
        } else {
            $latitude = "34.0201613";
            $longitude = "-118.6919234";
        }
        $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");
        $dat = json_decode($geo, true);
        $location = $dat['results'][3]['formatted_address'];
        $dispensaries = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", 17000)
            ->orderBy("distance", 'asc')
            ->where('business_type', 'Dispensary')
            ->where('approve', 1)
            ->paginate(15);
        if(Session::has('customer_id')){
            TrackHistory::track_history('Dispensaries',"View All Dispensaries");
        }
        return view('dispensaries')
            ->with('location', $location)
            ->with('dispensaries', $dispensaries);
    }
    public function deliveries()
    {
        if (!empty(session('latitude')) and !empty(session('longitude'))) {
            $latitude = session('latitude');
            $longitude = session('longitude');
        } else {
            $latitude = "34.0201613";
            $longitude = "-118.6919234";
        }
        $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");
        $dat = json_decode($geo, true);
        $location = $dat['results'][3]['formatted_address'];
        $deliveries = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", 17000)
            ->orderBy("distance", 'asc')
            ->where('business_type', 'Delivery')
            ->where('approve', 1)
            ->paginate(15);
        if(Session::has('customer_id')){
            TrackHistory::track_history('Deliveries',"View All Deliveries");
        }
        return view('deliveries')
            ->with('location', $location)
            ->with('deliveries', $deliveries);
    }
    public function maps()
    {
        return;
        if (!empty(session('latitude')) and !empty(session('longitude'))) {
            $latitude = session('latitude');
            $longitude = session('longitude');
            $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");
            $dat = json_decode($geo, true);
            // dd($dat['results']);
            $index = count($dat['results']) - 1;
            $location = $dat['results'][3]['formatted_address'];
            // $location = $dat['results'][$index]['formatted_address'];
            $businesses = DB::table('businesses')
                ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", 17000)
                ->orderBy("distance", 'asc')
                ->where('approve', 1)
                ->get();
            $deals = Deal::all();
            $stores = DB::table('store_locations')
                ->selectRaw("store_locations.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", 17000)
                ->orderBy("distance", 'asc')
                ->get();
        } else {
            $businesses = Business::limit(12)->get();
            $location = "Please select your location.";
            $deals = Deal::all();
            $stores = [];
        }
        if(Session::has('customer_id')){
            TrackHistory::track_history('Maps',"View Map");
        }
        return view('maps')
            ->with('stores', $stores)
            ->with('location', $location)
            ->with('businesses', $businesses)
            ->with('deals', $deals);
    }
    public function getbusinessdetails(Request $request)
    {
        $businesses = Business::where('id', $request->business_id)->first();
        $response =
            [
                'statuscode' => 200,
                'data' => $businesses
            ];
        echo json_encode($response);
    }
    public function mapfilter($keyword)
    {
        if (!empty(session('latitude')) and !empty(session('longitude'))) {
            $latitude = session('latitude');
            $longitude = session('longitude');
            $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");
            $dat = json_decode($geo, true);
            $location = $dat['results'][3]['formatted_address'];
            if ($keyword == 'Dispensary') {
                $businesses = DB::table('businesses')
                    ->selectRaw("businesses.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                    ->having("distance", "<", 17000)
                    ->orderBy("distance", 'asc')
                    ->where('business_type', 'Dispensary')
                    ->where('approve', 1)
                    ->get();
            } elseif ($keyword == 'Delivery') {
                $businesses = DB::table('businesses')
                    ->selectRaw("businesses.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                    ->having("distance", "<", 17000)
                    ->orderBy("distance", 'asc')
                    ->where('business_type', 'Delivery')
                    ->where('approve', 1)
                    ->get();
            }
        } else {
            $latitude = "34.0201613";
            $longitude = "-118.6919234";
            $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");
            $dat = json_decode($geo, true);
            $location = $dat['results'][3]['formatted_address'];
            if ($keyword == 'Dispensary') {
                $businesses = DB::table('businesses')
                    ->selectRaw("businesses.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                    ->having("distance", "<", 17000)
                    ->orderBy("distance", 'asc')
                    ->where('business_type', 'Dispensary')
                    ->where('approve', 1)
                    ->get();
            } elseif ($keyword == 'Delivery') {
                $businesses = DB::table('businesses')
                    ->selectRaw("businesses.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                    ->having("distance", "<", 17000)
                    ->orderBy("distance", 'asc')
                    ->where('business_type', 'Delivery')
                    ->where('approve', 1)
                    ->get();
            }
        }
        $deals = Deal::all();
        $stores = DB::table('store_locations')
            ->selectRaw("store_locations.* ,
           ( 6371000 * acos( cos( radians(?) ) *
             cos( radians( latitude ) )
             * cos( radians( longitude ) - radians(?)
             ) + sin( radians(?) ) *
             sin( radians( latitude ) ) )
           ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", 17000)
            ->orderBy("distance", 'asc')
            ->get();
        return view('maps')
            ->with('location', $location)
            ->with('businesses', $businesses)
            ->with('deals', $deals)
            ->with('stores', $stores);
    }
    /*
    *  Desktop Map
    *
    */
    public function desktopMap()
    {
        return view('map.desktop-map');
    }
    public function dispensarysingle($name, $id)
    {
        $ip = DB::table('visitors')->where('visitor_ip', request()->ip())->where('business_id', $id)->first();
        if ($ip == null) {
            DB::table('visitors')->insert([
                'business_id' => $id,
                'visitor_ip' => request()->ip(),
            ]);
        }
        $dispensary = Business::where('id', $id)->first();
        if (is_null($dispensary)) {
            return redirect()->back();
        }
        if(Session::has('customer_id')){
            TrackHistory::track_history('Dispensaries',"View Dispensary( ".$dispensary->business_name.")");
        }
        if (!$dispensary->approve) {
            return redirect()->back();
        }
        $detail = Detail::where('business_id', $id)->first();
        $dispensaryBanner = DeliveryBanner::first();
        $currentDate = date('Y-m-d');
        $deals = Deal::where('retailer_id', $dispensary->id)->whereDate('ending_date', '>=' ,$currentDate)->get();
        $isReviewed = false;
        if (Session::has('customer_id')) {
            $customerId = Session::get('customer_id');
            $exist = RetailerReview::where('retailer_id', $dispensary->id)->whereNull('product_id')->where('customer_id', $customerId)->count();
            if ($exist > 0) {
                $isReviewed = true;
            }
        }
        $gallery = \Illuminate\Support\Facades\DB::table('business_galleries')->where('business_id', $id)->get();
        return view('dispensarysingle')
            ->with('delivery', $dispensary)
            ->with('deals', $deals)
            ->with('detail', $detail)
            ->with('deliveryBanner', $dispensaryBanner)
            ->with('isReviewed', $isReviewed)
            ->with('gallery', $gallery);
    }
    public function dispensarysinglecategory($name, $id, $category)
    {
        $dispensary = Business::where('id', $id)->first();
        $products = DispenseryProduct::where('dispensery_id', $id)
            ->where('category_id', $category)
            ->get();
        $allproducts = DispenseryProduct::where('dispensery_id', $id)
            ->get();
        // Categories
        $category_ids = [];
        foreach ($allproducts as $product) {
            array_push($category_ids, $product->category_id);
        }
        $cids = array_unique($category_ids);
        $categories = Category::whereIn('id', $cids)->select('id', 'name')->get();
        // Subcategories
        $subcategory_ids = [];
        foreach ($allproducts as $single) {
            array_push($subcategory_ids, $single->subcategory_ids);
        }
        $cids = array_unique($subcategory_ids);
        $subcategories = SubCategory::whereIn('id', $cids)->select('id', 'name')->get();
        $productrequests = ProductRequest::where('retailer_id', $id)->select('brand_id')->get();
        $bids = [];
        foreach ($productrequests as $req) {
            array_push($bids, $req->brand_id);
        }
        $brands = Brand::whereIn('id', $bids)->select('id', 'name', 'logo')->get();
        $reviews = RetailerReview::where('retailer_id', $id)->get();
        return view('dispensarysingle')
            ->with('dispensary', $dispensary)
            ->with('products', $products)
            ->with('reviews', $reviews)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('brands', $brands);
    }
    public function dispensarysinglesubcategory($name, $id, $subcategory)
    {
        $dispensary = Business::where('id', $id)->first();
        $products = DispenseryProduct::where('dispensery_id', $id)
            ->where('subcategory_ids', $subcategory)
            ->get();
        $allproducts = DispenseryProduct::where('dispensery_id', $id)
            ->get();
        // Categories
        $category_ids = [];
        foreach ($allproducts as $product) {
            array_push($category_ids, $product->category_id);
        }
        $cids = array_unique($category_ids);
        $categories = Category::whereIn('id', $cids)->select('id', 'name')->get();
        // Subcategories
        $subcategory_ids = [];
        foreach ($allproducts as $single) {
            array_push($subcategory_ids, $single->subcategory_ids);
        }
        $cids = array_unique($subcategory_ids);
        $subcategories = SubCategory::whereIn('id', $cids)->select('id', 'name')->get();
        $productrequests = ProductRequest::where('retailer_id', $id)->select('brand_id')->get();
        $bids = [];
        foreach ($productrequests as $req) {
            array_push($bids, $req->brand_id);
        }
        $brands = Brand::whereIn('id', $bids)->select('id', 'name', 'logo')->get();
        $reviews = RetailerReview::where('retailer_id', $id)->get();
        return view('dispensarysingle')
            ->with('dispensary', $dispensary)
            ->with('products', $products)
            ->with('reviews', $reviews)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('brands', $brands);
    }
    public function retailerproduct($business_type, $slug, $product_id)
    {
        if ($business_type == 'Dispensary') {
            $product = DispenseryProduct::where('id', $product_id)->first();
            $gallery = DispenseryProductGallery::where('dispensery_product_id', $product_id)->get();
            $retailer = Business::where('id', $product->dispensery_id)->first();
            $reviews = RetailerReview::where('product_id', $product_id)->get();
        } else {
            $product = DeliveryProducts::where('id', $product_id)->first();
            $gallery = DeliveryProductGallery::where('delivery_product_id', $product_id)->get();
            $retailer = Business::where('id', $product->delivery_id)->first();
            $reviews = RetailerReview::where('product_id', $product_id)->get();
        }
        if (!empty(session('customer_id'))) {
            $check = RecentlyViewed::where('customer_id', session('customer_id'))
                ->where('product_id', $product_id)
                ->where('type', $business_type)
                ->count();
            if ($check == 0) {
                $recentviewed = new RecentlyViewed;
                $recentviewed->customer_id = session('customer_id');
                $recentviewed->product_id = $product_id;
                $recentviewed->type = $business_type;
                $recentviewed->save();
            }
        }
        $isReviewed = false;
        if (Session::has('customer_id')) {
            $customerId = Session::get('customer_id');
            if ($business_type == 'delivery') {
                $exist = RetailerReview::where('retailer_id', $retailer->id)->whereNull('dispensary_product_id')->whereNotNull('product_id')->where('customer_id', $customerId)->count();
                if ($exist > 0) {
                    $isReviewed = true;
                }
            } else {
                $exist = RetailerReview::where('retailer_id', $retailer->id)->whereNull('product_id')->whereNotNull('dispensary_product_id')->where('customer_id', $customerId)->count();
                if ($exist > 0) {
                    $isReviewed = true;
                }
            }
        }
        $businessType = false;
        if ($business_type == 'dispensary') {
            $businessType = true;
        }
        return view('retailerproduct')
            ->with('retailer', $retailer)
            ->with('product', $product)
            ->with('gallery', $gallery)
            ->with('reviews', $reviews)
            ->with('businessType', $businessType)
            ->with('isReviewed', $isReviewed);
    }
    public function deliverysingle($name, $id)
    {
        
        $ip = DB::table('visitors')->where('visitor_ip', request()->ip())->where('business_id', $id)->first();
        if ($ip == null) {
            DB::table('visitors')->insert([
                'business_id' => $id,
                'visitor_ip' => request()->ip(),
                'created_at' => Carbon::now(),
            ]);
        }
        $delivery = Business::where('id', $id)->first();
        if (is_null($delivery)) {
            return redirect()->back();
        }
        if(Session::has('customer_id')){
            TrackHistory::track_history('Dispensaries',"View Dispensary( ".$delivery->business_name.")");
        }
        if (!$delivery->approve) {
            return redirect()->back();
        }
        $detail = Detail::where('business_id', $id)->first();
        $deliveryBanner = DeliveryBanner::first();
        $featured = DeliveryProducts::where('delivery_id', $id)
            ->where('is_featured', 1)
            ->get();
        $products = DeliveryProducts::where('delivery_id', $id)
            ->get();
        // Categories
        $category_ids = [];
        foreach ($products as $product) {
            array_push($category_ids, $product->category_id);
        }
        $cids = array_unique($category_ids);
        $categories = Category::whereIn('id', $cids)->select('id', 'name')->get();
        // Subcategories
        $subcategory_ids = [];
        foreach ($products as $single) {
            array_push($subcategory_ids, $single->subcategory_ids);
        }
        $cids = array_unique($subcategory_ids);
        $subcategories = SubCategory::whereIn('id', $cids)->select('id', 'name')->get();
        $productrequests = ProductRequest::where('retailer_id', $id)->select('brand_id')->get();
        $bids = [];
        foreach ($productrequests as $req) {
            array_push($bids, $req->brand_id);
        }
        $brands = Brand::whereIn('id', $bids)->select('id', 'name', 'logo')->get();
        $reviews = RetailerReview::where('retailer_id', $id)->get();
        $currentDate = date('Y-m-d');
        $deals = Deal::where('retailer_id', $delivery->id)->whereDate('ending_date', '>=' ,$currentDate)->get();
        $business = Business::where('id', $delivery->id)->first();
        $isReviewed = false;
        if (Session::has('customer_id')) {
            $customerId = Session::get('customer_id');
            $exist = RetailerReview::where('retailer_id', $delivery->id)->whereNull('product_id')->where('customer_id', $customerId)->count();
            if ($exist > 0) {
                $isReviewed = true;
            }
        }
        $gallery = \Illuminate\Support\Facades\DB::table('business_galleries')->where('business_id', $id)->get();
//      $fav = Favorite::where()
        return view('deliverysingle')
            ->with('delivery', $delivery)
            ->with('featured', $featured)
            ->with('products', $products)
            ->with('reviews', $reviews)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('brands', $brands)
            ->with('deals', $deals)
            ->with('detail', $detail)
            ->with('business', $business)
            ->with('deliveryBanner', $deliveryBanner)
            ->with('isReviewed', $isReviewed)
            ->with('gallery', $gallery);
    }
    public function deliverysinglecategory($name, $id, $category)
    {
        $delivery = Business::where('id', $id)->first();
        $products = DeliveryProducts::where('delivery_id', $id)
            ->where('category_id', $category)
            ->get();
        $allproducts = DeliveryProducts::where('delivery_id', $id)
            ->get();
        // Categories
        $category_ids = [];
        foreach ($allproducts as $product) {
            array_push($category_ids, $product->category_id);
        }
        $cids = array_unique($category_ids);
        $categories = Category::whereIn('id', $cids)->select('id', 'name')->get();
        // Subcategories
        $subcategory_ids = [];
        foreach ($allproducts as $single) {
            array_push($subcategory_ids, $single->subcategory_ids);
        }
        $cids = array_unique($subcategory_ids);
        $subcategories = SubCategory::whereIn('id', $cids)->select('id', 'name')->get();
        $productrequests = ProductRequest::where('retailer_id', $id)->select('brand_id')->get();
        $bids = [];
        foreach ($productrequests as $req) {
            array_push($bids, $req->brand_id);
        }
        $brands = Brand::whereIn('id', $bids)->select('id', 'name', 'logo')->get();
        $reviews = RetailerReview::where('retailer_id', $id)->get();
        return view('deliverysingle')
            ->with('delivery', $delivery)
            ->with('products', $products)
            ->with('reviews', $reviews)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('brands', $brands);
    }
    public function deliverysinglesubcategory($name, $id, $subcategory)
    {
        $delivery = Business::where('id', $id)->first();
        $products = DeliveryProducts::where('delivery_id', $id)
            ->where('subcategory_ids', $subcategory)
            ->get();
        $allproducts = DeliveryProducts::where('delivery_id', $id)
            ->get();
        // Categories
        $category_ids = [];
        foreach ($allproducts as $product) {
            array_push($category_ids, $product->category_id);
        }
        $cids = array_unique($category_ids);
        $categories = Category::whereIn('id', $cids)->select('id', 'name')->get();
        // Subcategories
        $subcategory_ids = [];
        foreach ($allproducts as $single) {
            array_push($subcategory_ids, $single->subcategory_ids);
        }
        $cids = array_unique($subcategory_ids);
        $subcategories = SubCategory::whereIn('id', $cids)->select('id', 'name')->get();
        $productrequests = ProductRequest::where('retailer_id', $id)->select('brand_id')->get();
        $bids = [];
        foreach ($productrequests as $req) {
            array_push($bids, $req->brand_id);
        }
        $brands = Brand::whereIn('id', $bids)->select('id', 'name', 'logo')->get();
        $reviews = RetailerReview::where('retailer_id', $id)->get();
        return view('deliverysingle')
            ->with('delivery', $delivery)
            ->with('products', $products)
            ->with('reviews', $reviews)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('brands', $brands);
    }
//   public function addtocartdispensary(Request $request) {
//       $dispensory_product_id = $request->dispensory_product_id;
//       $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->count();
//       if ($checkDelivery > 0) {
//           $response =
//               [
//                   'statuscode'=> 202,
//                   'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
//               ];
//           echo json_encode($response);
//       } else {
//           $check = DispensaryCart::where('customer_id', session('customer_id'))->where('product_id', $request->dispensory_product_id)->count();
//           if ($check > 0) {
//               $response =
//                   [
//                       'statuscode'=> 201,
//                       'message' => "Product Already added to cart."
//                   ];
//               echo json_encode($response);
//           } else {
//               $cart = new DispensaryCart;
//               $cart->customer_id = session('customer_id');
//               $cart->product_id = $request->dispensory_product_id;
//               $cart->qty = 1;
//               if ($cart->save()) {
//                   $response =
//                       [
//                           'statuscode'=> 200,
//                           'message' => "Product added to cart."
//                       ];
//                   echo json_encode($response);
//               } else {
//                   $response =
//                       [
//                           'statuscode'=> 400,
//                           'message' => 'Semething went wrong.'
//                       ];
//                   echo json_encode($response);
//               }
//           }
//       }
//   }
    public function updateProductPrice(Request $request, $id, $type)
    {
        if ($type == "Dispensary") {
            $dispenssary = DispenseryProduct::find($id);
            $dispenssary->price = $request->price;
            $dispenssary->flower_price_name = $request->name;
            $dispenssary->update();
            return "Dispensry";
        } else {
            $delivery = DeliveryProducts::find($id);
            $delivery->price = $request->price;
            $delivery->flower_price_name = $request->name;
            $delivery->update();
            return "Delivery";
        }
//        return true;
    }
    public function addtocartdispensary(Request $request)
    {
        $deliveryProductId = $request->dispensory_product_id;
        $businessId = $request->retailer_id;
        $qty = $request->qty;
        if ($qty == '0') {
            $qty = 1;
        }
        $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->pluck('business_id')->first();
        $dealsClaimed = DealsClaimed::where('customer_id', session('customer_id'))->get();
        if ($dealsClaimed->count() > 0) {
            $dealId = $dealsClaimed->pluck('deal_id')->first();
            $retailerId = Deal::where('id', $dealId)->pluck('retailer_id')->first();
            $delId = DispenseryProduct::where('id', $deliveryProductId)->pluck('dispensery_id')->first();
            if ($delId != $retailerId) {
                $response =
                    [
                        'statuscode' => 202,
                        'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
                    ];
                echo json_encode($response);
                return;
            }
        }
        if (!is_null($checkDelivery)) {
            $delId = DispenseryProduct::where('id', $deliveryProductId)->pluck('dispensery_id')->first();
            //   $deliveryId = DispenseryProduct::where('id', $checkDelivery)->pluck('dispensery_id')->first();
            if ($delId != $checkDelivery) {
                $response =
                    [
                        'statuscode' => 202,
                        'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
                    ];
                echo json_encode($response);
            } else {
                $check = DeliveryCart::where('customer_id', session('customer_id'))->where('product_id', $request->dispensory_product_id)->count();
                if ($check > 0) {
                    $response =
                        [
                            'statuscode' => 201,
                            'message' => "Product Already added to cart."
                        ];
                    echo json_encode($response);
                } else {
                    $cart = new DeliveryCart;
                    $cart->customer_id = session('customer_id');
                    $cart->product_id = $request->dispensory_product_id;
                    $cart->business_id = $businessId;
                    $cart->qty = $qty;
                    $cartSaved = $cart->save();
                    $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->get();
                    if ($cartSaved) {
                        $response =
                            [
                                'statuscode' => 200,
                                'message' => "Product added to cart.",
                                'cartCount' => $cartCount->sum('qty')
                            ];
                        echo json_encode($response);
                    } else {
                        $response =
                            [
                                'statuscode' => 400,
                                'message' => 'Semething went wrong.'
                            ];
                        echo json_encode($response);
                    }
                }
            }
        } else {
            $cart = new DeliveryCart;
            $cart->customer_id = session('customer_id');
            $cart->product_id = $request->dispensory_product_id;
            $cart->business_id = $businessId;
            $cart->qty = $qty;
            $cartSaved = $cart->save();
            $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->get();
            if ($cartSaved) {
                $response =
                    [
                        'statuscode' => 200,
                        'message' => "Product added to cart.",
                        'cartCount' => $cartCount->sum('qty')
                    ];
                echo json_encode($response);
            } else {
                $response =
                    [
                        'statuscode' => 400,
                        'message' => 'Semething went wrong.'
                    ];
                echo json_encode($response);
            }
        }
    }
    public function removedcartadddispansory(Request $request)
    {
        $dealsClaimed = DealsClaimed::where('customer_id', session('customer_id'))->delete();
        $dispensory_product_id = $request->dispensory_product_id;
        $businessId = $request->retailer_id;
        $qty = $request->qty;
        if ($qty == '0') {
            $qty = 1;
        }
        $removeDeliveryCart = DeliveryCart::where('customer_id', session('customer_id'))->delete();
        $cart = new DispensaryCart;
        $cart->customer_id = session('customer_id');
        $cart->product_id = $dispensory_product_id;
        $cart->business_id = $businessId;
        $cart->qty = $qty;
        if ($cart->save()) {
            $response =
                [
                    'statuscode' => 200,
                    'message' => "Product added to cart."
                ];
            echo json_encode($response);
        } else {
            $response =
                [
                    'statuscode' => 400,
                    'message' => "Something went wrong."
                ];
            echo json_encode($response);
        }
    }
//   public function addtocartdelivery(Request $request) {
//       $deliveryProductId = $request->dispensory_product_id;
//       $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->pluck('product_id')->first();
//       if(!is_null($checkDelivery)) {
//             $delId = DeliveryProducts::where('id', $deliveryProductId)->pluck('delivery_id')->first();
//             $deliveryId = DeliveryProducts::where('id', $checkDelivery)->pluck('delivery_id')->first();
//             if($delId != $deliveryId) {
//                 $response =
//                 [
//                     'statuscode'=> 202,
//                     'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
//                 ];
//                 echo json_encode($response);
//             } else {
//                 $check = DeliveryCart::where('customer_id', session('customer_id'))->where('product_id', $request->dispensory_product_id)->count();
//                 if ($check > 0) {
//                     $response =
//                         [
//                             'statuscode'=> 201,
//                             'message' => "Product Already added to cart."
//                         ];
//                     echo json_encode($response);
//                 } else {
//                     $cart = new DeliveryCart;
//                     $cart->customer_id = session('customer_id');
//                     $cart->product_id = $request->dispensory_product_id;
//                     $cart->qty = 1;
//                     $cartSaved = $cart->save();
//                     $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->count();
//                     if ($cartSaved) {
//                         $response =
//                             [
//                                 'statuscode'=> 200,
//                                 'message' => "Product added to cart.",
//                                 'cartCount' => $cartCount
//                             ];
//                         echo json_encode($response);
//                     } else {
//                         $response =
//                             [
//                                 'statuscode'=> 400,
//                                 'message' => 'Semething went wrong.'
//                             ];
//                         echo json_encode($response);
//                     }
//                 }
//             }
//         } else {
//             $cart = new DeliveryCart;
//             $cart->customer_id = session('customer_id');
//             $cart->product_id = $request->dispensory_product_id;
//             $cart->qty = 1;
//             $cartSaved = $cart->save();
//             $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->count();
//             if ($cartSaved) {
//                 $response =
//                     [
//                         'statuscode'=> 200,
//                         'message' => "Product added to cart.",
//                         'cartCount' => $cartCount
//                     ];
//                 echo json_encode($response);
//             } else {
//                 $response =
//                     [
//                         'statuscode'=> 400,
//                         'message' => 'Semething went wrong.'
//                     ];
//                 echo json_encode($response);
//             }
//        }
//   }
    public function addtocartdelivery(Request $request)
    {
        $deliveryProductId = $request->dispensory_product_id;
        $businessId = $request->retailer_id;
        $qty = $request->qty;
        if ($qty == '0') {
            $qty = 1;
        }
        $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->pluck('business_id',)->first();
        $dealsClaimed = DealsClaimed::where('customer_id', session('customer_id'))->get();
        if ($dealsClaimed->count() > 0) {
            $dealId = $dealsClaimed->pluck('deal_id')->first();
            $retailerId = Deal::where('id', $dealId)->pluck('retailer_id')->first();
            $delId = DeliveryProducts::where('id', $deliveryProductId)->pluck('delivery_id')->first();
            if ($delId != $retailerId) {
                $response =
                    [
                        'statuscode' => 202,
                        'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
                    ];
                echo json_encode($response);
                return;
            }
        }
        if (!is_null($checkDelivery)) {
            $delId = DeliveryProducts::where('id', $deliveryProductId)->pluck('delivery_id')->first();
            //   $deliveryId = DeliveryProducts::where('id', $checkDelivery)->pluck('delivery_id')->first();
            if ($delId != $checkDelivery) {
                $response =
                    [
                        'statuscode' => 202,
                        'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
                    ];
                echo json_encode($response);
            } else {
                $check = DeliveryCart::where('customer_id', session('customer_id'))->where('product_id', $request->dispensory_product_id)->count();
                if ($check > 0) {
                    $response =
                        [
                            'statuscode' => 201,
                            'message' => "Product Already added to cart."
                        ];
                    echo json_encode($response);
                } else {
                    $cart = new DeliveryCart;
                    $cart->customer_id = session('customer_id');
                    $cart->product_id = $request->dispensory_product_id;
                    $cart->qty = $qty;
                    $cart->business_id = $businessId;
                    $cartSaved = $cart->save();
                    $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->get();
                    if ($cartSaved) {
                        $response =
                            [
                                'statuscode' => 200,
                                'message' => "Product added to cart.",
                                'cartCount' => $cartCount->sum('qty')
                            ];
                        echo json_encode($response);
                    } else {
                        $response =
                            [
                                'statuscode' => 400,
                                'message' => 'Semething went wrong.'
                            ];
                        echo json_encode($response);
                    }
                }
            }
        } else {
            $cart = new DeliveryCart;
            $cart->customer_id = session('customer_id');
            $cart->product_id = $request->dispensory_product_id;
            $cart->business_id = $businessId;
            $cart->qty = $qty;
            $cartSaved = $cart->save();
            $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->get();
            if ($cartSaved) {
                $response =
                    [
                        'statuscode' => 200,
                        'message' => "Product added to cart.",
                        'cartCount' => $cartCount->sum('qty')
                    ];
                echo json_encode($response);
            } else {
                $response =
                    [
                        'statuscode' => 400,
                        'message' => 'Semething went wrong.'
                    ];
                echo json_encode($response);
            }
        }
    }
    public function removedcartadddelivery(Request $request)
    {
        $dealsClaimed = DealsClaimed::where('customer_id', session('customer_id'))->delete();
        $dispensory_product_id = $request->dispensory_product_id;
        $businessId = $request->retailer_id;
        $qty = $request->qty;
        if ($qty == '0') {
            $qty = 1;
        }
        $removeDeliveryCart = DeliveryCart::where('customer_id', session('customer_id'))->delete();
        $cart = new DeliveryCart;
        $cart->customer_id = session('customer_id');
        $cart->product_id = $dispensory_product_id;
        $cart->business_id = $businessId;
        $cart->qty = $qty;
        $cartSaved = $cart->save();
        $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->get();
        if ($cartSaved) {
            $response =
                [
                    'statuscode' => 200,
                    'message' => "Product added to cart.",
                    'cartCount' => $cartCount->sum('qty')
                ];
            echo json_encode($response);
        } else {
            $response =
                [
                    'statuscode' => 400,
                    'message' => "Something went wrong."
                ];
            echo json_encode($response);
        }
    }
    public function deals()
    {
        $slidesdesktop = [];
        if (!empty(session('latitude')) and !empty(session('longitude'))) {
            $latitude = session('latitude');
            $longitude = session('longitude');
            $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");
            $dat = json_decode($geo, true);
            $location = $dat['results'][3]['formatted_address'];
            // $location = $dat['results'][0]['address_components'][3]['long_name'];
            $businesses = Business::selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", 17000)
                ->orderBy("distance", 'asc')
                ->where('approve', 1)
                ->get();
            // $topdesktops = DealSlide::all();
            //   if($topdesktops->count() > 0) {
            //     foreach($topdesktops as $desktop) {
            //       $desktop_slide_radius = $desktop->slide_radius * 6378160;
            $slidesdesktop = DB::table('deal_slides')
                ->selectRaw("deal_slides.* ,
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
            //     }
            //   }
            $categories = Category::orderBy('id', 'DESC')->get();
        } else {
            $latitude = "34.0201613";
            $longitude = "-118.6919234";
            $location = 'Los Angeles, California, USA';
            $businesses = Business::selectRaw("businesses.* ,
           ( 6371000 * acos( cos( radians(?) ) *
             cos( radians( latitude ) )
             * cos( radians( longitude ) - radians(?)
             ) + sin( radians(?) ) *
             sin( radians( latitude ) ) )
           ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<", 17000)
                ->orderBy("distance", 'asc')
                ->where('approve', 1)
                ->limit(10)
                ->get();;
            $slidesdesktop = DB::table('deal_slides')
                ->selectRaw("deal_slides.* ,
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
            $categories = Category::orderBy('id', 'DESC')->get();
        }
//      dd($businesses);
        if(Session::has('customer_id')){
            TrackHistory::track_history('Deals',"View All Deals");
        }
        return view('deals')
            ->with('dealSlides', $slidesdesktop)
            ->with('location', $location)
            ->with('businesses', $businesses)
            ->with('categories', $categories);
    }
//   public function strains() {
//       $posts = StrainPost::orderBy('id', 'DESC')->get();
//       return view('strains')
//           ->with('posts', $posts);
//   }
    public function strains()
    {
        $strainBanner = StrainBanner::where('id', 1)->first();
        $posts = StrainPost::orderBy('id', 'DESC')->get();
        return view('strains')
            ->with('posts', $posts)
            ->with('strainBanner', $strainBanner);
    }
    public function strainsingle($id)
    {
        $post = StrainPost::where('id', $id)->first();
        return view('strainsingle')
            ->with('post', $post);
    }
    public function searchstrain(Request $request)
    {
        $string = $request->search;
        $searchValues = preg_split('/\s+/', $string, -1, PREG_SPLIT_NO_EMPTY);
        $posts = StrainPost::where(function ($q) use ($searchValues) {
            foreach ($searchValues as $value) {
                $q->orWhere('description', 'like', "%{$value}%");
            }
        })->get();
        // $posts = StrainPost::where('description', 'like', '%$request->search%')->get();
        return view('strains')
            ->with('posts', $posts);
    }
    public function categories()
    {
        $categories = Category::with('types')
            ->get();
        return view('categories')
            ->with('categories', $categories);
    }
    public function gettypesubcategories(Request $request)
    {
        $category_id = $request->category_id;
        $types = CategoryType::where('category_id', $category_id)->get();
        $data = '
          <div class="row categoriesCols">
              ';
        foreach ($types as $type) {
            $data .= '
                  <div class="col-md-3">
                      <h6 class="pb-2"><strong>' . $type->name . '</strong></h6>
                      <ul class="list-unstyled">';
            $subcategories = SubCategory::where('type_id', $type->id)->where('parent_id', 0)->get();
            foreach ($subcategories as $subcat) {
                $data .= '
                              <li class="mb-2">
                                  <label>
                                      <input rel="' . $subcat->name . '" type="radio" class="childOfParentSC" name="type_' . $type->name . '" value="' . $subcat->id . '" required=""> ' . $subcat->name . ' <a href="' . route("categorywisewise", ["catname" => $subcat->name]) . '">&nbsp;<i class="fas fa-sign-out-alt"></i></a>
                                  </label>
                              </li>
                          ';
            }
            $data .= '</ul>
                  </div>';
        }
        $data .= "
              <script>
                  $('.childOfParentSC').on('click', function() {
                      var subcat_id = $(this).val();
                      var type_name = $(this).attr('rel');
                      var selected = $(this).attr('rel');
                      var main = $('.selectedcats').text();
                      $('#categoryTypes').addClass('loader');
                      $.ajax({
                          headers: {
                            'X-CSRF-TOKEN': '" . csrf_token() . "'
                          },
                          url:'" . route("getparentchildsubcat") . "',
                          method:'POST',
                          data:{subcat_id:subcat_id, type_name:type_name},
                          success:function(data) {
                              $('.subchild').remove();
                              $('.categoriesCols').append(data);
                              let str = main;
                              if(str.includes(selected)) {
                              } else {
                                  $('.selectedcats').html(main + selected + ', ');
                              }
                              $('#categoryTypes').removeClass('loader');
                          }
                      });
                  });
              </script>
          </div>
          ";
        $response = [
            'statuscode' => 200,
            'data' => $data
        ];
        echo json_encode($response);
    }
    public function getparentchildsubcat(Request $request)
    {
        $subcategories = SubCategory::where('parent_id', $request->subcat_id)->get();
        $data = '';
        if ($subcategories->count() > 0) {
            $data .= '
              <div class="col-md-3 subchild">
                  <h6 class="pb-2"><strong>' . $request->type_name . ' Type</strong></h6>
                  <ul class="list-unstyled">';
            foreach ($subcategories as $subcat) {
                $data .= '
                          <li class="mb-2">
                              <label>
                                  <a href="' . route("categorywisewise", ["catname" => $subcat->name]) . '">' . $subcat->name . ' &nbsp;<i class="fas fa-sign-out-alt"></i></a>
                              </label>
                          </li>
                      ';
            }
            $data .= '</ul>
              </div>
              <script>
                  $(".childOfParentSC").on("click", function(){
                      var selected = $(this).attr("rel");
                      var main = $(".selectedcats").text();
                      let str = main;
                      if(str.includes(selected)) {
                          main.replace(selected+", ","");
                      } else {
                          $(".selectedcats").html(main + selected + ", ");
                      }
                  });
              </script>
              ';
            echo $data;
        }
    }
    public function categorywisewise($catname)
    {
        $searchValues = preg_split('/\s+/', $catname, -1, PREG_SPLIT_NO_EMPTY);
        $products = BrandProduct::with('reviews')
            ->where('status', 1)
            ->where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $q->orWhere('brand_products.subcategory_names', 'like', "%{$value}%");
                    $q->orWhere('brand_products.name', 'like', "%{$value}%");
                    $q->orWhere('brand_products.description', 'like', "%{$value}%");
                }
            })->get();
        return view('categorywisewise')
            ->with('products', $products);
    }
    public function signin()
    {
        return view('signin');
    }
    public function signup()
    {
        return view('signup');
    }
    public function forgotpassword()
    {

        return view('forgotpassword');
    }
    public function checkPasswordEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->remember_token= 0;
        $user->update();
        if ($user) {
            dispatch(new ForgotPasswordMailJob($request->email,$user));
            return redirect()->back()->with('info', 'Password reset email sent to your email, Please check your email for reset password!');
        } else {
            return redirect()->back()->with('error', 'Email Don\'t Exists');
        }
    }
    public function checkBusinessPasswordEmail(Request $request)
    {
        $business = Business::where('email', $request->email)->first();
        if ($business) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                Mail::to($request->email)->send(new ForgotPassword($user));
                return redirect()->back()->with('info', 'Password reset email sent to your email, Please check your email for reset password!');
            } else {
                $user = new User();
                $user->name = $business->business_name;
                $user->email = $business->email;
                $user->password = Hash::make('12345678');
                $user->save();
                Mail::to($request->email)->send(new ForgotPassword($user));
                return redirect()->back()->with('info', 'Password reset email sent to your email, Please check your email for reset password!');
            }
        } else {
            return redirect()->back()->with('error', 'Email Don\'t Exists');
        }
    }
    public function resetPassword($userId)
    {
        $id = base64_decode($userId);
        $user = User::find($id);
        if($user->remember_token==1){
           abort(404);
        }else{
        return view('resetPasswordEmail', compact('id'));

        }
    }
    public function changePassword(Request $request)
    {
        if ($request->password != $request->confirm_password) {
            return redirect()->back()->with('error', 'Passwords do not match.');
        }
        $user = User::find($request->user_id);
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->update();
            return redirect()->back()->with('info', 'Password Change Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something is wrong contact with developer');
        }
    }
    public function updatePassword(Request $request)
    {
        if ($request->password != $request->confirm_password) {
            return redirect()->back()->with('error', 'Passwords do not match.');
        }
        $user = User::find($request->user_id);
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->remember_token =1;
            $user->update();
            \Illuminate\Support\Facades\Session::put('customer_id', $user->id);
            \Illuminate\Support\Facades\Session::put('customer_name', $user->name);
            \Illuminate\Support\Facades\Session::put('customer_email', $user->email);
            return redirect()->route('profile');
        } else {
            return "Password not Updated";
        }
    }
    public function cart()
    {
        $business = "";
        $deliveryCart = DeliveryCart::where('customer_id', session('customer_id'))->get();
        if ($deliveryCart->count() > 0) {
            //   $productId = $deliveryCart->pluck('product_id')->first();
            //   $isDelivery = DeliveryProducts::where('id', $productId)->count();
            $businessId = $deliveryCart->pluck('business_id')->first();
            $isDelivery = Business::where('id', $businessId)->where('business_type', 'delivery')->count();
            if ($isDelivery) {
                $deliveryCart = DeliveryCart::join('delivery_products', 'delivery_carts.product_id', '=', 'delivery_products.id')
                    ->where('delivery_carts.customer_id', '=', session('customer_id'))
                    ->select(
                        'delivery_carts.id AS cartid',
                        'delivery_carts.product_id',
                        'delivery_products.delivery_id',
                        'delivery_products.name',
                        'delivery_products.image',
                        'delivery_products.flower_price_name',
                        'delivery_products.price AS price',
                        'delivery_carts.qty'
                    )
                    ->get();
            } else {
                $deliveryCart = DeliveryCart::join('dispensery_products', 'delivery_carts.product_id', '=', 'dispensery_products.id')
                    ->where('delivery_carts.customer_id', '=', session('customer_id'))
                    ->select(
                        'delivery_carts.id AS cartid',
                        'delivery_carts.product_id',
                        'dispensery_products.dispensery_id',
                        'dispensery_products.name',
                        'dispensery_products.image',
                        'dispensery_products.flower_price_name',
                        'dispensery_products.price AS price',
                        'delivery_carts.qty'
                    )
                    ->get();
            }
        }
        $dealsClaimed = DealsClaimed::where('customer_id', session('customer_id'))->join('deals', 'deals.id', '=', 'deals_claimeds.deal_id')
            ->get();
        $deliverySingle = DeliveryCart::where('customer_id', session('customer_id'))->first();
        $dealSingle = DealsClaimed::where('customer_id', session('customer_id'))->first();
        $deliveryId = "";
        if (!is_null($deliverySingle)) {
            $deliveryId = $deliverySingle->business_id;
        } elseif (!is_null($dealSingle)) {
            $deliveryId = Deal::where('id', $dealSingle->deal_id)->pluck('retailer_id')->first();
        }
        $business = Business::where('id', $deliveryId)->first();
        return view('carts')
            ->with('business', $business)
            ->with('deliverycart', $deliveryCart)
            ->with('dealsClaimed', $dealsClaimed);
    }
    public function deletedeliverycartitem($id)
    {
        $item = DeliveryCart::find($id);
        $item->delete();
        return redirect()->back()->with('error', 'Product removed.');
    }
    public function notifications()
    {
//        dd(Session('customer_id'));
        $notifications = Notifications::where('customer_id', Session('customer_id'))->orderBy('id', 'DESC')->get();
        return view('notifications', compact('notifications'));
    }
    public function notificationread($id)
    {
        $notifications = Notifications::where('id', $id)->update(['status' => 1]);
        return response()->json('success');
    }
    public function favorites()
    {
        $favorites = Favorite::where('customer_id', session('customer_id'))->get();
        return view('favorites')
            ->with('favorites', $favorites);
    }
    public function addabusiness()
    {
        $state = \Illuminate\Support\Facades\DB::table('states')->get();
        return view('addabusiness', compact('state'));
    }
    public function saveabusiness(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email|unique:users'
        ]);
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
            'role' => 'required',
            'business_name' => 'required',
            'business_type' => 'required',
            'business_phone_number' => 'required',
            'country' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'state_province' => 'required',
        ]);
        if ($request->password != $request->confirm_password) {
            return redirect()->back()->with('error', 'Passwords do not match.')->withInput();
        }
        $businessTypes = ['Brand', 'Delivery', 'Dispensary'];
        if (!in_array($request->business_type, $businessTypes)) {
            return redirect()->back()->with('error', 'Sorry something went wrong.')->withInput();
        } else {
            $business = Business::where('email', $request->email)->where('business_type', $request->business_type)->first();
            if (!is_null($business)) {
                return redirect()->back()->with('error', 'Email already exist.')->withInput();
            }
        }
        $business = new Business;
        $business->first_name = $request->first_name;
        $business->last_name = $request->last_name;
        $business->phone_number = $request->business_phone_number;
        $business->email = $request->email;
        $business->password = Hash::make($request->password);
        $business->role = $request->role;
        $business->business_name = $request->business_name;
        $business->slug = Str::slug($request->business_name);
        $business->business_type = $request->business_type;
        $business->business_phone_number = $request->business_phone_number;
        $business->country = $request->country;
        $business->address_line_1 = $request->address_line_1;
        $business->address_line_2 = $request->address_line_2;
        $business->city = $request->city;
        $business->profile_picture = "https://420finder.net/assets/img/logo.png";
        $business->state_province = $request->state_province;
        $business->postal_code = $request->postal_code;
        $business->website = $request->website;
        $business->license_number = $request->license_number;
        $business->license_type = $request->license_type;
        $business->license_expiration = $request->license_expiration;
        $business->latitude = $request->latitude;
        $business->longitude = $request->longitude;
        $business->status = 1;
        if ($business->save()) {
            $user = new User;
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->profile = "https://420finder.net/assets/img/logo.png";
            $user->password = Hash::make($request->password);
            $user->save();
            if($request->business_type == "Brand") {
                \Illuminate\Support\Facades\DB::table('brand_addresses')->insertGetId([
                    'state_id' => $request->state_province, 'brand_id' => $business->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
                ]);
            }
            Session::put('customer_id', $user->id);
            Session::put('customer_name', $user->name);
            Session::put('customer_email', $user->email);
            dispatch(new AddBusinessMailJob($request->email,$business));
            return redirect()->route('businesssubmitted')->with('info', 'Your business details are submitted. Our account manager will process your submitted information and reach out to your soon.');
        } else {
            return redirect()->back()->with('error', 'Problem saving your business details.')->withInput();
        }
    }
    public function savenewstore(Request $request)
    {
        $business = new Business;
        $business->first_name = $request->first_name;
        $business->last_name = $request->last_name;
        $business->phone_number = $request->phone_number;
        $check = Business::where('email', session('business_email'))->first();
        $business->email = session('business_email');
        $business->password = $check->password;
        $business->role = $request->role;
        $business->business_name = $request->business_name;
        $business->slug = Str::slug($request->business_name);
        $business->business_type = $request->business_type;
        $business->country = $request->country;
        $business->address_line_1 = $request->address_line_1;
        $business->address_line_2 = $request->address_line_2;
        $business->city = $request->city;
        $business->state_province = $request->state_province;
        $business->postal_code = $request->postal_code;
        $business->website = $request->website;
        $business->license_number = $request->license_number;
        $business->license_type = $request->license_type;
        $business->license_expiration = $request->license_expiration;
        $business->status = 1;
        if ($business->save()) {
            $checkEmail = User::where('email', $request->email)->count();
            if ($checkEmail > 0) {
                return redirect()->back()->with('error', 'Email already exists.');
            } else {
                $user = new User;
                $user->name = $request->first_name . ' ' . $request->last_name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->back()->with('info', 'Your store has been created.');
            }
        } else {
            return redirect()->back()->with('error', 'Problem saving your business details.');
        }
    }
    public function businesssubmitted()
    {
        return view('businesssubmitted');
    }
    public function brands()
    {
        if (!empty(session('latitude')) and !empty(session('longitude'))) {
            $latitude = session('latitude');
            $longitude = session('longitude');
        } else {
            $latitude = 34.0522342;
            $longitude = -118.2436849;
        }
        $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");
        $dat = json_decode($geo, true);
        $location = $dat['results'][3]['formatted_address'];
//          dd($dat['results'][0]['address_components'][3]['long_name']);
//           $state = $dat['results'][0]['address_components'][4]['long_name'];
        $getstate = $dat['results'][0]['address_components'];
        $state = 5;
        foreach ($getstate as $row) {
            if ($row['types'][0] == 'administrative_area_level_1') {
                $state = $row['long_name'];
            }
        }
//           for($i=1, $i<=cont($getstate), $i++){
//
//           }
        $state_id = DB::table('states')->where('name', $state)->first();
        if ($state_id != null) {
            $brands_id = DB::table('brand_addresses')
                ->where('state_id', $state_id->id)
                ->where('status', '1')
                ->pluck('brand_id');
            $brands = DB::table('businesses')
                ->whereIn('id', $brands_id)
                ->where('business_type', 'Brand')
                ->where('status', 1)
                ->where('approve', 1)
                ->get();
//            dd($brands_id);
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
        } else {
            $brands = [];
            $brandslides = [];
        }
        return view('brands')
            ->with('location', $location)
            ->with('brands', $brands)
            ->with('brandSlides', $brandslides)
            ->with('state', $state);
    }
    public function brandsingle($id)
    {
        $business = Business::where('id', $id)->first();
        if (is_null($business)) {
            return redirect()->route('index');
        } else if ($business->type == 'Delivery') {
            return redirect()->route('deliverysingle', [
                'slug' => $business->slug??"retailer",
                'id' => $business->id
            ]);
        } else if ($business->type == 'Dispensary') {
            return redirect()->route('dispensarysingle', [
                'slug' => $business->slug??"retailer",
                'id' => $business->id
            ]);
        }
        $brand = Business::find($id);
        $feeds = BrandFeed::where('brand_id', $id)->get();
        $featuredproducts = BrandProduct::with('reviews')->where('brand_id', $id)
            ->where('is_featured', 1)
            ->where('status', 1)
            ->get();
        $products = BrandProduct::with('reviews')->where('brand_id', $id)
            ->where('status', 1);
        $retailerId = ProductRequest::where('brand_id', $brand->id)->pluck('retailer_id');
        $retailers = Business::wherein('id', $retailerId)->get();
        return view('brandsingle')
            ->with('brand', $brand)
            ->with('feeds', $feeds)
            ->with('featuredproducts', $featuredproducts)
            ->with('products', $products)
            ->with('retailers', $retailers);
    }
    public function brandproductsingle($slug, $id)
    {
        $id = decrypt($id);
        $product = BrandProduct::with('reviews')->with('gallery')->where('id', $id)->first();
        // dd($product);
        return view('brandproductsingle')
            ->with('product', $product);
    }
    public function favoritebrand(Request $request)
    {
        $check = Favorite::where('customer_id', session('customer_id'))
            ->where('type_id', $request->brand_id)
            ->where('fav_type', $request->fav_type)
            ->count();
        if ($check > 0) {
            $response = [
                'statuscode' => 400,
                'message' => 'Already added to favorite.'
            ];
            echo json_encode($response);
        } else {
            $fav = new Favorite;
            $fav->customer_id = session('customer_id');
            $fav->type_id = $request->brand_id;
            $fav->fav_type = $request->fav_type;
            if ($fav->save()) {
                $response = [
                    'statuscode' => 200,
                    'message' => 'Added to favorite.'
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'statuscode' => 400,
                    'message' => 'Something went wrong.'
                ];
                echo json_encode($response);
            }
        }
    }
    public function favbrandproduct(Request $request)
    {
        $check = Favorite::where('customer_id', session('customer_id'))
            ->where('type_id', $request->brand_product_id)
            ->where('fav_type', $request->fav_type)
            ->count();
        if ($check > 0) {
            $response = [
                'statuscode' => 400,
                'message' => 'Already added to favorite.'
            ];
            echo json_encode($response);
        } else {
            $fav = new Favorite;
            $fav->customer_id = session('customer_id');
            $fav->type_id = $request->brand_product_id;
            $fav->fav_type = $request->fav_type;
            if ($fav->save()) {
                $response = [
                    'statuscode' => 200,
                    'message' => 'Added to favorite.'
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'statuscode' => 400,
                    'message' => 'Something went wrong.'
                ];
                echo json_encode($response);
            }
        }
    }
    public function favdispensary(Request $request)
    {
        $check = Favorite::where('customer_id', session('customer_id'))
            ->where('type_id', $request->dispensary_id)
            ->where('fav_type', $request->fav_type)
            ->count();
        if ($check > 0) {
            $response = [
                'statuscode' => 400,
                'message' => 'Already added to favorite.'
            ];
            echo json_encode($response);
        } else {
            $fav = new Favorite;
            $fav->customer_id = session('customer_id');
            $fav->type_id = $request->dispensary_id;
            $fav->fav_type = $request->fav_type;
            if ($fav->save()) {
                $response = [
                    'statuscode' => 200,
                    'message' => 'Added to favorite.'
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'statuscode' => 400,
                    'message' => 'Something went wrong.'
                ];
                echo json_encode($response);
            }
        }
    }
    public function favretailerproduct(Request $request)
    {
        $check = Favorite::where('customer_id', session('customer_id'))
            ->where('type_id', $request->retailer_id)
            ->where('fav_type', $request->fav_type)
            ->count();
        if ($check > 0) {
            $response = [
                'statuscode' => 400,
                'message' => 'Already added to favorite.'
            ];
            echo json_encode($response);
        } else {
            $fav = new Favorite;
            $fav->customer_id = session('customer_id');
            $fav->type_id = $request->retailer_id;
            $fav->fav_type = $request->fav_type;
            if ($fav->save()) {
                $response = [
                    'statuscode' => 200,
                    'message' => 'Added to favorite.'
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'statuscode' => 400,
                    'message' => 'Something went wrong.'
                ];
                echo json_encode($response);
            }
        }
    }
    public function favdelivery(Request $request)
    {
        $check = Favorite::where('customer_id', session('customer_id'))
            ->where('type_id', $request->delivery_product_id)
            ->where('fav_type', $request->fav_type)
            ->count();
        if ($check > 0) {
            $response = [
                'statuscode' => 400,
                'message' => 'Already added to favorite.'
            ];
            echo json_encode($response);
        } else {
            $fav = new Favorite;
            $fav->customer_id = session('customer_id');
            $fav->type_id = $request->delivery_product_id;
            $fav->fav_type = $request->fav_type;
            if ($fav->save()) {
                $response = [
                    'statuscode' => 200,
                    'message' => 'Added to Favorite..!'
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'statuscode' => 400,
                    'message' => 'Something went wrong.'
                ];
                echo json_encode($response);
            }
        }
    }
    public function unfavdelivery(Request $request)
    {
        $check = Favorite::where('customer_id', session('customer_id'))
            ->where('type_id', $request->delivery_product_id)
            ->where('fav_type', $request->fav_type)
            ->count();
        if ($check > 0) {
            $fav = Favorite::where('customer_id', session('customer_id'))
                ->where('type_id', $request->delivery_product_id)
                ->where('fav_type', $request->fav_type)
                ->delete();
            if ($fav) {
                $response = [
                    'statuscode' => 200,
                    'message' => 'Removed From Favorite..!'
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'statuscode' => 400,
                    'message' => 'Something went wrong.'
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                'statuscode' => 400,
                'message' => 'Already added to unfavorite.'
            ];
            echo json_encode($response);
        }
    }
    public function termsofuse()
    {
        $terms = TermOfUse::all();
        return view('termsofuse')
            ->with('terms', $terms);
    }
    public function privacypolicy()
    {
        $policy = Admin::select('privacypolicy')->first();
        return view('privacypolicy')
            ->with('policy', $policy);
    }
    public function cookiepolicy()
    {
        $cookie = Admin::select('cookiepolicy')->first();
        return view('cookiepolicy')
            ->with('cookie', $cookie);
    }
    public function referalprogram()
    {
        $referral = Admin::select('referalprogram')->first();
        return view('referalprogram')
            ->with('referral', $referral);
    }
    public function business()
    {
        return view('business');
    }
    public function businesspages()
    {
        return view('businesspages');
    }
    public function businessads()
    {
        return view('businessads');
    }
    public function businessdeals()
    {
        return view('businessdeals');
    }
    public function businessorders()
    {
        return view('businessorders');
    }
    public function stores()
    {
        $stores = Business::where('email', session('business_email'))->get();
        return view('business.stores.index')
            ->with('stores', $stores);
    }
    public function addnewstore()
    {
        return view('business.stores.create');
    }
    public function landing()
    {
        return view('landing');
    }
}

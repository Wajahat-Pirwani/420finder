<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\BusinessResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\GeneticResource;
use App\Http\Resources\MapResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\StrainResource;
use App\Models\Brand;
use App\Models\Business;
use App\Models\Category;
use App\Models\DispenseryProduct;
use App\Models\Genetic;
use App\Models\Strain;
use App\Scoping\Scopes\BrandlistScope;
use App\Scoping\Scopes\BrandScope;
use App\Scoping\Scopes\CanibiesScope;
use App\Scoping\Scopes\CategoryScope;
use App\Scoping\Scopes\DispenseryScope;
use App\Scoping\Scopes\GeneticScope;
use App\Scoping\Scopes\PriceScope;
use App\Scoping\Scopes\RelevanceScope;
use App\Scoping\Scopes\SearchScope;
use App\Scoping\Scopes\StrainScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DispensaryProductController extends Controller
{
    public function index()
    {
        if (!request()->has('initial')) {
            $products = DispenseryProduct::where('status', 1)->withScopes($this->scopes())->orderBy('is_featured', 'desc')->with('business')->paginate(10);
            $productCount = DispenseryProduct::where('status', 1)->withScopes($this->scopes())->orderBy('is_featured', 'desc')->count();
            $products = ProductResource::collection($products)->additional(['product_count' => $productCount]);
//            return response($products,200);
            return $products;
        } else {
            $requestData = request()->all();
            $products = DispenseryProduct::where('status', 1)->where([
                ['dispensery_id', $requestData['delivery']],
                ['is_featured', 0]
            ])->withCount([
                'reviews as reviewCount',
                'reviews as rating' => function ($query) {
                    $query->select(DB::raw('coalesce(avg(rating),0)'));
                }
            ])->with('business')->paginate(10);
            $productCount = DispenseryProduct::where('status', 1)->where([
                ['dispensery_id', $requestData['delivery']],
            ])->count();
            return ProductResource::collection($products)->additional(['product_count' => $productCount]);
        }
    }
    protected function scopes()
    {
        return [
            'delivery' => new DispenseryScope(),
            'category' => new CategoryScope(),
            'brand' => new BrandScope(),
            'brandlist' => new BrandlistScope(),
            'search' => new SearchScope(),
            'genetic' => new GeneticScope(),
            'strain' => new StrainScope(),
            'canibies' => new CanibiesScope(),
            'price' => new PriceScope(),
            'relevance' => new RelevanceScope(),
        ];
    }
    public function index2()
    {
        if (!request()->has('initial')) {
            $products = DispenseryProduct::where('status', 1)->where('verify', '=', 1)->with('business')->paginate(10);
            $productCount = DispenseryProduct::where('status', 1)->where('verify', '=', 1)->count();
            $products = ProductResource::collection($products)->additional(['product_count' => $productCount]);
            return $products;
        } else {
            $requestData = request()->all();
            $products = DispenseryProduct::where('status', 1)->where([
                ['dispensery_id', $requestData['delivery']],
                ['is_featured', 0]
            ])->withCount([
                'reviews as reviewCount',
                'reviews as rating' => function ($query) {
                    $query->select(DB::raw('coalesce(avg(rating),0)'));
                }
            ])->with('business')->paginate(10);
            $productCount = DispenseryProduct::where('status', 1)->where([
                ['dispensery_id', $requestData['delivery']],
            ])->count();
            return ProductResource::collection($products)->additional(['product_count' => $productCount]);
        }
    }
    public function searchNavProducts(Request $request)
    {
        if (!empty($request->search) && (strlen($request->search >= 2))) {
            $businesses = Business::where('business_name', 'like', '%' . $request->search . '%')->limit(7)->where('approve', 1)->get();
            return BusinessResource::collection($businesses);
        }
    }
    // ================ GET FEATURED PRODUCTS ===================
    public function getFeaturedProducts()
    {
        $requestData = request()->all();
        $featuredProducts = DispenseryProduct::where('status', 1)->where([
            ['dispensery_id', $requestData['delivery']],
            ['is_featured', 1]
        ])->with('business')->get();
        $featuredProducts = ProductResource::collection($featuredProducts);
        return $featuredProducts;
    }
    // ================ GET ALL CATEGORIES ======================
    public function getCategories($deliveryId)
    {
        $categoryIds = DispenseryProduct::where('status', 1)->where('dispensery_id', $deliveryId)->select('category_id')->groupBy('category_id')->get();
        $categories = [];
        foreach ($categoryIds as $category) {
            array_push($categories, $category->category_id);
        }
        $categories = Category::whereIn('id', $categories)->get();
        return CategoryResource::collection($categories);
    }
    // ================ GET ALL PRODUCT BRAND ===================
    public function getBrand($deliveryId)
    {
        $deliveryBrands = DispenseryProduct::where('status', 1)->where('dispensery_id', $deliveryId)->select('brand_id')->groupBy('brand_id')->get();
        $brands = [];
        foreach ($deliveryBrands as $brand) {
            array_push($brands, $brand->brand_id);
        }
        $brands = Brand::whereIn('id', $brands)->get();
        return BrandResource::collection($brands);
    }
    // ================ GET DELIVERY STRAINS =========================
    public function getStrains($deliveryId)
    {
        $strainIds = DispenseryProduct::where('status', 1)->where('dispensery_id', $deliveryId)->select('strain_id')->groupBy('strain_id')->pluck('strain_id')->toArray();
        $strains = Strain::whereIn('id', $strainIds)->get();
        return StrainResource::collection($strains);
    }
    // ================ GET ALL GENETICS ========================
    public function getGenetics($deliveryId)
    {
        $geneticIds = DispenseryProduct::where('status', 1)->where('dispensery_id', $deliveryId)->select('genetic_id')->groupBy('genetic_id')->pluck('genetic_id')->toArray();
        $genetics = Genetic::whereIn('id', $geneticIds)->get();
        return GeneticResource::collection($genetics);
    }
    // ================ GET ALL CANNABS ========================
    public function getCannabs($deliveryId)
    {
        $thc = DispenseryProduct::where('status', 1)->where('dispensery_id', $deliveryId)->whereNotNull('thc_percentage')->count();
        $cbd = DispenseryProduct::where('status', 1)->where('dispensery_id', $deliveryId)->whereNotNull('cbd_percentage')->count();
        return response()->json([
            'thc' => $thc,
            'cbd' => $cbd
        ]);
    }
    // ================ SEARCH BRAND ==========================
    public function searchBrand($deliveryId, $searchQuery)
    {
        $brands = DispenseryProduct::where('status', 1)->where('dispensery_id', $deliveryId)
            ->where('brand_id', '!=', 0)->groupBy('brand_id')->pluck('brand_id');
        $brands = Brand::whereIn('id', $brands)->where('name', 'like', '%' . $searchQuery . '%')->get();
        return BrandResource::collection($brands);
    }

    public function productsCategory()
    {
        $requestData = request()->all();
        $latitude = $requestData['latitude'];
        $longitude = $requestData['longitude'];
        $categoryId = $requestData['category_id'];
        $deliveryIds = DispenseryProduct::where('status', 1)->where('category_id', $categoryId)->pluck('dispensery_id')->toArray();
        $deliveryIds = array_unique($deliveryIds);
        $businessDelivery = Business::whereIn('id', $deliveryIds)->selectRaw("businesses.* ,
        ( 6371000 * acos( cos( radians(?) ) *
        cos( radians( latitude ) )
        * cos( radians( longitude ) - radians(?)
        ) + sin( radians(?) ) *
        sin( radians( latitude ) ) )
        ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", 250000)
            ->withCount([
                'reviews as reviewCount',
                'reviews as rating' => function ($query) {
                    $query->select(DB::raw('coalesce(avg(rating),0)'));
                }
            ])
            ->orderBy("distance", 'asc')->where('approve', 1)->limit(3)->get();
        return MapResource::collection($businessDelivery)->additional(['routeMap' => route('desktop-map')]);
    }
}

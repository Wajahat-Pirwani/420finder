<?php

use App\Http\Controllers\Api\AfterLoginApplicationController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DetailsController;
use App\Http\Controllers\Api\DispensaryProductController;
use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\MenuReviewController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/products/search', [ProductController::class, 'searchNavProducts']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/featured-products', [ProductController::class, 'getFeaturedProducts']);
Route::get('/products/get-categories/{id}', [ProductController::class, 'getCategories']);
Route::get('/products/get-brand/{id}', [ProductController::class, 'getBrand']);
Route::get('/products/get-strains/{id}', [ProductController::class, 'getStrains']);
Route::get('/products/get-genetics/{id}', [ProductController::class, 'getGenetics']);
Route::get('/products/get-cannabs/{id}', [ProductController::class, 'getCannabs']);
Route::get('/products/search-brand/{id}/{search}', [ProductController::class, 'searchBrand']);
// Products Category
Route::get("/products/category", [ProductController::class, 'productsCategory']);
// ===================== Dispensary Product ========================
Route::get('/products/dispensary', [DispensaryProductController::class, 'index']);
Route::get('/products/dispensaryyy', [DispensaryProductController::class, 'index2']);
Route::get('/featured-products/dispensary', [DispensaryProductController::class, 'getFeaturedProducts']);
Route::get('/products/dispensary/get-categories/{id}', [DispensaryProductController::class, 'getCategories']);
Route::get('/products/dispensary/get-brand/{id}', [DispensaryProductController::class, 'getBrand']);
Route::get('/products/dispensary/get-strains/{id}', [DispensaryProductController::class, 'getStrains']);
Route::get('/products/dispensary/get-genetics/{id}', [DispensaryProductController::class, 'getGenetics']);
Route::get('/products/dispensary/get-cannabs/{id}', [DispensaryProductController::class, 'getCannabs']);
Route::get('/products/dispensary/search-brand/{id}/{search}', [DispensaryProductController::class, 'searchBrand']);
// Products Category
Route::get("/products/dispensary/category", [DispensaryProductController::class, 'productsCategory']);
// ======================= DESKTOP MAP ==============================
Route::get('/map', [MapController::class, 'map']);
Route::get('/map/categories', [MapController::class, 'categories']);
Route::get('/map/get-retailer-details/{id}', [MapController::class, 'getRetailerDetails']);
Route::get('/map/get-retailer-reviews/{id}', [MapController::class, 'getRetailerReviews']);
Route::get('/map/get-all-stores/{lat}/{lng}', [MapController::class, 'getAllStores']);
Route::get('/menu/get-retailer-reviews/{id}', [MenuReviewController::class, 'getRetailerReviews']);
Route::get('/menu/get-product-reviews/{retailerId}/{productId}/{businessType}', [MenuReviewController::class, 'getProductReviews']);
Route::get('/delivery/details/map', [DetailsController::class, 'index']);
Route::get('/rating/get/{id}', [RatingController::class, 'index']);
Route::get('/states', [StateController::class, 'index']);

//Mobile Application apis

Route::get('/settings', [ApplicationController::class, 'settings']);
Route::get('/slides/{lat}/{long}', [ApplicationController::class, 'slides']);
Route::get('/middle/slides/{lat}/{long}', [ApplicationController::class, 'middleSLides']);
Route::get('/brand/slides/{lat}/{long}', [ApplicationController::class, 'brandSlides']);
Route::get('/top/10/{lat}/{long}', [ApplicationController::class, 'top10']);
Route::get('/deals/{lat}/{long}', [ApplicationController::class, 'deals']);
Route::get('/{business_type}/all/{lat}/{long}', [ApplicationController::class, 'businesses']);
Route::get('/brands/{lat}/{long}', [ApplicationController::class, 'brands']);
Route::get('/single/business/{business_id}', [ApplicationController::class, 'singleBusiness']);
Route::get('/single/product/{business_type}/{product_id}', [ApplicationController::class, 'singleProduct']);
Route::get('/business/reviews/{business_id}/{product_id}', [ApplicationController::class, 'businessReviews']);
Route::get('/business/reviews/detail/{business_id}/{product_id}', [ApplicationController::class, 'reviewsData']);
Route::get('/business/gallery/{business_id}', [ApplicationController::class, 'businessGallery']);
Route::get('/single/business/deals/{business_id}', [ApplicationController::class, 'singleBusinessDeals']);
Route::get('/map/{lat}/{long}/{business_type}/{filter_type}', [ApplicationController::class, 'map']);
Route::get('/mapall', [ApplicationController::class, 'mapall']);

Route::get('/products/{business_type}/{business_id}', [ApplicationController::class, 'products']);
Route::get('/products/categories/{business_type}/{business_id}', [ApplicationController::class, 'productsWithCategories']);
Route::get('/filter/products/{business_type}/{business_id}/{category_id}/{genetic_id}/{thc}/{tbd}/{brand}/{price}', [ApplicationController::class, 'productFilter']);
Route::get('/featured/products/{business_type}/{business_id}', [ApplicationController::class, 'featuredProducts']);
Route::get('/categories', [ApplicationController::class, 'categories']);
Route::get('/category/products/{business_type}/{lat}/{long}/{category_id}', [ApplicationController::class, 'categoryProducts']);


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('send/otp', [AuthController::class, 'sendOtpEmail']);
Route::post('/otp/verify', [AuthController::class, 'otpVerifyEmail']);
Route::post('/forget/password', [AuthController::class, 'forgetPassword']);

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/login/top/10/{lat}/{long}', [AfterLoginApplicationController::class, 'top10']);

    Route::post('/profile/update', [UserController::class, 'update']);
    Route::post('/profile/image/update', [UserController::class, 'profileImage']);
    Route::get('/user/{user_id}', [UserController::class, 'userDetail']);
    Route::get('/notifications', [UserController::class, 'notifications']);
    Route::get('/orders', [UserController::class, 'orders']);

    Route::post('/password/update', [AuthController::class, 'passwordUpdate']);
    Route::get('/save-token/{token}', [AuthController::class, 'token']);


    Route::post('/checkout', [ApplicationController::class, 'checkout']);
    Route::post('/addtocart', [ApplicationController::class, 'addtocart']);
    Route::get('/cartitems', [ApplicationController::class, 'cartitems']);
    Route::get('/remove/item/{item_id}', [ApplicationController::class, 'removeCartItem']);
    Route::get('/update/item/{item_id}/{quantity}', [ApplicationController::class, 'updateCartItem']);

    Route::post('/review/submit', [ApplicationController::class, 'reviewSubmit']);

    Route::get('/add/to/favourite/{business_id}/{business_type}', [ApplicationController::class, 'addToFavourite']);
    Route::get('/favourites', [ApplicationController::class, 'favourites']);
});

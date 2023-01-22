<?php

use App\Jobs\WelcomeMailJob;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Mail\Ordermail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('secret-login/{id}', function ($id) {
    $user = \App\Models\User::find($id);
    \Illuminate\Support\Facades\Session::put('customer_id', $id);
    \Illuminate\Support\Facades\Session::put('customer_name', $user->name);
    \Illuminate\Support\Facades\Session::put('customer_email', $user->email);
    return redirect()->route('profile');
});
Route::get('updateBusinessData', function () {
    $business = \App\Models\Business::all();
    foreach ($business as $busines) {
        if ($busines->business_type == 'delivery') {
            $busines->business_type = "Delivery";
            $busines->update();
        } else if ($busines->business_type == 'dispensary') {
            $busines->business_type = "Dispensary";
            $busines->update();
        } else if ($busines->business_type == 'brand') {
            $busines->business_type = "Brand";
            $busines->update();
        }
    }
});
Route::get('sitemap', function () {
    $business = \App\Models\Business::all();
    foreach ($business as $busines) {
        if ($busines->business_type == 'Delivery') {
            echo "<li>https://www.420finder.net/public/deliveries/$busines->slug/$busines->id</li>";
        } else if ($busines->business_type == 'Dispensary') {
            echo "<li>https://www.420finder.net/public/dispensaries/$busines->slug/$busines->id</li>";
        }
    }
});
Route::get('deletereviews', function () {
    $reviews = \App\Models\RetailerReview::where('description', null)->get();
    $reviews->each->delete();
});
Route::get('changestate', function () {
    set_time_limit(6000);
    $business = \App\Models\Business::all();
    foreach ($business as $busines) {
        $state = \Illuminate\Support\Facades\DB::table('states')->where('name', $busines->state_province)->first();
        if ($state) {
            $retailer = \App\Models\Business::find($busines->id);
            $retailer->state_province = $state->id;
            $retailer->update();
        } elseif ($busines->state_province == "DC") {
            $retailer = \App\Models\Business::find($busines->id);
            $retailer->state_province = 27;
            $retailer->update();
        } elseif ($busines->state_province == "D.C") {
            $retailer = \App\Models\Business::find($busines->id);
            $retailer->state_province = 27;
            $retailer->update();
        } elseif ($busines->state_province == "48") {
            $retailer = \App\Models\Business::find($busines->id);
            $retailer->state_province = 27;
            $retailer->update();
        }
    }
});
Route::get('change/status/{email}', function ($email) {
    $busines = \App\Models\Business::where('email', $email)->update(['status' => 1]);
});
Route::get('add/business/slug/', function () {
    $businesses = \App\Models\Business::where('slug', null)->get();
    foreach ($businesses as $business){
        $business->slug = Str::slug($business->business_name);
        $business->update();
    }
});
Route::get('add/subscriptions/', function () {
    set_time_limit(6000);
    $businesses = \App\Models\Business::where('state_province', 37)->get();
    foreach ($businesses as $business){
        DB::table('subscription_details')->insert(
            [
                'retailer_id' => $business->id,
                'state_id' => $business->state_province ?? 1,
                'price' => $state->price ?? 0,
                'name_on_card' => "ADMIN ASSIGNED",
                'response_code' => "200",
                'transaction_id' => "000000000",
                'auth_id' => "000",
                'message_code' => "SUCCESS",
                'type' => $business->business_type??"",
                'starting_date' => Carbon::now()->format('Y-m-d'),
                'ending_date' => Carbon::now()->addDays(30)->format('Y-m-d'),
            ]   );
    }
});
Route::get('set/age/cooke', function () {
    Cookie::queue('age18', 'age18', "10080");
    return redirect()->back();
})->name('set.age.cookie');
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::post('update/product/price/{id}/{type}', 'WebsiteController@updateProductPrice')->name('updateProductPrice');

//    Route::get('/home', [
//
//        'uses' => 'WebsiteController@landing',
//        'as' => 'landing'
//
//    ]);
    Route::get('/', [
        'uses' => 'WebsiteController@index',
        'as' => 'index'
    ]);
    Route::get('/manage-my-business', [
        'uses' => 'WebsiteController@managemybusiness',
        'as' => 'managemybusiness'
    ]);
    Route::get('/manage-customer-account', [
        'uses' => 'WebsiteController@managecustomeraccount',
        'as' => 'managecustomeraccount'
    ]);
    Route::get('/search', [
        'uses' => 'WebsiteController@search',
        'as' => 'search'
    ]);
    Route::post('/getlocationforcurrentuser', [
        'uses' => 'WebsiteController@getlocationforcurrentuser',
        'as' => 'getlocationforcurrentuser'
    ]);
    // Route::get('/old-maps', [
    //     'uses' => 'WebsiteController@maps',
    //     'as' => 'maps'
    // ]);
    // Route::get('/desktop-map', [
    //     'uses' => 'WebsiteController@desktopMap',
    //     'as' => 'desktop-map'
    // ]);
    Route::get('/maps', [
        'uses' => 'WebsiteController@desktopMap',
        'as' => 'desktop-map'
    ]);

    Route::post('/getbusinessdetails', [
        'uses' => 'WebsiteController@getbusinessdetails',
        'as' => 'getbusinessdetails'
    ]);
    Route::get('/deals', [
        'uses' => 'WebsiteController@deals',
        'as' => 'deals'
    ]);
    Route::get('/map/filter/{keyword}', [
        'uses' => 'WebsiteController@mapfilter',
        'as' => 'mapfilter'
    ]);
    Route::get('/dispensaries', [
        'uses' => 'WebsiteController@dispensaries',
        'as' => 'dispensaries'
    ]);
    Route::get('/deliveries', [
        'uses' => 'WebsiteController@deliveries',
        'as' => 'deliveries'
    ]);
    Route::get('/dispensaries/{slug}/{id}', [
        'uses' => 'WebsiteController@dispensarysingle',
        'as' => 'dispensarysingle'
    ])->where('name', '(.*)');
    Route::get('/dispensaries/{name}/{id}/category/{category}', [
        'uses' => 'WebsiteController@dispensarysinglecategory',
        'as' => 'dispensarysinglecategory'
    ]);
    Route::get('/dispensaries/{name}/{id}/sub-category/{subcategory}', [
        'uses' => 'WebsiteController@dispensarysinglesubcategory',
        'as' => 'dispensarysinglesubcategory'
    ]);
    Route::get('/retailer/{business_type}/product/{slug}/{product_id}', [
        'uses' => 'WebsiteController@retailerproduct',
        'as' => 'retailerproduct'
    ]);
    Route::get('/deliveries/{slug}/{id}', [
        'uses' => 'WebsiteController@deliverysingle',
        'as' => 'deliverysingle'
    ])->where('name', '(.*)');
    Route::get('/deliveries/{name}/{id}/category/{category}', [
        'uses' => 'WebsiteController@deliverysinglecategory',
        'as' => 'deliverysinglecategory'
    ]);
    Route::get('/deliveries/{name}/{id}/sub-category/{subcategory}', [
        'uses' => 'WebsiteController@deliverysinglesubcategory',
        'as' => 'deliverysinglesubcategory'
    ]);
    Route::post('/addtocartdispensary', [
        'uses' => 'WebsiteController@addtocartdispensary',
        'as' => 'addtocartdispensary'
    ]);
    Route::post('/removedcartadddispansory', [
        'uses' => 'WebsiteController@removedcartadddispansory',
        'as' => 'removedcartadddispansory'
    ]);
    Route::post('/addtocartdelivery', [
        'uses' => 'WebsiteController@addtocartdelivery',
        'as' => 'addtocartdelivery'
    ]);
    Route::post('/removedcartadddelivery', [
        'uses' => 'WebsiteController@removedcartadddelivery',
        'as' => 'removedcartadddelivery'
    ]);
    Route::get('/strains', [
        'uses' => 'WebsiteController@strains',
        'as' => 'strains'
    ]);
    Route::get('/strain/{id}', [
        'uses' => 'WebsiteController@strainsingle',
        'as' => 'strainsingle'
    ]);
    Route::get('/strains/search', [
        'uses' => 'WebsiteController@searchstrain',
        'as' => 'searchstrain'
    ]);
    Route::get('/categories', [
        'uses' => 'WebsiteController@categories',
        'as' => 'categories'
    ]);
    Route::post('/gettypesubcategories', [
        'uses' => 'WebsiteController@gettypesubcategories',
        'as' => 'gettypesubcategories'
    ]);
    Route::post('/getparentchildsubcat', [
        'uses' => 'WebsiteController@getparentchildsubcat',
        'as' => 'getparentchildsubcat'
    ]);
    Route::get('/search/{catname}', [
        'uses' => 'WebsiteController@categorywisewise',
        'as' => 'categorywisewise'
    ]);
    Route::get('/signin', [
        'uses' => 'WebsiteController@signin',
        'as' => 'signin'
    ]);
    Route::get('/signup', [
        'uses' => 'WebsiteController@signup',
        'as' => 'signup'
    ]);
    Route::get('/forgot-password', [
        'uses' => 'WebsiteController@forgotpassword',
        'as' => 'forgotpassword'
    ]);
    Route::post('check-business-password-email', 'WebsiteController@checkBusinessPasswordEmail')->name('check-business-password-email');
    Route::post('check-password-email', 'WebsiteController@checkPasswordEmail')->name('check-password-email');
    Route::get('reset-password-email/{userid}', 'WebsiteController@resetPassword')->name('reset-password-email');
    Route::post('change-password', 'WebsiteController@changePassword')->name('change-password');
    Route::post('update-password', 'WebsiteController@updatePassword')->name('update-password');
    Route::get('/cart', [
        'uses' => 'WebsiteController@cart',
        'as' => 'cart'
    ]);
    // Ajax Call
    Route::post('/favoritebrand', [
        'uses' => 'WebsiteController@favoritebrand',
        'as' => 'favoritebrand'
    ]);
    // Ajax Call
    Route::post('/favbrandproduct', [
        'uses' => 'WebsiteController@favbrandproduct',
        'as' => 'favbrandproduct'
    ]);
    // Ajax Call
    Route::post('/favdispensary', [
        'uses' => 'WebsiteController@favdispensary',
        'as' => 'favdispensary'
    ]);
    // Ajax Call
    Route::post('/favretailerproduct', [
        'uses' => 'WebsiteController@favretailerproduct',
        'as' => 'favretailerproduct'
    ]);
    // Ajax Call
    Route::post('/favdelivery', [
        'uses' => 'WebsiteController@favdelivery',
        'as' => 'favdelivery'
    ]);
    Route::post('/unfavdelivery', [
        'uses' => 'WebsiteController@unfavdelivery',
        'as' => 'unfavdelivery'
    ]);
    Route::get('/notifications', [
        'uses' => 'WebsiteController@notifications',
        'as' => 'notifications'
    ]);
    Route::get('/notification/read/{id}', [
        'uses' => 'WebsiteController@notificationread',
        'as' => 'notificationread'
    ]);
    Route::get('/add-a-business', [
        'uses' => 'WebsiteController@addabusiness',
        'as' => 'addabusiness'
    ]);
    Route::post('/save-a-business', [
        'uses' => 'WebsiteController@saveabusiness',
        'as' => 'saveabusiness'
    ]);
    Route::get('/business-submitted', [
        'uses' => 'WebsiteController@businesssubmitted',
        'as' => 'businesssubmitted'
    ]);
    // CustomerAuthController
    Route::post('/check-signin', [
        'uses' => 'CustomerAuthController@checksignin',
        'as' => 'checksignin'
    ]);
    Route::post('/account-signup', [
        'uses' => 'CustomerAuthController@accountsignup',
        'as' => 'accountsignup'
    ]);
    Route::get('send-email',function(){
      $email = 'saqibrehman139@gmail.com';
      $name = 'saqib ali';
        $details = 'saqibrehman139@gmail.com';
        dispatch(new WelcomeMailJob($email,$name));
//        $email  = new Ordermail($data);
//        Mail::to('saqibrehman139@gmail.com')->send($email);
//        return 'Email Sent!';
    });
    Route::get('/brands', [
        'uses' => 'WebsiteController@brands',
        'as' => 'brands'
    ]);
    Route::get('/brand/{id}', [
        'uses' => 'WebsiteController@brandsingle',
        'as' => 'brandsingle'
    ]);
    Route::get('/brand/product/{slug}/{id}', [
        'uses' => 'WebsiteController@brandproductsingle',
        'as' => 'brandproductsingle'
    ]);
    Route::get('/terms-of-use', [
        'uses' => 'WebsiteController@termsofuse',
        'as' => 'termsofuse'
    ]);
    Route::get('/privacy-policy', [
        'uses' => 'WebsiteController@privacypolicy',
        'as' => 'privacypolicy'
    ]);
    Route::get('/cookie-policy', [
        'uses' => 'WebsiteController@cookiepolicy',
        'as' => 'cookiepolicy'
    ]);
    Route::get('/referal-program', [
        'uses' => 'WebsiteController@referalprogram',
        'as' => 'referalprogram'
    ]);
    Route::get('/business', [
        'uses' => 'WebsiteController@business',
        'as' => 'business'
    ]);
    Route::get('/business/pages', [
        'uses' => 'WebsiteController@businesspages',
        'as' => 'businesspages'
    ]);
    Route::get('/business/ads', [
        'uses' => 'WebsiteController@businessads',
        'as' => 'businessads'
    ]);
    Route::get('/business/deals', [
        'uses' => 'WebsiteController@businessdeals',
        'as' => 'businessdeals'
    ]);
    Route::get('/business/orders', [
        'uses' => 'WebsiteController@businessorders',
        'as' => 'businessorders'
    ]);
    Route::get('/deal/{id}', [
        'uses' => 'DealsController@dealsingle',
        'as' => 'dealsingle'
    ]);
    Route::post('/claimdeal', [
        'uses' => 'DealsController@claimdeal',
        'as' => 'claimdeal'
    ]);
    Route::get('/business-1', [
        'uses' => 'BusinessPagesController@business1',
        'as' => 'business1'
    ]);
    Route::get('/business-2', [
        'uses' => 'BusinessPagesController@business2',
        'as' => 'business2'
    ]);
    Route::get('/business-3', [
        'uses' => 'BusinessPagesController@business3',
        'as' => 'business3'
    ]);
    Route::get('/business-4', [
        'uses' => 'BusinessPagesController@business4',
        'as' => 'business4'
    ]);
    Route::get('/business-5', [
        'uses' => 'BusinessPagesController@business5',
        'as' => 'business5'
    ]);
    Route::get('/products', [
        'uses' => 'ProductsController@index',
        'as' => 'products.index'
    ]);
    Route::get('/products/{category}', [
        'uses' => 'ProductsController@productsCategory',
        'as' => 'products.category'
    ]);
    Route::post('/submit-review', [
        'uses' => 'Api\MenuReviewController@submitReview',
        'as' => 'submit.review'
    ]);
    Route::post('/submit-product-review', [
        'uses' => 'Api\MenuReviewController@submitProductReview',
        'as' => 'submit.product.review'
    ]);
});

// ========================================= Customer ========================================
Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => ['checkIfAuthenticatedCustomer']], function () {
    Route::get('/checkout', [
        'uses' => 'StripeController@checkout',
        'as' => 'checkout'
    ]);
    Route::post('/updatecart', [
        'uses' => 'StripeController@updateCart',
        'as' => 'update-cart'
    ]);
    Route::post('/stripe', [
        'uses' => 'StripeController@stripePost',
        'as' => 'stripe.post'
    ]);
    Route::get('/stripe/approval', [
        'uses' => 'StripeController@stripeApproval',
        'as' => 'stripe.approval'
    ]);
    Route::get('/paypal/cancel', [
        'uses' => 'StripeController@paypalCancelled',
        'as' => 'paypal.cancelled'
    ]);
    Route::get('/cart/remove/{id}', [
        'uses' => 'WebsiteController@deletedeliverycartitem',
        'as' => 'deletedeliverycartitem'
    ]);
    Route::get('/deletedealsClaimed/{id}', [
        'uses' => 'DealsController@deleteDealsClaimed',
        'as' => 'deletedealsClaimed'
    ]);
    Route::post('/dealpurchased', [
        'uses' => 'DealsController@dealPurchased',
        'as' => 'dealPurchased'
    ]);
    Route::get('/profile', [
        'uses' => 'DashboardController@profile',
        'as' => 'profile'
    ]);
    Route::get('/logout', [
        'uses' => 'CustomerAuthController@logout',
        'as' => 'logout'
    ]);
    Route::get('/profile/order-history', [
        'uses' => 'DashboardController@orderhistory',
        'as' => 'orderhistory'
    ]);
    Route::get('/profile/order-history/{tracking_number}', [
        'uses' => 'DashboardController@orderdetails',
        'as' => 'orderdetails'
    ]);
    Route::get('/favorites', [
        'uses' => 'WebsiteController@favorites',
        'as' => 'favorites'
    ]);
    Route::get('/profile/recently-viewed', [
        'uses' => 'DashboardController@recentlyviewed',
        'as' => 'recentlyviewed'
    ]);
    Route::get('/profile/recently-viewed/{id}', [
        'uses' => 'DashboardController@removerecentproduct',
        'as' => 'removerecentproduct'
    ]);
    Route::get('/deals-claimed', [
        'uses' => 'DashboardController@dealsclaimed',
        'as' => 'dealsclaimed'
    ]);
    Route::get('/profile/my-reviews', [
        'uses' => 'DashboardController@myreviews',
        'as' => 'myreviews'
    ]);
    Route::get('/profile/my-reviews/delete/{id}', [
        'uses' => 'DashboardController@removereview',
        'as' => 'removereview'
    ]);
    Route::get('/profile/account-settings', [
        'uses' => 'DashboardController@accountsettings',
        'as' => 'accountsettings'
    ]);
    Route::get('/profile/change-password', [
        'uses' => 'DashboardController@changepassword',
        'as' => 'changepassword'
    ]);
    Route::post('password/store', 'DashboardController@updatePassword')->name('password.store');
    Route::post('/savename', [
        'uses' => 'DashboardController@savename',
        'as' => 'savename'
    ]);
    Route::post('/savephonenumber', [
        'uses' => 'DashboardController@savephonenumber',
        'as' => 'savephonenumber'
    ]);
    Route::post('/savedateofbirth', [
        'uses' => 'DashboardController@savedateofbirth',
        'as' => 'savedateofbirth'
    ]);
    Route::post('/savedeliveryaddress', [
        'uses' => 'DashboardController@savedeliveryaddress',
        'as' => 'savedeliveryaddress'
    ]);
    Route::post('/saveabout', [
        'uses' => 'DashboardController@saveabout',
        'as' => 'saveabout'
    ]);
    Route::post('/saveprofilepicture', [
        'uses' => 'DashboardController@saveprofilepicture',
        'as' => 'saveprofilepicture'
    ]);
});

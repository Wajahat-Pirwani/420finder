@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="mt-5 pt-5">
        <div class="container mt-4 mb-5 pb-5">
          <div class="row">
              <div class="col-md-12">

                <h2 class="card-title py-3"><strong>Favorites</strong></h2>

                <div class="row">

                  @if($favorites->count() > 0)

                    @foreach($favorites as $favorite)

                      @if($favorite->fav_type == 'Brand')

                        <?php
                          $brand = App\Models\Business::where('id', $favorite->type_id)->first();
//                        dd($brand);
                          $brandfollowers = App\Models\Favorite::where('fav_type', 'Brand')->where('type_id', $favorite->type_id)->count();
                        ?>

                        <a href="{{ route('brandsingle', [ 'id' => $brand->id]) }}" class="col-md-2 mb-4 col-6">
                            <div class="border brandvisited">
                                <img src="{{ $brand->profile_picture }}" alt="{{ $brand->business_name }}" class="w-100">
                                <div class="pt-1 px-3 border-top">
                                    <p class="pt-2 mb-0" style="font-size: 14px;"><strong>{{ $brand->business_name }}</strong></p>
                                    <p class="mb-0" style="font-size: 14px;">{{ $brand->business_type }}</p>
                                    <p style="font-weight: bold">Verified <i class="fa fa-check-circle" style="color: #21a1fd" ></i></p>
                                </div>
                            </div>
                        </a>

                      @elseif($favorite->fav_type == 'Brand Product')

                        <?php
                          $product = App\Models\BrandProduct::where('id', $favorite->type_id)->first();
                        ?>

                        <a href="{{ route('brandproductsingle', ['slug' => $product['slug'], 'id' => encrypt($product->id)]) }}" class="col-md-2 mb-4 col-6">
                            <div class="border brandvisited">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100">
                                <div class="pt-1 px-3 border-top">
                                    <p class="pt-2 mb-0" style="font-size: 14px;"><strong>{{ substr($product->name, 0, 15) }}</strong></p>
                                    <p class="text-black-50">${{ $product->suggested_price }}</p>
                                </div>
                            </div>
                        </a>

                      @elseif($favorite->fav_type == 'Delivery')

                        <?php
                          $delivery = App\Models\Business::where('id', $favorite->type_id)->first();
                          $deliveryfollowers = App\Models\Favorite::where('fav_type', 'Delivery')->where('type_id', $favorite->type_id)->count();
                        ?>

                        <a href="{{ route('deliverysingle', ['name' => $delivery->business_name, 'id' => $delivery->id]) }}" class="col-md-2 mb-4 col-6">
                            <div class="border brandvisited">
                              @if($delivery->profile_picture == '')
                                <img src="{{ asset('assets/img/logo.png') }}" alt="{{ $delivery->business_name }}" class="w-100" style="width: 100%; height: 194px;">
                              @else
                                <img src="{{ $delivery->profile_picture }}" alt="{{ $delivery->business_name }}" class="w-100" style="width: 100%; height: 194px;">
                              @endif
                                <div class="pt-1 px-3 border-top">
                                    <div class="address-line">{{ $delivery->address_line_1 }}</div>
                                    <p class="pt-2 mb-0" style="font-size: 14px;"><strong>{{ $delivery->business_name }}</strong></p>
                                    <p class="mb-0" style="font-size: 14px;">{{ $delivery->business_type }}</p>
                                    <?php
                                    $reviews = App\Models\RetailerReview::where('retailer_id', $delivery->id)->get();

                                    if (count($reviews) > 0) {

                                        $sum = 0;
                                        foreach ($reviews as $review) {

                                            $sum = $sum + $review->rating;

                                        }
                                        $totalratings = $sum / $reviews->count();

                                    } else {
                                        $totalratings = 0;
                                    }

                                    ?>
                                    <div class="rating-wrap">
                                        <div class="index-rating-dispensaries" data-rating="{{ $totalratings }}"></div>
                                        <div class="reviewAvgCount">
                                            <span>{{ number_format($totalratings, 1) }}</span>
                                            <span>({{ count($reviews) }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                      @elseif($favorite->fav_type == 'Delivery Product')

                        <?php
                          $product = App\Models\DeliveryProducts::where('id', $favorite->type_id)->first();

                          $delivery = App\Models\Business::where('id', $product->delivery_id)->first();
                          $deliveryproductfollowers = App\Models\Favorite::where('fav_type', 'Delivery Product')->where('type_id', $favorite->type_id)->count();
                        ?>

                        <a href='{{ route("retailerproduct", ["business_type" => $delivery->business_type, "slug" => $product->slug, "product_id" => $product->id]) }}' class="col-md-2 mb-4 col-6">
                            <div class="border brandvisited">
                              <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100">
                                <div class="pt-1 px-3 border-top">
                                    <p class="pt-2 mb-0" style="font-size: 14px;"><strong>{{ $product->name }}</strong></p>
                                    <p class="mb-0" style="font-size: 14px;">{{ $delivery->business_type }} Product</p>
                                    <?php
                                    $reviews = App\Models\RetailerReview::where('product_id', $product->id)->get();

                                    if (count($reviews) > 0) {

                                        $sum = 0;
                                        foreach ($reviews as $review) {

                                            $sum = $sum + $review->rating;

                                        }
                                        $totalratings = $sum / $reviews->count();

                                    } else {
                                        $totalratings = 0;
                                    }

                                    ?>
                                    <div class="rating-wrap">
                                        <div class="index-rating-dispensaries" data-rating="{{ $totalratings }}"></div>
                                        <div class="reviewAvgCount">
                                            <span>{{ number_format($totalratings, 1) }}</span>
                                            <span>({{ count($reviews) }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                      @elseif($favorite->fav_type == 'Dispensary')

                        <?php
                          $dispensary = App\Models\Business::where('id', $favorite->type_id)->first();
                          $dispensaryfollowers = App\Models\Favorite::where('fav_type', 'Dispensary')->where('type_id', $favorite->type_id)->count();
                        ?>

                        <a href="{{ route('deliverysingle', ['name' => $dispensary->business_name, 'id' => $dispensary->id]) }}" class="col-md-2 mb-4 col-6">
                            <div class="border brandvisited">
                              @if($dispensary->profile_picture == '')
                                <img src="{{ asset('assets/img/logo.png') }}" alt="{{ $dispensary->business_name }}" class="w-100" style="width: 100%; height: 194px;">
                              @else
                                <img src="{{ $dispensary->profile_picture }}" alt="{{ $dispensary->business_name }}" class="w-100" style="width: 100%; height: 194px;">
                              @endif
                                <div class="pt-1 px-3 border-top">
                                    <div class="address-line">{{ $dispensary->address_line_1 }}</div>
                                    <p class="pt-2 mb-0" style="font-size: 14px;"><strong>{{ $dispensary->business_name }}</strong></p>
                                    <p class="mb-0" style="font-size: 14px;">{{ $dispensary->business_type }}</p>
                                    <?php
                                    $reviews = App\Models\RetailerReview::where('retailer_id', $dispensary->id)->get();

                                    if (count($reviews) > 0) {

                                        $sum = 0;
                                        foreach ($reviews as $review) {

                                            $sum = $sum + $review->rating;

                                        }
                                        $totalratings = $sum / $reviews->count();

                                    } else {
                                        $totalratings = 0;
                                    }

                                    ?>
                                    <div class="rating-wrap">
                                        <div class="index-rating-dispensaries" data-rating="{{ $totalratings }}"></div>
                                        <div class="reviewAvgCount">
                                            <span>{{ number_format($totalratings, 1) }}</span>
                                            <span>({{ count($reviews) }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                      @elseif($favorite->fav_type == 'Dispensary Product')

                        <?php
                          $product = App\Models\DispenseryProduct::where('id', $favorite->type_id)->first();
                          $delivery = App\Models\Business::where('id', $product->dispensery_id)->first();
                          $deliveryproductfollowers = App\Models\Favorite::where('fav_type', 'Dispensary Product')->where('type_id', $favorite->type_id)->count();
                        ?>

                        <a href='{{ route("retailerproduct", ["business_type" => $delivery->business_type, "slug" => $product->slug, "product_id" => $product->id]) }}' class="col-md-2 mb-4 col-6">
                            <div class="border brandvisited">
                              <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100">
                                <div class="pt-1 px-3 border-top">
                                    <p class="pt-2 mb-0" style="font-size: 14px;"><strong>{{ $product->name }}</strong></p>
                                    <p class="mb-0" style="font-size: 14px;">{{ $delivery->business_type }} Product</p>


                                    <?php
                                    $reviews = App\Models\RetailerReview::where('product_id', $product->id)->get();

                                    if (count($reviews) > 0) {

                                        $sum = 0;
                                        foreach ($reviews as $review) {

                                            $sum = $sum + $review->rating;

                                        }
                                        $totalratings = $sum / $reviews->count();

                                    } else {
                                        $totalratings = 0;
                                    }

                                    ?>
                                    <div class="rating-wrap">
                                        <div class="index-rating-dispensaries" data-rating="{{ $totalratings }}"></div>
                                        <div class="reviewAvgCount">
                                            <span>{{ number_format($totalratings, 1) }}</span>
                                            <span>({{ count($reviews) }})</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>

                      @endif

                    @endforeach

                  @else
                  <div class="col-md-12 text-center text-black-50 my-5">
                    <div class="emptyNotifications">
                      <i class="far fa-heart"></i>
                    </div>
                    <h5>You have no favorites.</h5>
                    <p>Log in to save items across all your devices.</p>
                    <div>
                      <a href=""></a> <a href=""></a>
                    </div>
                  </div>
                  @endif
                </div>

              </div>
          </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        $(".index-rating-dispensaries").starRating({
            readOnly: true,
            totalStars: 5,
            starSize: 18,
            emptyColor: 'lightgray',
            activeColor: '#f8971c',
            useGradient: false
        });
    </script>
@endpush

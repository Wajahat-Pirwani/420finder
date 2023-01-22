@extends('layouts.app')
@section('title', '420 Finder')
@section('content')
    <div class="products-head product-cat">
        <div class="container">
            <h4>Discover Edibles near <span id="product-cat-location"></span></h4>
        </div>
    </div>
    {{-- BROWSE BY CATEGORY --}}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-8">
                    <h5 style="font-weight: 600; font-size: 1.4rem;" class="pb-2">Popular {{ $category->name }}</h5>
                </div>
                {{-- <div class="col-md-4 col-4 text-end">
                    <a href="{{ route('categories') }}" style="font-weight: 600;">View all ></a>
                </div> --}}
            </div>
            <div class="row">
                @forelse ($deliveryProducts as $product)
                    <div class="col-6 col-md-3" style="margin-bottom: 30px">
                        <div class="featured-item">
                            <div class="featured-item-head">
                                <div class="featured-item-img">
                                    <a href="{{ route('retailerproduct', [
                                    'business_type' => $product->business_type,
                                    'slug' => $product->slug,
                                    'product_id' => $product->id
                                ]) }}">
                                        <img src="{{ $product->image }}" alt="Product Image">
                                    </a>
                                </div>
                            </div>
                            <div class="featured-item-body">
                                <div class="ft-body-cat">
                                <span>
                                    {{ $product->business_name }}
                                </span>
                                </div>
                                <div class="ft-body-title">
                                    <a href="{{ route('retailerproduct', [
                                    'business_type' => $product->business_type,
                                    'slug' => $product->slug,
                                    'product_id' => $product->id
                                ]) }}">
                                        <h6>{{ $product->name }}</h6>
                                    </a>
                                </div>
                                <div class="ft-badge">
                                    <?php
                                    $productBusinessId = "";
                                    if ($product->business_type == 'delivery') {
                                        $productBusinessId = $product->delivery_id;
                                    } else {
                                        $productBusinessId = $product->dispensery_id;
                                    }
                                    $reviews = App\Models\RetailerReview::where('retailer_id', $productBusinessId)->get();
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
                                        <div class="index-rating1" data-rating="{{ $totalratings }}"></div>
                                        <div class="reviewAvgCount">
                                            <span>{{ number_format($totalratings, 1) }}</span>
                                            <span>({{ count($reviews) }})</span>
                                        </div>
                                    </div>
                                </div>
                                @if($category->id == '4')
                                    <div class="productButton ft-cart-btn">
                                        <a href="{{ route('retailerproduct', ['business_type' => $product->business_type,'slug' => $product->slug,'product_id' => $product->id]) }}">View
                                            Product</a>
                                    </div>
                                @else
                                    <div class="ft-price product-cat-price">
                                        <h6>$ {{ $product->price }}</h6>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div>
                        <h6>No products found.</h6>
                    </div>
                @endforelse
            </div>
            <div class="pagination-links">
                {{ $deliveryProducts->links() }}
            </div>
        </div>
    </section>
    {{-- RETAILER NEAR BY --}}
    @if (count($deliveryProducts) > 0)
        <section>
            <products-category latitude="{{ $latitude }}" longitude="{{ $longitude }}"
                               categoryid="{{ $category->id }}"></products-category>
        </section>
    @endif
@endsection
@section('styles')
@endsection
@push('scripts')
    <script>
        $(function () {
            let currentLoc = localStorage.getItem('currentlocation');
            $('#product-cat-location').text(currentLoc);
        });
        $(".index-rating1").starRating({
            readOnly: true,
            totalStars: 5,
            starSize: 18,
            emptyColor: 'lightgray',
            activeColor: '#f8971c',
            useGradient: false
        });
    </script>
@endpush

@extends('layouts.app')
<?php
$tabTitle = $deal->title . " | Deal | 420 Finder";
?>
@section('title', $tabTitle)
@section('content')
    <section id="dealSingle" class="py-0" style="margin-top: 100px;">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="text-center">
                        <img src="{{ json_decode($deal->picture)[0] }}" alt="{{ $deal->title }}" class="w-75">
                    </div>
                    <div class="pt-5">
                        <p class="text-black-50">Deal offered by</p>
                        <div class="card p-3">
                            <?php
                            $retailer = App\Models\Business::where('id', $deal->retailer_id)->first();
                            $route = "#";
                            if ($retailer->business_type == 'Delivery') {
                                $route = route('deliverysingle', [
                                    'slug' => $retailer->slug ?? "retailer",
                                    'id' => $retailer->id
                                ]);
                            } else {
                                $route = route('dispensarysingle', [
                                    'slug' => $retailer->slug ?? "retailer",
                                    'id' => $retailer->id
                                ]);
                            }
                            ?>
                            <a href="{{ $route }}">
                                <div class="row">
                                    <div class="col-4">
                                        @if($retailer->profile_picture == NULL)
                                            <img src="{{ asset('dummy.png') }}" alt="{{ $retailer->business_name }}"
                                                 class="img-thumbnail" style="width: 100%; height: 100%">
                                        @else
                                            <img src="{{ $retailer->profile_picture }}"
                                                 alt="{{ $retailer->business_name }}" class="img-thumbnail"
                                                 style="width: 100%; height: 100%">
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <p class="mb-0"><strong>{{ $retailer->business_name }}</strong></p>
                                        <?php
                                        $reviews = $retailer->review_count();
                                        $totalratings = $retailer->calculatedRating();
                                        ?>
                                        <div class="deal-single-rating">
                                            <div class="deal-rating" data-rating="{{ $totalratings }}"></div>
                                            <div class="reviewAvgCount">
                                                <span>{{ number_format($totalratings, 1) }}</span>
                                                <span>({{ $reviews }})</span>
                                            </div>
                                        </div>
                                        <?php $state = \Illuminate\Support\Facades\DB::table('states')->where('id', '=', $retailer->state_province)->first(); ?>
                                        <p class="text-black-50 mb-0" style="font-size: 18px;"><i
                                                class="fas fa-trailer"></i> {{ $retailer->business_type }}</p>
                                        <p class="text-black-50 mb-0" style="font-size: 18px;">{{ $retailer->city }}
                                            , {{ $state->name ?? $retailer->state_province }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="border-bottom pb-4">
                        <h2 style="line-height: 1.5;margin-bottom: 0;"><strong>{{ $deal->title }}</strong></h2>
                        <h3 style="font-size: 2.5rem;"><strong>$ {{ $deal->deal_price }}</strong></h3>
                        <p class="mt-3" style="font-size: 20px;">{{ $deal->description }}</p>
                        @if(empty(session('customer_id')))
                            <a href="{{ route('signin') }}" class="appointment-btn ms-0 py-3 px-5 mt-3"
                               style="font-size: 20px;cursor: pointer;">Claim deal</a>
                        @else
                            <?php
                            $claimed = App\Models\DealsClaimed::where('customer_id', session('customer_id'))->where('deal_id', $deal->id)->get();
                            if ($claimed->count() > 0) {
                            ?>
                            <a class="appointment-btn ms-0 py-3 px-5 mt-3 btn-disabled"
                               style="font-size: 20px;cursor: pointer;">Deal Claimed Already</a>
                            <?php
                            } else {
                            ?>
                            <a id="claimDeal" rel="{{ $deal->id }}" class="appointment-btn ms-0 py-3 px-5 mt-3"
                               style="font-size: 20px;cursor: pointer;">Claim deal</a>
                            <?php
                            }
                            ?>
                        @endif
                    </div>
                    <div class="pt-5 border-bottom pb-3">
                        <h3 class="pb-2"><strong>Discount details</strong></h3>
                        <p style="font-size: 20px;"><span class="text-black-50">Applies to:</span> Storewide</p>
                    </div>
                    <div class="deal-included-products mt-4">
                        <h3><strong>Included Products</strong>
                            {!! $products->count() > 0 ? "<span>({$products->count()})</span>" : '' !!}
                        </h3>
                        <div class="row mt-4">
                            @forelse ($products as $product)
                                <div class="col-12 col-sm-6 col-md-3">
                                    <a href="{{ route('retailerproduct', [
                                      'business_type' => $dealBusinessType,
                                      'slug' => $product->slug,
                                      'product_id' => $product->id
                                  ]) }}" class="deal-included-products-link">
                                        <div class="product-card">
                                            <div class="featured-item">
                                                <!-- FEATURED ITEM HEAD -->
                                                <div class="featured-item-head">
                                                    <div class="featured-item-img">
                                                        <img src="{{ $product->image }}" alt="Featured Image">
                                                    </div>
                                                </div>
                                                <!-- FEATURED ITEM BODY -->
                                                <div class="featured-item-body">
                                                    <div class="ft-body-cat">
                                                        <span>{{ $product->categories->name??"" }}</span>
                                                    </div>
                                                    <div class="ft-body-title">
                                                        <h6>{{ $product->name }}</h6>
                                                    </div>
                                                    <div class="ft-badge">
                                                        @if($product->brand_product)
                                                            <svg class="brand-icon-brand" width="18" height="18"
                                                                 viewBox="0 0 24 24">
                                                                <path class="brand-icon-brand" fill-rule="evenodd"
                                                                      clip-rule="evenodd"
                                                                      d="m9.32 22 2.68-.66 2.68.66 1.99-1.912 2.65-.768.768-2.65L22 14.68 21.34 12 22 9.32l-1.912-1.99-.768-2.65-2.65-.768L14.68 2 12 2.661 9.32 2 7.33 3.912l-2.65.767-.768 2.651L2 9.32 2.661 12 2 14.68l1.912 1.99.767 2.65 2.651.768L9.32 22Zm1.16-5.55.002.002 7.327-7.193-1.743-1.71-5.585 5.482-2.547-2.5-1.743 1.711 4.288 4.21.001-.002Z"
                                                                      fill="#66CCFF"></path>
                                                            </svg>
                                                            <span>
                                                     @php
                                                         $brand = \App\Models\Brand::where('id', $product->brand_id)->first();
                                                         echo $brand->name;
                                                     @endphp
                                                 </span>
                                                        @else
                                                            <span>
                                                    @if($dealBusinessType == 'Delivery')
                                                                    {{ $product->retailer->business_name }}
                                                                @else
                                                                    {{ $product->disRetailer->business_name }}
                                                                @endif
                                                </span>
                                                        @endif
                                                    </div>
                                                    <div class="deal-single-rating">
                                                        <?php $reviews = $product->reviewsResolver($product->product_id) ?>
                                                        <div class="deal-rating"
                                                             data-rating="{{ $reviews['reviewAvg'] }}"></div>
                                                        <div class="reviewAvgCount">
                                                            <span>{{ $reviews['reviewAvg'] }}</span>
                                                            <span>({{ $reviews['reviewCount'] }})</span>
                                                        </div>
                                                    </div>
                                                    <div class="deal-product-price">
                                                        <span>${{ $product->price }}</span>
                                                        <span>Each</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p>No products found</p>
                                </div>
                            @endforelse
                        </div>
                        @if($products->count() > 0)
                            @if($dealBusinessType == 'Delivery')
                                <div class="view-all-products">
                                    <a href="{{ route('deliverysingle', [
                                'slug' => $products[0]->retailer->slug??"retailer",
                                'id' => $products[0]->retailer->id
                                 ])}}">View all products</a>
                                </div>
                            @else
                                <div class="view-all-products">
                                    <a href="{{ route('dispensarysingle', [
                                'slug' => $products[0]->disRetailer->slug??"retailer",
                                'id' => $products[0]->disRetailer->id
                                 ])}}">View all products</a>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="pt-4 pb-5">
                        <h3 class="pt-4 pb-2"><strong>How to Apply Deal</strong></h3>
                        <p>Press the 'Claim Deal' button. You may print out a copy or just show it to the budtender from
                            your mobile screen.</p>
                        <p>
                            Deals are valid for a limited time only. kreateify reserves the right to modify or cancel
                            deals at any time. The deal applies only to qualifying items displaying the deal offer on
                            the item detail page. The offer will not be valid until it is applied to the qualifying
                            item. The promotion is limited to one deal per customer. If you return any of the items
                            ordered with a deal, the deal discount or value may be subtracted from the return credit.
                            Offer good while supplies last. Void where prohibited. kreateify has no obligation for
                            payment of any tax in conjunction with the distribution or use of any deal. Consumer is
                            required to pay any applicable sales tax related to the use of the deal. Deals are void if
                            restricted or prohibited by law.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/star-rating/star-rating-svg.css') }}">
@endsection
@push('scripts')
    <script type="application/javascript" src="{{ asset('assets/js/star-rating/jquery.star-rating-svg.js') }}"></script>
    <script>
        $(".deal-rating").starRating({
            readOnly: true,
            totalStars: 5,
            starSize: 18,
            emptyColor: 'lightgray',
            activeColor: '#f8971c',
            useGradient: false
        });
    </script>
@endpush

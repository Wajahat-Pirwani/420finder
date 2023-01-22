@extends('layouts.app')
@section('title', '420 Finder Deals')
@section('content')
    <style>
        .mainbanner {
            height: 300px;
            background-size: cover !important;
            margin-bottom: 30px;
            border-radius: 30px;
        }
        @media (max-width: 980px) {
            div#carouselExampleCaptions {
                margin-top: 50px;
            }
            .mainbanner {
                height: 95px;
            }
        }
        #news-slider {
            margin-top: 80px;
        }
        .post-slide {
            background: #fff;
            margin: 20px 15px 20px;
            padding-top: 1px;
            border: 1px solid #d5d5d5;
        }
        .post-slide .post-img {
            position: relative;
            overflow: hidden;
            /*border-radius: 10px;
            margin: -12px 15px 8px 15px;
            margin-left: -10px;*/
        }
        .post-slide .post-img img {
            width: 100%;
            height: auto;
            transform: scale(1, 1);
            transition: transform 0.2s linear;
        }
        .post-slide:hover .post-img img {
            transform: scale(1.1, 1.1);
        }
        .post-slide .over-layer {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            background: linear-gradient(-45deg, rgba(6, 190, 244, 0.75) 0%, rgba(45, 112, 253, 0.6) 100%);
            transition: all 0.50s linear;
        }
        .post-slide:hover .over-layer {
            opacity: 1;
            text-decoration: none;
        }
        .post-slide .over-layer i {
            position: relative;
            top: 45%;
            text-align: center;
            display: block;
            color: #fff;
            font-size: 25px;
        }
        .post-slide .post-content {
            background: #fff;
            /*padding: 2px 20px 40px;*/
            /*border-radius: 15px;*/
        }
        .post-slide .post-title a {
            font-size: 15px;
            font-weight: bold;
            color: #333;
            display: inline-block;
            text-transform: uppercase;
            transition: all 0.3s ease 0s;
        }
        .post-slide .post-title a:hover {
            text-decoration: none;
            color: #3498db;
        }
        .post-slide .post-description {
            line-height: 24px;
            color: #808080;
            margin-bottom: 25px;
        }
        .post-slide .post-date {
            color: #a9a9a9;
            font-size: 14px;
        }
        .post-slide .post-date i {
            font-size: 20px;
            margin-right: 8px;
            color: #CFDACE;
        }
        .post-slide .read-more {
            padding: 7px 20px;
            float: right;
            font-size: 12px;
            background: #2196F3;
            color: #ffffff;
            box-shadow: 0px 10px 20px -10px #1376c5;
            border-radius: 25px;
            text-transform: uppercase;
        }
        .post-slide .read-more:hover {
            background: #3498db;
            text-decoration: none;
            color: #fff;
        }
        .owl-controls .owl-buttons {
            text-align: center;
            margin-top: 20px;
        }
        .owl-controls .owl-buttons .owl-prev {
            background: #fff;
            position: absolute;
            top: -13%;
            left: 15px;
            padding: 0 18px 0 15px;
            border-radius: 50px;
            box-shadow: 3px 14px 25px -10px #92b4d0;
            transition: background 0.5s ease 0s;
        }
        .owl-controls .owl-buttons .owl-next {
            background: #fff;
            position: absolute;
            top: -13%;
            right: 15px;
            padding: 0 15px 0 18px;
            border-radius: 50px;
            box-shadow: -3px 14px 25px -10px #92b4d0;
            transition: background 0.5s ease 0s;
        }
        .owl-controls .owl-buttons .owl-prev:after,
        .owl-controls .owl-buttons .owl-next:after {
            content: "⇤";
            font-family: FontAwesome;
            color: #333;
            font-size: 30px;
        }
        .owl-controls .owl-buttons .owl-next:after {
            content: "⇥";
        }
        @media only screen and (max-width: 1280px) {
            .post-slide .post-content {
                padding: 0px 15px 25px 15px;
            }
        }
    </style>
    <?php
    function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
    ?>
    @if (count($dealSlides) > 0)
        <!-- ======= Hero Section ======= -->
        <section class="mt-5 hero-section">
            <div class="container px-0">
                <!-- For Desktop -->
                <div id="carouselDesktop" class="carousel slide forDesktop" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($dealSlides as $index => $single)
                            @if($index < 5)
                                <button type="button" data-bs-target="#carouselDesktop" data-bs-slide-to="{{ $index }}"
                                        class="@if($index == 0) active @endif" @if($index == 0) aria-current="true"
                                        @endif aria-label="Slide {{ $index }}"></button>
                            @endif
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach($dealSlides as $index => $slide)
                            <?php
                            $images = json_decode($slide->slide, true);
                            ?>
                            @if($index < 5)
                                {{-- <a href="{{ $slide->url }}" target="_blank"> --}}
                                <div class="carousel-item @if($index == 0) active @endif">
                                    <img onerror="this.src='https://420finder.net/assets/img/logo01.png'"  src="{{ $images['desktop'] }}" class="d-block w-100 br-30" alt="..."
                                         onclick="location.href = '{{ $slide->url }}'" style="cursor: pointer;">
                                </div>
                                {{-- </a> --}}
                            @endif
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselDesktop"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselDesktop"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- For Mobile -->
                <div id="carouselMobile" class="carousel slide forMobile" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        {{-- @if(count($slidesmobile) > 0)
                            @foreach($slidesmobile as $index => $single) --}}
                        @if(count($dealSlides) > 0)
                            @foreach($dealSlides as $index => $single)
                                @if($index < 5)
                                    <button type="button" data-bs-target="#carouselMobile"
                                            data-bs-slide-to="{{ $index }}" class="@if($index == 0) active @endif"
                                            @if($index == 0) aria-current="true"
                                            @endif aria-label="Slide {{ $index }}"></button>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="carousel-inner">
                        @if(count($dealSlides) > 0)
                            @foreach($dealSlides as $index => $slide)
                                <?php
                                $images = json_decode($slide->slide, true);
                                ?>
                                @if($index < 5)
                                    <div class="carousel-item @if($index == 0) active @endif">
                                        <img onerror="this.src='https://420finder.net/assets/img/logo01.png'"  src="{{ $images['mobile'] }}" class="d-block w-100" alt="..."
                                             onclick="location.href = '{{ $slide->url }}'" style="cursor: pointer;">
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselMobile"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselMobile"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section><!-- End Hero -->
    @endif
    <section class="p-0">
        <div class="container mt-4">
            <div class="row pb-4">
                @if(!empty($location))
                    <p>Showing Marijuana Listings in <strong>{{ $location }}</strong></p>
                @else
                    <div class="col-md-4 offset-md-4 py-3 mb-4 border text-black-50 text-center">
                        Please select your location.
                    </div>
                @endif
                <div class="col-md-12 text-center">
                    <div class="d-flex border-bottom">
                        <a href="#nearby" class="me-4"><h5>Retailers</h5></a>
                        <a href="#productsonsale"><h5>Products on sale</h5></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p-0" id="productsonsale">
        <div class="container">
            <div class="row">
                <h4>
                    <strong>Featured deals nearby</strong>
                </h4>
                <div class="row">
                    @if(count($businesses) > 0)
                        <?php
                        $businessIds = [];
                        foreach ($businesses as $business) {
                            array_push($businessIds, $business->id);
                        }
                        ?>
                        <?php
                        $deals = App\Models\Deal::whereIn('retailer_id', $businessIds)
                            ->get();
                        ?>
                        @if (count($deals) > 0)
                            <div id="news-slider1" class="owl-carousel">
                                @foreach ($deals as $deal)
                                    <div class="post-slide">
                                        <div class="card">
                                            @if($deal->percentage > 0)
                                                <label class="label-off">{{ $deal->percentage }}% off</label>
                                            @endif
                                            <div class="post-img">
                                                <img onerror="this.src='https://420finder.net/assets/img/logo01.png'"  src="{{ json_decode($deal->picture)[0] }}" class="card-img-top"
                                                     alt="...">
                                                <a href="{{ route('dealsingle', ['id' => $deal->id]) }}"
                                                   class="mb-3 cursor-pointer over-layer"><i class="fa fa-link"></i>
                                                </a>
                                            </div>
                                            <div class="p-3" style="border-top: 3px solid #f8971c;">
                                                <?php
                                                $retailer = App\Models\Business::where('id', $deal->retailer_id)->first();
                                                ?>
                                                <span class="pnamemobile"><b>{{ $retailer->business_name }}</b></span>
                                                @if($retailer->profile_picture)
                                                    <img onerror="this.src='https://420finder.net/assets/img/logo01.png'"  src="{{asset($retailer->profile_picture)}}"
                                                         style="width: 60px; height: 50px; float: right"
                                                         class="card-img-top"
                                                         alt="...">
                                                @else
                                                    <img src="https://420finder.net/assets/img/logo.png"
                                                         style="width: 60px; height: 50px; float: right"
                                                         class="card-img-top"
                                                         alt="...">
                                                @endif
                                                <h6 class="pnamemobile">
                                                    <i class="fas fa-box"></i> <b>{{ $retailer->business_type }}</b>
                                                </h6>
                                                <?php
                                                    $reviews = $retailer->review_count();
                                                    $totalratings = $retailer->calculatedRating();
                                                ?>
                                                <div class="rating-wrap">
                                                    <div class="index-rating-deals"
                                                         data-rating="{{ $totalratings }}"></div>
                                                    <div class="reviewAvgCount">
                                                        <span>{{ number_format($totalratings, 1) }}</span>
                                                        <span>({{ $reviews }})</span>
                                                    </div>
                                                </div>
                                                <h6 class="pnamemobile">
                                                    <strong>{{ $deal->title }}</strong>
                                                </h6>
                                                <h6><strong>$ {{ $deal->deal_price }}</strong></h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                    <div class="row no-record-found-deal">
                                        {{-- <div class="col-md-1 col-1">
                                            <img src="{{ asset('images/not-found.svg') }}" alt="">
                                        </div> --}}
                                        <div class="col-md-12 col-12">
                                            <div class="carts-img">
                                                <img src="{{ asset('images/deal/nodealsinyourarea_banner.jpg') }}"
                                                     alt="Empty Deal Desktop" class="retailer-desktop-banner"
                                                     style="margin: 0;">
                                                <img
                                                    src="{{ asset('images/deal/nodealsinyourarea_banner_mobile.jpg') }}"
                                                    alt="Empty Deal Mobile" class="retailer-mobile-banner"
                                                    style="margin: 0;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @else
                                    <div class="row no-record-found-deal">
                                        <div class="col-md-12 col-12">
                                            <div class="carts-img">
                                                <img src="{{ asset('images/deal/nodealsinyourarea_banner.jpg') }}"
                                                     alt="Empty Deal Desktop" class="retailer-desktop-banner"
                                                     style="margin: 0;">
                                                <img
                                                    src="{{ asset('images/deal/nodealsinyourarea_banner_mobile.jpg') }}"
                                                    alt="Empty Deal Mobile" class="retailer-mobile-banner"
                                                    style="margin: 0;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p-0 mb-0" id="nearby">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 col-8">
                    <h4>
                        <strong>Retailers nearby</strong>
                    </h4>
                </div>
                {{-- @if(count($businesses) > 0)
                <div class="col-md-4 col-4 text-end">
                    <a href="{{ route('deliveries') }}" style="font-weight: 600">View all ></a>
                </div>
                @endif --}}
                <div class="row">
                    @if(count($businesses) > 0)
                        <div id="news-slider2" class="owl-carousel">
                            @foreach($businesses as $business)
                                <div class="post-slide">
                                    <div class="post-img">
                                        @if($business->profile_picture == 'https://jeremiahc1.sg-host.com/assets/img/logo.png')
                                            <div style="width: auto; height: 238px;" class="bg-light defaultImage">
                                                <img src="{{ asset('assets/img/logo.png') }}" class="card-img-top"
                                                     alt="..."
                                                     style="opacity: 0.3;padding-top: 60px; width: 100%;padding-left: 20px;padding-right: 20px;">
                                            </div>
                                        @elseif($business->profile_picture == '')
                                            <div style="width: auto; height: 238px;" class="bg-light defaultImage">
                                                <img src="{{ asset('assets/img/logo.png') }}" class="card-img-top"
                                                     alt="..."
                                                     style="opacity: 0.3;padding-top: 60px; width: 100%;padding-left: 20px;padding-right: 20px;">
                                            </div>
                                        @else
                                            <img src="{{ $business->profile_picture }}" class="card-img-top"
                                                 style="width: 100%; height: 238px;">
                                        @endif
                                        @if($business->business_type == 'Dispensary')
                                            <a href="{{ route('dispensarysingle', ['slug' => $business->slug??"retailer", 'id' => $business->id]) }}"
                                               class="over-layer">
                                                <i class="far fa-heart heartIcon"></i>
                                                <img src="{{ asset('images/icons/icondispensary.png') }}"
                                                     class="markerImageIcon">
                                            </a>
                                        @else
                                            <a href="{{ route('deliverysingle', ['slug' => $business->slug??"reatiler", 'id' => $business->id]) }}"
                                               class="over-layer">
                                                <i class="far fa-heart heartIcon"></i>
                                                <img src="{{ asset('images/icons/icondelivery.png') }}"
                                                     class="markerImageIcon">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="post-content">
                                        <div class="card-body pt-1 mobilePaddingZero">
                                            <div class="address-line">
                                                {{ $business->address_line_1 }} |
                                                <span style="font-size: 10px;font-weight: 100;">
                                                  <?php
                                                    $latitude = '';
                                                    $longitude = '';
                                                    if (Session::has('latitude') && Session::has('longitude')) {
                                                        $latitude = session('latitude');
                                                        $longitude = session('longitude');
                                                    } else {
                                                        $latitude = "34.0201613";
                                                        $longitude = "-118.6919234";
                                                    }
                                                    echo round(distance($latitude, $longitude, $business->latitude, $business->longitude, 'M')); ?> mi</span>
                                            </div>
                                            <div class="address-title">
                                                <a href="{{ route('deliverysingle', ['slug' => $business->slug??"retailer", 'id' => $business->id]) }}"
                                                   class="retailerTitle">
                                                    {{ $business->business_name }}
                                                </a>
                                            </div>
                                            <?php
                                                $reviews = $business->review_count();
                                                $totalratings = $business->calculatedRating();
                                            ?>
                                            <div class="rating-wrap">
                                                <div class="index-rating-deals" data-rating="{{ $totalratings }}"></div>
                                                <div class="reviewAvgCount">
                                                    <span>{{ number_format($totalratings, 1) }}</span>
                                                    <span>({{ $reviews }})</span>
                                                </div>
                                            </div>
                                            <div>
                                                @if($business->business_type == 'Dispensary')
                                                    <a href="{{ route('dispensarysingle', ['slug' => $business->slug??"retailer", 'id' => $business->id]) }}"
                                                       class="retailerOrderBtn order-pickup-btn"><i
                                                            class="fas fa-shopping-cart"></i>
                                                        <span>Order for Pickup</span></a>
                                                @else
                                                    <a href="{{ route('deliverysingle', ['slug' => $business->slug??"retailer", 'id' => $business->id]) }}"
                                                       class="retailerOrderBtn order-pickup-btn"><i
                                                            class="fas fa-shopping-cart"></i>
                                                        <span>Order for Delivery</span></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row no-record-found-deal mb-3">
                            <h3>THERE ARE NO RETAILERS IN YOUR AREA AT THIS TIME. CHECK BACK AGAIN SOON!</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-8">
                    <h5 style="font-weight: 600;" class="pb-2">Browse by category</h5>
                </div>
                <div class="col-md-4 col-4 text-end">
                    <a href="{{ route('categories') }}" style="font-weight: 600;">View all ></a>
                </div>
            </div>
            <div class="row">
                @if($categories->count() > 0)
                    @foreach($categories as $category)
                        <a href="{{ route('products.category', ['category' => $category['slug']]) }}"
                           class="col-md-3 col-6 mb-3">
                            <div class="card border shadow-sm">
                                <img src="{{ $category->image }}" class="card-img-top" alt="..." style="width: 100%;">
                                <div class="card-body pt-1">
                                    <div
                                        style="font-size: 1rem;letter-spacing: 0.00625rem;line-height: 2.25rem;text-align: center;">{{ $category->name }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(".index-rating-deals").starRating({
            readOnly: true,
            totalStars: 5,
            starSize: 18,
            emptyColor: 'lightgray',
            activeColor: '#f8971c',
            useGradient: false
        });
    </script>
@endpush

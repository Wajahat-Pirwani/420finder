@extends('layouts.app')
@section('title', $delivery->business_name)
@section('meta')
    {{$delivery->seo}}
    <link rel="canonical" href="https://www.420finder.net/public/dispensaries/{{$delivery->slug}}/{{$delivery->id}}"/>
    <link rel="alternate" href="https://www.420finder.net/public/dispensaries/{{$delivery->slug}}/{{$delivery->id}}" hreflang="en-ca"/>
    <link rel="alternate" href="https://www.420finder.net/public/dispensaries/{{$delivery->slug}}/{{$delivery->id}}" hreflang="en-us"/>
    <link rel="alternate" href="https://www.420finder.net/public/dispensaries/{{$delivery->slug}}/{{$delivery->id}}" hreflang="en-gb"/>
    <script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "Product",
          "name": "{{$delivery->business_name}}",
          "image": "{{$delivery->profile_picture}}",
          "description": "{{$delivery->about}}",
          "brand": {
            "@type": "Brand",
            "name": "420finder"
          },
          "offers": {
            "@type": "Offer",
            "url": "https://www.420finder.net/public/dispensaries/{{$delivery->slug}}/{{$delivery->id}}",
            "priceCurrency": "USD",
            "price": ""
          }
        }
    </script>

@endsection
@section('content')
    @if (strlen(trim($deliveryBanner->content)) > 0)
        <section class="bg-dark text-white delivery-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <i class="fas fa-shopping-cart"></i> {{ $deliveryBanner->content }}
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section>
        <div class="container">
            <div class="row topDeliveryRow retailer-single-info">
                <div class="col-sm-4 col-md-3 text-center col-12 d-flex">
                    <div class="retailer-single-thumb">
                        @if($delivery->profile_picture == '' || $delivery->profile_picture == 'https://images.weedmaps.com/original/image_missing.jpg' )
                            <img src="https://420finder.net/assets/img/logo.png" alt=""
                                 class="w-100 h-100 img-thumbnail">
                        @else
                            <img onerror="this.src='https://420finder.net/assets/img/logo01.png'"
                                 src="{{ $delivery->profile_picture }}" alt="" class="w-100 h-100 img-thumbnail">
                        @endif
                        <div class="favBrand favoriteButton retailer-single-fvt-btn">
                            @if (Session::has('customer_id') == false)
                                <a href="{{ route('signin') }}"><i class="far fa-heart pe-4 shadow ms-3"></i></a>
                            @else
                                <a rel="{{ $delivery->id }}" class="favdelivery cursor-pointer"><i
                                        class="far fa-heart pe-4 shadow ms-3"></i></a>
                            @endif
                            <span class="followers"> 309 followers</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-9 col-12">
                    <h3 class="retailerbnametext text-black-50"><strong>{{ $delivery->business_name }}</strong></h3>

                    <ul class="list-unstyled d-flex ratings">
                        <?php
                            $reviews = $delivery->review_count();
                            $totalratings = $delivery->calculatedRating();

                        if ($totalratings < 1) {
                            echo '
                                    <li><a><i class="far fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                ';
                        } elseif ($totalratings <= 1) {
                            echo '
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                ';
                        } elseif ($totalratings > 1 AND $totalratings <= 2) {
                            echo '
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                ';
                        } elseif ($totalratings > 2 AND $totalratings <= 3) {
                            echo '
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                ';
                        } elseif ($totalratings > 3 AND $totalratings <= 4) {
                            echo '
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="far fa-star"></i></a></li>
                                ';
                        } elseif ($totalratings > 4 AND $totalratings <= 5) {
                            echo '
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="fa fa-star"></i></a></li>
                                    <li><a><i class="fa fa-star"></i></a></li>
                                ';
                        }
                        //                        echo " <span class='reviewCount'>(" . $reviews->count() . ")</span>";
                        ?>
                        <span class='reviewCount'>({{ $reviews }})</span>
                    </ul>
                    <?php $state = \Illuminate\Support\Facades\DB::table('states')->where('id', '=', $delivery->state_province)->first(); ?>
                    <p class="retailerbnametext" style="font-weight: bold;">{{ $delivery->city }}
                        , {{ $state->name ?? $delivery->state_province}}</p>
                    <div class="row detailedBox">
                        <div class="col-md-3 col-6">
                            <ul class="list-unstyled">
                                <li class="pb-2" style="font-weight: bold;"><i class="fas fa-store"></i> Dispensary
                                    Storefront
                                </li>
                                <li class="pb-2" style="font-weight: bold;"><i class="fas fa-shopping-cart"></i> Order
                                    online (Pickup Only)
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-6">
                            <ul class="list-unstyled">
                                <li class="pb-2"><i class="fas fa-clock"></i>
                                    @if($delivery->checkOpenStatus() == "CLOSED")
                                        <span style='color: red; font-weight: bold'>{{$delivery->checkOpenStatus()}} </span>
                                    @else
                                        <span
                                            style='color: #00b700;font-weight: bold'>{{$delivery->checkOpenStatus()}} </span>
                                    @endif
                                </li>
                                {{--                                    <small>{{$date->format('h:i a')}}</small>--}}
                                </li>
                                {{-- <li class="pb-2">
                                    <i class="fas fa-check-circle"></i> License Information
                                </li> --}}
                                <li class="pb-2" style="font-weight: bold;">
                                    @if($delivery->instagram != null)
                                        <a href="{{ $delivery->instagram }}" target="_blank"><i
                                                class="fab fa-instagram"></i> Instagram</a>
                                    @endif
                                    @if($delivery->instagram != null && $delivery->website != null)
                                        <span> OR </span>
                                    @endif
                                    @if($delivery->website != null)
                                        <a href="{{ $delivery->website }}" target="_blank"><i class="fa fa-globe"></i>Website</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if($delivery->top_business == 1)
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-unstyled">
                                    <li class="pb-2" style="font-weight: bold;"><img style="width:30px !important;"
                                                                                     src="{{asset('images/23-233700_client-success-stories-award-png-icon-free-transparent.png')}}"> {{$delivery->top_text??""}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <a href="tel:{{ $delivery->phone_number }}"
                               class="btn btn-outline-dark me-2 px-4 ctaButtons ctaButtonFirst">
                                <i class="fas fa-phone-alt"></i> {{ $delivery->phone_number }}
                            </a>
                            <a href="mailto:{{ $delivery->email }}"
                               class="btn btn-outline-dark px-4 ctaButtons ctaButtonSecond" target="_blank">
                                <i class="fas fa-directions"></i> Directions
                            </a>
                            <div class="favBrand favoriteButton retailer-single-fvt-btn">
                                @if (Session::has('customer_id') == false)
                                    <a href="{{ route('signin') }}"><i class="far fa-heart pe-4 shadow ms-3"></i></a>
                                @else
                                    <?php
                                    $fav = \App\Models\Favorite::where('customer_id', session('customer_id'))->where('type_id', $delivery->id)->first();
                                    ?>
                                    @if($fav)
                                        <a rel="{{ $delivery->id }}" data="Dispensary" id="deletefavourite"
                                           class="unfavdelivery fav-style cursor-pointer">
                                            <i class="fa fa-heart pe-4 shadow ms-3"></i>
                                        </a>
                                        <a rel="{{ $delivery->id }}" data="Dispensary" id="addfavourites"
                                           class="favdelivery cursor-pointer" style="display: none">
                                            <i class="far fa-heart pe-4 shadow ms-3"></i>
                                        </a>
                                    @else
                                        <a rel="{{ $delivery->id }}" data="Dispensary" id="deletefavourite"
                                           class="unfavdelivery fav-style cursor-pointer" style="display: none">
                                            <i class="fa fa-heart pe-4 shadow ms-3"></i>
                                        </a>
                                        <a rel="{{ $delivery->id }}" data="Dispensary" id="addfavourites"
                                           class="favdelivery cursor-pointer">
                                            <i class="far fa-heart pe-4 shadow ms-3"></i>
                                        </a>
                                    @endif
                                @endif
                                <span class="followers"> 309 followers</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active c-tabs" id="vue-menu-tab" data-bs-toggle="tab"
                                    data-bs-target="#vue-menu"
                                    type="button" role="tab" aria-controls="menu" aria-selected="true">Menu
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button onclick="toggleError(this)" class="nav-link c-tabs" id="details-tab-new"
                                    data-bs-toggle="tab" data-bs-target="#details-new" type="button" role="tab"
                                    aria-controls="details" aria-selected="false">Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link deal-tab-btn c-tabs" id="deals-tab" data-bs-toggle="tab"
                                    data-bs-target="#deals" type="button" role="tab" aria-controls="deals"
                                    aria-selected="false">
                                <span>
                                    Deals
                                </span>
                                <?php
                                $date = DB::table('subscription_details')->orderBy('id', 'DESC')->where('retailer_id', '=', $delivery->id)->first();
                                $state_name = DB::table('states')->where('id', '=', $date->state_id ?? 1)->first();
                                $currentDate = date('Y-m-d');
                                $currentDate = date('Y-m-d', strtotime($currentDate));
                                $startDate = date('Y-m-d', strtotime($date->starting_date ?? '12-2-2021'));
                                $endDate = date('Y-m-d', strtotime($date->ending_date ?? '12-2-2021'));
                                ?>
                                @if(count($deals) > 0 && ($currentDate >= $startDate) && ($currentDate <= $endDate))
                                    <span class="deal-count">{{ count($deals) }}</span>
                                @endif
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link c-tabs" id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews"
                                    type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link c-tabs" id="gallery-tab" data-bs-toggle="tab"
                                    data-bs-target="#gallery"
                                    type="button" role="tab" aria-controls="gallery" aria-selected="false">Gallery
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane show active" id="vue-menu" role="tabpanel" aria-labelledby="vue-menu-tab">
                            <?php
                            $products = \App\Models\DispenseryProduct::where('dispensery_id', $delivery->id)->get();
                            $isLogin = false;
                            if (Session::has('customer_id')) {
                                $isLogin = true;
                            }
                            ?>
                            @if (count($products) > 0 && ($currentDate >= $startDate) && ($currentDate <= $endDate))
                                <menu-dispensary id="{{ $delivery->id }}"
                                                 islogin="<?php echo $isLogin; ?>"></menu-dispensary>
                            @else
                                <div style="margin-top: 0.9rem">
                                    <div class="refer-claim-wrap">
                                        <a target="_blank" href="mailto:support@420finder.net" class="d-block">
                                            <div class="refer-img">
                                                <img
                                                    src="{{ asset('images/retailer-banners/referabusiness_banner.jpg') }}"
                                                    alt="Claim Business Banner" class="retailer-desktop-banner">
                                                <img
                                                    src="{{ asset('images/retailer-banners/referabusiness_banner_mobile.jpg') }}"
                                                    alt="Claim Business Banner Mobile" class="retailer-mobile-banner">
                                            </div>
                                        </a>
                                        <a target="_blank"
                                           href="mailto:support@420finder.net?subject=Business Claim {{$delivery->business_name}}&body=I want to claim this business, This belongs to my property"
                                           class="d-block">
                                            <div class="claim-img">
                                                <img
                                                    src="{{ asset('images/retailer-banners/claimbusiness_banner.jpg') }}"
                                                    alt="Claim Business Banner" class="retailer-desktop-banner">
                                                <img
                                                    src="{{ asset('images/retailer-banners/claimbusiness_banner_mobile.jpg') }}"
                                                    alt="Claim Business Banner Mobile" class="retailer-mobile-banner">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="details-new" role="tabpanel"
                             aria-labelledby="details-tab">
                            <div class="row mt-5 detail-row">
                                <div class="col-md-7">
                                    @if(!is_null($detail))
                                        <div class="left-content">
                                            {{-- Introduction --}}
                                            <div class="detail-introduction">
                                                <h3 class="left-content-head">Introduction</h3>
                                                <div class="detail-intro-content">
                                                    {!! $detail->introduction !!}
                                                </div>
                                            </div>
                                            {{-- About Us --}}
                                            <div class="detail-about">
                                                <h3 class="left-content-head">About Us</h3>
                                                <div class="detail-about-content">
                                                    {!! $detail->about !!}
                                                </div>
                                            </div>
                                            {{-- Customers --}}
                                            <div class="detail-customer">
                                                <h3 class="left-content-head">First-Time Customers</h3>
                                                <div class="detail-customer-content">
                                                    {!! $detail->customers !!}
                                                </div>
                                            </div>
                                            {{-- Announcement --}}
                                            <div class="detail-announcement">
                                                <h3 class="left-content-head">Announcement</h3>
                                                <div class="detail-announ-detail">
                                                    {!! $detail->announcement !!}
                                                    <div class="state-license">
                                                        <h5>State License</h5>
                                                        {!! $detail->license !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div style="margin-top: 0.9rem">
                                            <div class="refer-claim-wrap">
                                                <a class="d-block">
                                                    <div class="refer-img">
                                                        <img
                                                            src="{{ asset('images/retailer-banners/retailerhasnodetails_banner.jpg') }}"
                                                            alt="Retailer Details Banner"
                                                            class="retailer-desktop-banner">
                                                        <img
                                                            src="{{ asset('images/retailer-banners/retailerhasnodetails_banner_mobile.jpg') }}"
                                                            alt="Retailer Details Banner Mobile"
                                                            class="retailer-mobile-banner">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <div class="right-content-wrap">
                                        <div id="domChange"></div>
                                        <details-map latitude="{{ $delivery->latitude }}"
                                                     longitude="{{ $delivery->longitude }}"
                                                     deliveryid="{{ $delivery->id }}"></details-map>
                                        {{-- RIGHT CONTENT EXTRA --}}
                                        <div class="right-content-extra">
                                            {{-- DELIVERY PLACE --}}
                                            <div class="location-name">
                                                <div class="location-icon">
                                                    <svg class="finder-icon-map-pin" width="22px" height="22px"
                                                         stroke="none" viewBox="0 0 24 24">
                                                        <path
                                                            d="M4 9.5c0 1.563.533 3 1.4 4.25L12 22l6.6-8.25A7.271 7.271 0 0 0 20 9.5C20 5.375 16.4 2 12 2S4 5.375 4 9.5zm4 .5c0-2.2 1.8-4 4-4s4 1.8 4 4-1.8 4-4 4-4-1.8-4-4z"
                                                            overflow="visible" fill="#999999"></path>
                                                    </svg>
                                                </div>
                                                <p style="max-width: 100%">{{ $delivery->address_line_1 }}</p>
                                            </div>
                                            {{-- DELIVERY PHONE --}}
                                            <div class="delivery-phone">
                                                <div class="phone-icon">
                                                    <svg class="finder-icon-phone" width="20px" height="20px"
                                                         viewBox="0 0 24 24">
                                                        <path fill="#999999"
                                                              d="M6.65 10.02c.12.28 2.07 4.94 7.43 7.23l1.7-1.72c.3-.3.75-.4 1.14-.26 1.25.4 2.6.63 3.97.63.61 0 1.11.5 1.11 1.11v3.88c0 .61-.5 1.11-1.11 1.11A18.89 18.89 0 012 3.11C2 2.5 2.5 2 3.11 2H7c.61 0 1.11.5 1.11 1.11 0 1.39.22 2.72.63 3.97.13.39.04.82-.27 1.13l-1.82 1.81z"></path>
                                                    </svg>
                                                </div>
                                                <a href="tel:{{ $delivery->phone_number }}">{{ $delivery->phone_number }}</a>
                                            </div>
                                            {{-- DELIVERY TIME --}}
                                            <div class="delivery-time delivery-common">
                                                <div class="time-icon">
                                                    <svg class="" height="20px" width="20px" viewBox="0 0 24 24">
                                                        <path fill="#999999"
                                                              d="M11.805 14.019H7.94a1.21 1.21 0 1 1 0-2.418h2.657V7.25a1.21 1.21 0 0 1 2.419 0v5.559a1.21 1.21 0 0 1-1.21 1.209M12 4.04C7.611 4.04 4.04 7.61 4.04 12c0 4.389 3.571 7.96 7.96 7.96 4.389 0 7.96-3.571 7.96-7.96 0-4.389-3.571-7.96-7.96-7.96M12 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10"></path>
                                                    </svg>
                                                </div>
                                                <div class="time-content">
                                                    <h6>
                                                        @if($delivery->checkOpenStatus() == "CLOSED")
                                                            <span style='color: red; font-weight: bold'>{{$delivery->checkOpenStatus()}} </span>
                                                        @else
                                                            <span
                                                                style='color: #00b700;font-weight: bold'>{{$delivery->checkOpenStatus()}} </span>
                                                        @endif
                                                    </h6>
                                                    <div class="week-content-wrap">
                                                        <div class="week-content">
                                                            {{-- MONDAY --}}
                                                            <div class="week-day">
                                                                <span>Monday</span>
                                                            </div>
                                                            <div class="week-time">
                                                                <span>
                                                                    @if($delivery->monday_open == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->monday_open)) }}
                                                                    @endif
                                                                    -
                                                                    @if($delivery->monday_close == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->monday_close)) }}
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="week-content">
                                                            {{-- TUESDAY --}}
                                                            <div class="week-day">
                                                                <span>Tuesday</span>
                                                            </div>
                                                            <div class="week-time">
                                                                <span>
                                                                    @if($delivery->tuesday_open == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->tuesday_open)) }}
                                                                    @endif
                                                                    -
                                                                    @if($delivery->tuesday_close == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->tuesday_close)) }}
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="week-content">
                                                            {{-- WEDNESDAY --}}
                                                            <div class="week-day">
                                                                <span>Wednesday</span>
                                                            </div>
                                                            <div class="week-time">
                                                                <span>
                                                                    @if($delivery->wednesday_open == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->wednesday_open)) }}
                                                                    @endif
                                                                    -
                                                                    @if($delivery->wednesday_close == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->wednesday_close)) }}
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="week-content">
                                                            {{-- THURSDAY --}}
                                                            <div class="week-day">
                                                                <span>Thursday</span>
                                                            </div>
                                                            <div class="week-time">
                                                                <span>
                                                                    @if($delivery->thursday_open == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->thursday_open)) }}
                                                                    @endif
                                                                    -
                                                                    @if($delivery->thursday_close == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->thursday_close)) }}
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="week-content">
                                                            {{-- FRIDAY --}}
                                                            <div class="week-day">
                                                                <span>Friday</span>
                                                            </div>
                                                            <div class="week-time">
                                                                <span>
                                                                    @if($delivery->friday_open == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->friday_open)) }}
                                                                    @endif
                                                                    -
                                                                    @if($delivery->friday_close == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->friday_close)) }}
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="week-content">
                                                            {{-- SATURDAY --}}
                                                            <div class="week-day">
                                                                <span>Saturday</span>
                                                            </div>
                                                            <div class="week-time">
                                                                <span>
                                                                    @if($delivery->saturday_open == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->saturday_open)) }}
                                                                    @endif
                                                                    -
                                                                    @if($delivery->saturday_close == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->saturday_close)) }}
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="week-content">
                                                            {{-- SUNDAY --}}
                                                            <div class="week-day">
                                                                <span>Sunday</span>
                                                            </div>
                                                            <div class="week-time">
                                                                <span>
                                                                    @if($delivery->sunday_open == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->sunday_open)) }}
                                                                    @endif
                                                                    -
                                                                    @if($delivery->sunday_close == null)
                                                                        Closed
                                                                    @else
                                                                        {{ date("h:i A", strtotime($delivery->sunday_close)) }}
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- DELIVERY EMAIL --}}
                                            <div class="delivery-email delivery-common">
                                                <div class="email-icon">
                                                    <svg class="finder-icon-envelope" width="20px" height="20px"
                                                         viewBox="0 0 24 24">
                                                        <path fill="#999999" fill-rule="evenodd"
                                                              d="M4 5h16c1.1 0 2 .79 2 1.75v.88l-10 5.74L2 7.63l.01-.88C2.01 5.79 2.9 5 4 5zM2 9.93v-2.3 2.3zm20 0l-10 5.73L2 9.93v7.32c0 .96.9 1.75 2 1.75h16c1.1 0 2-.79 2-1.75V9.92z"
                                                              clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                <a href="mailto:{{ $delivery->email }}">{{ $delivery->email }}</a>
                                            </div>
                                            <div class="delivery-email delivery-common">
                                                <div class="email-icon">
                                                    <svg class="" height="20px" width="20px" viewBox="0 0 24 24">
                                                        <path fill="#999999"
                                                              d="M11.805 14.019H7.94a1.21 1.21 0 1 1 0-2.418h2.657V7.25a1.21 1.21 0 0 1 2.419 0v5.559a1.21 1.21 0 0 1-1.21 1.209M12 4.04C7.611 4.04 4.04 7.61 4.04 12c0 4.389 3.571 7.96 7.96 7.96 4.389 0 7.96-3.571 7.96-7.96 0-4.389-3.571-7.96-7.96-7.96M12 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10"></path>
                                                    </svg>
                                                </div>
                                                <a href="#">Current Time
                                                    : {{Carbon\Carbon::parse(now())->timezone($delivery->timezone??"America/Los_Angeles")->format('H:i a')}}</a>
                                            </div>
                                            {{-- DELIVERY LINK --}}
                                            <div class="delivery-link delivery-common">
                                                <div class="link-icon">
                                                    <svg class="finder-icon-link" height="20px" width="20px"
                                                         viewBox="0 0 24 24">
                                                        <path fill="#999999"
                                                              d="M9.536 13.15h4.902a1.225 1.225 0 1 0 0-2.452H9.536a1.225 1.225 0 1 0 0 2.451M15.827 6h-1.026a1.2 1.2 0 0 0 0 2.4h1.085c2.003 0 3.71 1.587 3.714 3.59.005 2.045-1.556 3.61-3.6 3.61h-1.2a1.2 1.2 0 1 0 0 2.4H16c3.364 0 6.006-2.646 6-6.012C21.994 8.651 19.164 6 15.827 6M4.4 11.99C4.405 9.988 6.11 8.4 8.114 8.4h1.085a1.2 1.2 0 1 0 0-2.4H8.173C4.836 6 2.006 8.65 2 11.988 1.994 15.354 4.636 18 8 18h1.2a1.2 1.2 0 1 0 0-2.4H8c-2.044 0-3.605-1.565-3.6-3.61"></path>
                                                    </svg>
                                                </div>
                                                <a href="{{ $delivery->website }}" target="_blank">
                                                    {{ $delivery->website }}
                                                </a>
                                            </div>
                                            {{-- DELIVERY SOCIAL - INSTAGRAM --}}
                                            <div class="delivery-insta delivery-common">
                                                <div class="insta-icon">
                                                    <svg class="finder-icon wm-instagram-standard" width="20px"
                                                         height="20px" viewBox="0 0 24 24">
                                                        <path fill="#999999"
                                                              d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"></path>
                                                    </svg>
                                                </div>
                                                <a href="{{ $delivery->instagram }}">
                                                    @Instagram
                                                </a>
                                            </div>
                                            {{-- DELIVERY SOCIAL - TWITTER --}}
                                            <div class="delivery-twitter delivery-common">
                                                <div class="twitter-icon">
                                                    <svg class="wm-icon-twitter-standard" width="20px" height="20px"
                                                         viewBox="0 0 21 21">
                                                        <g transform="translate(-1 -2)">
                                                            <path fill="#999999"
                                                                  d="M22 6.8l-2.4.6c1-.5 1.5-1.2 1.8-2.1-.8.4-1.6.7-2.6.9a4.1 4.1 0 0 0-3-1.2c-1 0-2 .4-2.9 1.1a3.5 3.5 0 0 0-1 3.6 12.2 12.2 0 0 1-8.5-4 3.5 3.5 0 0 0 0 3.7c.3.6.7 1 1.3 1.4-.7 0-1.3-.2-1.9-.5 0 1 .3 1.7 1 2.4.6.7 1.4 1.2 2.3 1.3a4.6 4.6 0 0 1-1.9.1A4.2 4.2 0 0 0 8 16.7a8.5 8.5 0 0 1-6 1.6 12.9 12.9 0 0 0 10.4 1 10.7 10.7 0 0 0 5.6-4.1 10.6 10.6 0 0 0 2-6.5c.7-.5 1.4-1.2 2-2z"></path>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <a href="https://www.instagram.com/">
                                                    @Twitter
                                                </a>
                                            </div>
                                            {{-- DELIVERY SOCIAL - FACEBOOK --}}
                                            <div class="delivery-facebook delivery-common">
                                                <div class="fb-icon">
                                                    <svg class="finder-icon-facebook-standard" width="20px"
                                                         height="20px" viewBox="0 0 24 24">
                                                        <path fill="#999999" fill-rule="nonzero"
                                                              d="M14.3 8.6V6.8v-.6l.3-.4.4-.3h3V2h-3.3c-1.9 0-3.2.4-4 1.1-.9.8-1.3 2-1.3 3.4v2H7V12h2.4v10h5V12h3.2l.4-3.4h-3.7z"></path>
                                                    </svg>
                                                </div>
                                                <a href="https://www.facebook.com/mydyrect">Facebook</a>
                                            </div>
                                        </div>
                                        {{-- RIGHT CONTENT EXTRA ENDS --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $date = DB::table('deals')->orderBy('id', 'DESC')->where('retailer_id', '=', $delivery->id)->first();
                        $currentDate = date('Y-m-d');
                        $currentDate = date('Y-m-d', strtotime($currentDate));
                        $startDate = date('Y-m-d', strtotime($date->starting_date ?? '12-2-2021'));
                        $endDate = date('Y-m-d', strtotime($date->ending_date ?? '12-2-2021'));
                        ?>
                        <div class="tab-pane fade deals-tab" id="deals" role="tabpanel" aria-labelledby="deals-tab">
                            <div class="row " style="margin-top: 1.5rem">
                                @if ( ($currentDate >= $startDate) && ($currentDate <= $endDate))
                                    <deals-slider :deals="{{$deals}}" :business="{{$delivery}}"></deals-slider>
                                @else
                                    <div class="container">
                                        <div class="no-deals-img">
                                            <img
                                                src="{{ asset('images/retailer-banners/retailerhasnodeals_banner.jpg') }}"
                                                alt="Retailer has no deals" class="retailer-desktop-banner">
                                            <img
                                                src="{{ asset('images/retailer-banners/retailerhasnodeals_banner_mobile.jpg') }}"
                                                alt="Retailer has no deals" class="retailer-mobile-banner">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade review-tab" id="reviews" role="tabpanel"
                             aria-labelledby="reviews-tab">
                            @if(session()->has('customer_id'))
                                <retailer-reviews retailerid="{{ $delivery->id }}" :user="true"
                                                  isreviewed="{{ $isReviewed }}"
                                                  desktop="{{ asset('images/retailer-banners/leaveareview_banner.jpg') }}"
                                                  mobile="{{ asset('images/retailer-banners/leaveareview_banner_mobile.jpg') }}"></retailer-reviews>
                            @else
                                <retailer-reviews retailerid="{{ $delivery->id }}" :user="false"
                                                  isreviewed="{{ $isReviewed }}"
                                                  desktop="{{ asset('images/retailer-banners/leaveareview_banner.jpg') }}"
                                                  mobile="{{ asset('images/retailer-banners/leaveareview_banner_mobile.jpg') }}"></retailer-reviews>
                            @endif
                        </div>
                        <div class="tab-pane fade gallery-tab" id="gallery" role="tabpanel"
                             aria-labelledby="gallery-tab">
                            <div class="row mt-5">
                                @if(count($gallery) > 0)
                                    @foreach($gallery as $row)
                                        <div class="col-md-3 pt-3 pb-3">
                                            <div class="thumbnail">
                                                <img src="{{$row->image}}" alt="Lights" style="width:100%;">
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <div class="thumbnail">
                                            <img src="{{asset('images/no-image.jpg')}}" alt="Lights"
                                                 style="width:100%;">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        function toggleError(button) {
            $('#map').show();
        }
    </script>
    <script type="application/javascript" src="{{ asset('assets/js/star-rating/jquery.star-rating-svg.js') }}"></script>
    <script>
        $(".index-rating").starRating({
            readOnly: true,
            totalStars: 5,
            starSize: 18,
            emptyColor: 'lightgray',
            activeColor: '#f8971c',
            useGradient: false
        });
    </script>
@endpush
@push('style')
    <style>
@endpush

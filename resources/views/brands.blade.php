@extends('layouts.app')
@section('title', '420 Finder')
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
    @if (count($brandSlides) > 0)
        <!-- ======= Hero Section ======= -->
        <section class="mt-5 hero-section" style="padding-bottom: 0px">
            <div class="container px-0">
                <!-- For Desktop -->
                <div id="carouselDesktop" class="carousel slide forDesktop" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($brandSlides as $index => $single)
                            @if($index < 5)
                                <button type="button" data-bs-target="#carouselDesktop" data-bs-slide-to="{{ $index }}"
                                        class="@if($index == 0) active @endif" @if($index == 0) aria-current="true"
                                        @endif aria-label="Slide {{ $index }}"></button>
                            @endif
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach($brandSlides as $index => $slide)
                            <?php
                            $images = json_decode($slide->slide, true);
                            ?>
                            @if($index < 5)
                                {{-- <a href="{{ $slide->url }}" target="_blank"> --}}
                                <div class="carousel-item @if($index == 0) active @endif">
                                    <img  onerror="this.src='https://420finder.net/assets/img/logo01.png'"  src="{{ $images['desktop'] }}" class="d-block w-100 br-30" alt="..."
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
                        @if(count($brandSlides) > 0)
                            @foreach($brandSlides as $index => $single)
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
                        @if(count($brandSlides) > 0)
                            @foreach($brandSlides as $index => $slide)
                                <?php
                                $images = json_decode($slide->slide, true);
                                ?>
                                @if($index < 5)
                                    <div class="carousel-item @if($index == 0) active @endif">
                                        <img  onerror="this.src='https://420finder.net/assets/img/logo01.png'"  src="{{ $images['mobile'] }}" class="d-block w-100" alt="..."
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
    <section class="">
        <div class="container mt-4">
            <div class="row">
                @if(!empty($location))
                    <p style="text-align: center">Showing Marijuana Listings in <strong>{{ $location }}</strong></p>
                @else
                    <div class="col-md-4 offset-md-4 py-3 mb-4 border text-black-50 text-center">
                        Please select your location.
                    </div>
                @endif
                @if(count($brands) > 0)
                    @foreach($brands as $brand)
                        <a href="{{ route('brandsingle', [ 'id' => $brand->id]) }}" class="col-md-3 col-6">
                            <div class="border brandvisited">
                                <img onerror="this.src='https://420finder.net/assets/img/logo01.png'"  src="{{ $brand->profile_picture }}" alt="{{ $brand->business_name }}"
                                     class="w-100">
                                <div class="pt-1 px-3 border-top">
                                    <p class="pt-2 mb-0" style="font-size: 14px;">
                                        <strong>{{ $brand->business_name }}</strong></p>
                                    <p class="mb-0" style="font-size: 14px;">{{ $brand->business_type }}</p>
                                    <p style="font-weight: bold">Verified <i class="fa fa-check-circle"
                                                                             style="color: #21a1fd"></i></p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <img class="mdn" src="{{asset('images/420finder_nobrandsinyourarea_desktop.jpg')}}" alt="">
                    <img class="destopnone" src="{{asset('images/420finder_nobrandsinyourarea_mobile.jpg')}}" alt="">
                @endif
            </div>
        </div>
    </section>
@endsection

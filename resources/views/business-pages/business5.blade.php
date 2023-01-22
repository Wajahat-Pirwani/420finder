@extends('layouts.app')

@section('title', '420 Finder')

@section('content')
    {{-- Hero Area --}}
    <div class="hero-area" style="background: url('{{ asset('assets/img/business-pages-imgs/Top Banner BG.png') }}') no-repeat center center/cover;">
        <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 hero-area-left">
                <div class="marker">
                    <img src="{{ asset('assets/img/business-pages-imgs/GREEN ARROW.png') }}" alt="Green Arrow Marker">
                </div>
                <div class="hero-area-left-content">
                    <p>
                        <strong><em>Turn traffic into sales</em></strong>
                    </p>
                    <p>
                       Get delivery and pickup orders from your page, and easily manage them with our platform.
                    </p>
                    <div class="hero-btns-wrap">
                        <a class="hero-btn" href="https://www.brands.420finder.net">
                            <em>GET STARTED</em>
                        </a>
                        <a class="hero-btn" href="#">
                            <em>CONTACT US</em>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 hero-area-right">
                <img src="{{ asset('assets/img/business-pages-imgs/BUSINESS LOGO.png') }}" alt="Business Logo">
            </div>
        </div>
        </div>
    </div>
    {{-- Hero Area Ends --}}

     {{-- ADS --}}
     <div class="ads circle-icons">
        <div class="container">
            <div class="ads-body">
                {{-- ADS ICONS --}}
                <div class="row">
                    <div class="ads-icons">
                        <img src="{{ asset('assets/img/business-pages-imgs/ICONS.png') }}" alt="Ads Icons">
                    </div>
                </div>
                {{-- ADS ICONS ENDS --}}
            </div>
        </div>
    </div>
    {{-- ADS ENDS --}}


    {{-- Icons --}}
    <div class="phones circle-icons easy-sign-up">
        <div class="phones-bg">
            <img src="{{ asset('assets/img/business-pages-imgs/GREY BAR.png') }}" alt="">
        </div>
        <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 icon-wrap mb-1-5">
                <div class="icon-img">
                    <img src="{{ asset('assets/img/business-pages-imgs/user-icon.png') }}" alt="User Icon">
                </div>
                <div class="icon-content">
                    <h3>Everybody loves convenience</h3>
                    <p>420 Finder Business pages stand out with beautiful design and customization to get in front of more local consumers.</p>
                </div>
            </div>
            <div class="col-12 col-md-6 icon-wrap">
                <div class="icon-img">
                <img src="{{ asset('assets/img/business-pages-imgs/user-circle-icon.png') }}" alt="User Circle Icon">
                </div>
                <div class="icon-content">
                    <h3>Easy to sign up</h3>
                    <p>420 Finder Orders works within your page and menus so it's simple to start getting orders.</p>
                </div>
            </div>
        </div>
        </div>
    </div>
    {{-- Icons ENDS --}}

    {{-- SOLUTIONS RETAILERS --}}
    <div class="solutions-retailers pages-retailers get-discovered">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 solutions-retailers-col mb-1-5">
                    <div class="solutions-retailers-content">
                        <h3>
                            <strong>
                                FASTER IN-STORE PICKUP
                            </strong>
                        </h3>
                        <p>
                            -Streamline order fufillment with our all-in-one dashboard
                        </p>
                        <p>
                            -Pack orders quickly and accurately at your fingertips
                        </p>
                        <p>
                            -Automatically notify shoppers when their orders are ready.
                        </p>
                        <a href="{{ route('addabusiness') }}">
                            LEARN MORE
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-1-5">
                    <img src="{{ asset('assets/img/business-pages-imgs/ORANGE PHOTO.png') }}" alt="Solutions Retailers">
                </div>
            </div>
        </div>
    </div>
    {{-- SOLUTIONS RETAILERS ENDS --}}

    {{-- SOLUTIONS BRANDS --}}
    <div class="solutions-brands pages-brands get-setup">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6 mb-1-5">
                        <img src="{{ asset('assets/img/business-pages-imgs/GREEN PHOTO.png') }}" alt="Solutions Brands">
                    </div>

                    <div class="col-12 col-md-6 mb-1-5 solutions-brands-col">
                        <div class="solutions-brands-content">
                            <h3>
                                <strong>
                                    SUPPORT TO HELP YOU SUCCEED
                                </strong>
                            </h3>
                            <p>-Orders focused marketing to help bring consumers to your page</p>
                            <p>-Business intelligence reports to give you insight into your orders.</p>
                            <a href="{{ route('addabusiness') }}">
                                LEARN MORE
                            </a>
                        </div>
                    </div>

                </div>
            </div>
</div>
{{-- SOLUTIONS BRANDS ENDS --}}

@endsection

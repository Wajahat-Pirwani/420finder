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
                        <strong><em>Custom business listings for active cannabis users...</em></strong>
                    </p>
                    <p>
                        <strong>420 Finder Business</strong> display your brand(s) for purchase-ready cannabis users, providing all information they need to learn about and purchase products near them.
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
     <div class="ads md">
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


    {{-- PHONES --}}
    <div class="phones">
        <div class="phones-bg">
            <img src="{{ asset('assets/img/business-pages-imgs/GREY BAR.png') }}" alt="">
        </div>
        <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 phone-col">
                <div class="phone-content">
                <h3>More than just a map</h3>
                <p>
                    Join our powerful cannabis industry business network and start growing your brand today for a fraction of the price. Download our mobile app today.
                </p>
                <a href="https://www.brands.420finder.net">
                    GET STARTED
                </a>
               </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="phone-imgs">
                    <img src="{{ asset('assets/img/business-pages-imgs/PHONES.png') }}" alt="Phones Images">
                </div>
            </div>
        </div>
        </div>
    </div>
    {{-- PHONES ENDS --}}

    {{-- SOLUTIONS RETAILERS --}}
    <div class="solutions-retailers pages-retailers">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 mb-1-5">
                    <img src="{{ asset('assets/img/business-pages-imgs/ORANGE PHOTO.png') }}" alt="Solutions Retailers">
                </div>
                <div class="col-12 col-md-6 mb-1-5 solutions-retailers-col">
                    <div class="solutions-retailers-content">
                        <h3>
                            <strong>
                                Pages for
                            </strong>
                            <strong>
                                RETAILERS
                            </strong>
                        </h3>
                        <p>Make it easy for people to find and shop your business:</p>
                        <p>-Update your menu in real time with POS integration.</p>
                        <p>-Add convenient online ordering for delivery or pickup</p>
                        <p>-Get verified by brands to be located as an authorized retailer</p>
                        <p>-Manage Customer Reviews to build your reputation</p>
                        <a href="{{ route('addabusiness') }}">
                            LEARN MORE
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- SOLUTIONS RETAILERS ENDS --}}

    {{-- SOLUTIONS BRANDS --}}
    <div class="solutions-brands pages-brands">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 mb-1-5 solutions-brands-col">
                        <div class="solutions-brands-content">
                            <h3>
                                <strong>
                                    PAGES
                                    for
                                </strong>
                                <strong>
                                    BRANDS
                                </strong>
                            </h3>
                            <p>Tell your brand story and make it easy for people to discover your products.</p>
                            <p>-Showcase your full product catalogue</p>
                            <p>-Verify authorized retailers to display on your product locators</p>
                            <p>-Manage customer reviews to build reputation</p>
                            <p>-Attract followers to your brand</p>
                            <a href="{{ route('addabusiness') }}">
                                LEARN MORE
                            </a>

                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-1-5">
                        <img src="{{ asset('assets/img/business-pages-imgs/GREEN PHOTO.png') }}" alt="Solutions Brands">
                    </div>
                </div>
            </div>
     </div>
     {{-- SOLUTIONS BRANDS ENDS --}}


@endsection

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
                        The <strong><em>MOST SOPHISTICATED</em></strong> tool for <strong><em>CREATING, GROWING, </em></strong> and <strong><em>OPERATING</em></strong> your <strong><em>CANNABIS BUSINESS</em></strong> or <strong><em>PRODUCT...</em></strong>
                    </p>
                    <p>
                        <strong><em>'420 Finder Business'</em></strong> is an integrated system and online tool that focuses on marketing logistics, and commerce/e-commerce while providing and exciting, visually pleasing and "what you see is what you get" experience for Product Users and Business Owers alike, big or small.
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

    {{-- Icons --}}
    <div class="icons">
        <div class="container">
            <div class="icons-head">
                <h3>THE MOST MODERN & EFFICIENT WAY TO GROW YOUR CANNABIS COMPANY</h3>
            </div>

            <div class="icons-body">

                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3 mb-1-5">
                        <div class="icon-box">
                            <div class="icon-img">
                                <img src="{{ asset('assets/img/business-pages-imgs/icon-1.png') }}" alt="Icon 1">
                            </div>
                            <div class="icon-text">
                                <h3>Gain, Engage, & Keep <span class="sp-green">Active Users</span>.</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-1-5">
                        <div class="icon-box">
                            <div class="icon-img">
                                <img src="{{ asset('assets/img/business-pages-imgs/icon-2.png') }}" alt="Icon 2">
                            </div>
                            <div class="icon-text">
                                <h3><span class="sp-yellow">Sophisticated</span> & Compliant Delivery & <span class="sp-yellow">Order Fufillment</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-1-5">
                        <div class="icon-box">
                            <div class="icon-img">
                                <img src="{{ asset('assets/img/business-pages-imgs/icon-3.png') }}" alt="Icon 3">
                            </div>
                            <div class="icon-text">
                                <h3>Ensure your traffic Yields <span class="sp-green">Target Sales</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-1-5">
                        <div class="icon-box">
                            <div class="icon-img person-img">
                                <img src="{{ asset('assets/img/business-pages-imgs/icon-4.png') }}" alt="Icon 4">
                            </div>
                            <div class="icon-text">
                                <h3><span class="sp-yellow">Advertise</span> & <span class="sp-yellow">Market</span> Your Business and Your Offerings.</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 mb-1-5">
                        <div class="icon-box">
                            <div class="icon-img leaf-img">
                                <img src="{{ asset('assets/img/business-pages-imgs/icon-5.png') }}" alt="Icon 5">
                            </div>
                            <div class="icon-text">
                                <h3><span class="sp-green">Understand</span> & <span class="sp-green">Maintain</span> Compliance Across Onsite Operations</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 mb-1-5">
                        <div class="icon-box">
                            <div class="icon-img tab-img">
                                <img src="{{ asset('assets/img/business-pages-imgs/icon-6.png') }}" alt="Icon 6">
                            </div>
                            <div class="icon-text">
                                <h3>Maintain a Steady Stock of the Most Loved <span class="sp-yellow">Top-Selling Products</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 mb-1-5">
                        <div class="icon-box">
                            <div class="icon-img">
                                <img src="{{ asset('assets/img/business-pages-imgs/icon-7.png') }}" alt="Icon 7">
                            </div>
                            <div class="icon-text">
                                <h3><span class="sp-green">Easily Interpret Data</span> Corresponding to your Traffic</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Icons Ends --}}

    {{-- ADS --}}
    <div class="ads">
        <div class="container">
            <div class="ads-head">
                <h3>POWERING THROUGH TODAY'S EVER-EVOLVING CANNABIS CLIMATE</h3>
            </div>
            <div class="ads-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3 mb-1-5">
                        <a href="{{ route('business2') }}" style="display: block">
                           <img src="{{ asset('assets/img/business-pages-imgs/420FINDER PAGES.png') }}" alt="420 finder Pages">
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-1-5">
                        <a href="{{ route('business3') }}">
                           <img src="{{ asset('assets/img/business-pages-imgs/420FINDER ADS.png') }}" alt="420 finder Ads">
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-1-5">
                        <a href="{{ route('business4') }}">
                           <img src="{{ asset('assets/img/business-pages-imgs/deals.png') }}" alt="420 finder deals">
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-1-5">
                        <a href="{{ route('business5') }}">
                            <img src="{{ asset('assets/img/business-pages-imgs/420FINDER ORDERS.png') }}" alt="420 finder Orders">
                        </a>
                    </div>

                </div>
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

    {{-- SOLUTIONS BRANDS --}}
    <div class="solutions-brands">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 solutions-brands-col mb-1-5">
                    <div class="solutions-brands-content">
                        <h3>
                            <strong>
                                SOLUTIONS
                            </strong>
                            for
                            <strong>
                                BRANDS
                            </strong>
                        </h3>
                        <p>Engage with active cannabi, consumers to build brand awareness, trust, and loyalty, making it simple to discover your products through your growing network of authorized retailers.</p>
                        <a href="{{ route('addabusiness') }}">
                            LEARN MORE
                        </a>
                        <div class="icons-bg">
                            <img src="{{ asset('assets/img/business-pages-imgs/WATERMARK ICON 1.png') }}" alt="Watermark Image">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('assets/img/business-pages-imgs/ORANGE PHOTO.png') }}" alt="Solutions Brands">
                </div>
            </div>
        </div>
    </div>
    {{-- SOLUTIONS BRANDS ENDS --}}

     {{-- SOLUTIONS RETAILERS --}}
     <div class="solutions-retailers">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 mb-1-5">
                    <img src="{{ asset('assets/img/business-pages-imgs/GREEN PHOTO.png') }}" alt="Solutions Retailers">
                </div>
                <div class="col-12 col-md-6 mb-1-5 solutions-retailers-col">
                    <div class="solutions-retailers-content">
                        <h3>
                            <strong>
                                SOLUTIONS
                            </strong>
                            for
                            <strong>
                                RETAILERS
                            </strong>
                        </h3>
                        <p>Power your business using the 420 Finder Business software suite. Get in front of cannabis consumes as they research products and dispensaries, help them discover your products and deals, and manage your online ordering and fufillment process -- all using integrated solutions designed to help your business thrive.</p>
                        <a href="{{ route('addabusiness') }}">
                            LEARN MORE
                        </a>
                        <div class="icons-bg">
                            <img src="{{ asset('assets/img/business-pages-imgs/WATERMARK ICON 1.png') }}" alt="Watermark Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- SOLUTIONS RETAILERS ENDS --}}

@endsection

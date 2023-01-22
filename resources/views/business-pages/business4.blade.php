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
                        <strong><em>Standout by showcasing your offered savings.</em></strong>
                    </p>
                    <p>
                        <strong>420 Finder Business</strong> helps attract new customers by promoting new deals or sales on their preferred products.
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
    <div class="phones circle-icons">
        <div class="phones-bg">
            <img src="{{ asset('assets/img/business-pages-imgs/GREY BAR.png') }}" alt="">
        </div>
        <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 icon-wrap mb-1-5">
                <div class="icon-img">
                    <img src="{{ asset('assets/img/business-pages-imgs/user-icon.png') }}" alt="User Icon">
                </div>
                <div class="icon-content">
                    <h3>Advertise the best deals</h3>
                    <p>Everyone loves to save. Show off your deals and get more sales.</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 icon-wrap mb-1-5">
                <div class="icon-img">
                <img src="{{ asset('assets/img/business-pages-imgs/user-circle-icon.png') }}" alt="User Circle Icon">
                </div>
                <div class="icon-content">
                    <h3>Multiple Deals</h3>
                    <p>Add as many deals as you want.</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 icon-wrap mb-1-5">
                <div class="icon-img">
                <img src="{{ asset('assets/img/business-pages-imgs/pie-icon.png') }}" alt="Pie Icon">
                </div>
                <div class="icon-content">
                    <h3>Interact with more customers.</h3>
                    <p>Communicate directly with your consumers.</p>
                </div>
            </div>
        </div>
        </div>
    </div>
    {{-- Icons ENDS --}}

    {{-- SOLUTIONS RETAILERS --}}
    <div class="solutions-retailers pages-retailers get-discovered create">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 mb-1-5 solutions-retailers-col">
                    <div class="solutions-retailers-content">
                        <h3>
                            <strong>
                                CREATE
                            </strong>
                        </h3>
                        <p>
                           Creation Tool - Quickly create deals with easy interface
                        </p>
                        <p>
                            Preview Mode - See exactly what your deal will look like
                        </p>
                        <a href="{{ route('addabusiness') }}">
                            LEARN MORE
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('assets/img/business-pages-imgs/ORANGE PHOTO.png') }}" alt="Solutions Retailers">
                </div>
            </div>
        </div>
    </div>
    {{-- SOLUTIONS RETAILERS ENDS --}}

    {{-- SOLUTIONS BRANDS --}}
    <div class="solutions-brands pages-brands get-setup manage">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6 mb-1-5">
                        <img src="{{ asset('assets/img/business-pages-imgs/GREEN PHOTO.png') }}" alt="Solutions Brands">
                    </div>

                    <div class="col-12 col-md-6 solutions-brands-col">
                        <div class="solutions-brands-content">
                            <h3>
                                <strong>
                                    MANAGE
                                </strong>
                            </h3>
                            <p>SEARCH - Find the deals you want to edit or schedule</p>
                            <p>FILTERS - Manage approved, pending, or denied deals</p>
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

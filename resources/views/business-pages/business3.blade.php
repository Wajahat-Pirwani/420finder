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
                        <strong><em>Reach more active cannabis users</em></strong>
                    </p>
                    <p>
                        Make sure your're seen by active cannabis users while they're researching brands and products like yours.
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
                    <h3>Grow your brand</h3>
                    <p>Define and extend your brands' culture and gain awareness.</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 icon-wrap mb-1-5">
                <div class="icon-img">
                <img src="{{ asset('assets/img/business-pages-imgs/user-circle-icon.png') }}" alt="User Circle Icon">
                </div>
                <div class="icon-content">
                    <h3>Reach New Consumers</h3>
                    <p>Drive new customers in your area to visit your business page.</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 icon-wrap mb-1-5">
                <div class="icon-img">
                <img src="{{ asset('assets/img/business-pages-imgs/pie-icon.png') }}" alt="Pie Icon">
                </div>
                <div class="icon-content">
                    <h3>Be more cost effective</h3>
                    <p>Best ad rates, period.</p>
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
                <div class="col-12 col-md-6 mb-1-5 solutions-retailers-col">
                    <div class="solutions-retailers-content">
                        <h3>
                            <strong>
                                GET DISCOVERED
                            </strong>
                        </h3>
                        <p>
                            420 Finder ads is how you get discovered by people looking for cannabis and place your dispensary, delivery, or brand in the spotlight. It's how you are seen in the most visible locations across our site, including the home page.
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
                                    GET SETUP IN 3 SIMPLE STEPS
                                </strong>
                            </h3>
                            <p>1. Add funds to your campaign</p>
                            <p>2. Create a campaign</p>
                            <p>3. Set your CPC bid</p>
                            <p>With CPC bidding, you have the power to choose how much you want to spend and how long you want to be in the top placement.</p>
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

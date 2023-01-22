@extends('layouts.app')

@section('title', '420 Finder Business')

@section('content')
    <style>
        .custom-shape-divider-bottom-1636264041 {
            /*position: absolute;*/
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .custom-shape-divider-bottom-1636264041 svg {
            position: relative;
            display: none;
            width: calc(100% + 1.3px);
            height: 150px;
        }

        .custom-shape-divider-bottom-1636264041 .shape-fill {
            fill: #FFFFFF;
        }
        @media(max-width: 980px) {
            .forMobile a {
                padding: 10px 20px !important;
                margin-bottom: 50px;
            }
            .bpforMobile {
                padding: 0 !important;
            }
            .setMobileSpacing {
                padding-top: 0 !important;
            }
            .setMobileMargin {
                margin: 0 !important;
            }
        }
    </style>
    <section class="mt-5 pt-5" style="background-image: url({{ asset('images/business/bg.png')}}),linear-gradient(161deg,#004443 0%,#00afa7 100%)!important;padding-bottom: 0px;">

        <div class="container mt-4 pt-5">

            <div class="row py-5">

                <div class="col-md-6">
                    <h1 class="text-white pt-5">The All-IN-ONE solution for Starting, Growing, and Managing your Cannabis Business</h1>
                    <p class="text-white">
                        420FINDER Business is an integrated system that focuses on marketing, operations, and commerce while delivering an exciting and visually pleasing experience for  Cannabis Users.
                    </p>
                    <div class="forMobile">
                        <a href="{{ route('addabusiness') }}" class="btn bg-white br-30 py-3 px-5 me-4">Get Started</a>
                        <a href="{{ route('termsofuse') }}" class="btn bg-white br-30 py-3 px-5">Contact Us</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/businessright.png') }}" alt="" class="w-100 br-30">
                </div>

            </div>

        </div>
        <div class="custom-shape-divider-bottom-1636264041">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <section class="py-5">
        <div class="container">

            <div class="row pt-4 pb-5">
                <div class="col-md-12">
                    <h2 class="text-center"><strong>Powering your cannabis business</strong></h2>
                </div>
            </div>

            <div class="row mt-5">

                <div class="col-md-3 mb-5">
                    <div class="text-center">
                        <div>
                            <img src="{{ asset('images/business/1.png') }}" class="w-25">
                        </div>
                        <div>
                            <p class="pt-4"><strong>Acquire and re-engage users</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-5">
                    <div class="text-center">
                        <div>
                            <img src="{{ asset('images/business/2.png') }}" class="w-25">
                        </div>
                        <div>
                            <p class="pt-4"><strong>Promote your business and offerings</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-5">
                    <div class="text-center">
                        <div>
                            <img src="{{ asset('images/business/3.png') }}" class="w-25">
                        </div>
                        <div>
                            <p class="pt-4"><strong>Convert traffic into orders</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-5">
                    <div class="text-center">
                        <div>
                            <img src="{{ asset('images/business/4.png') }}" class="w-25">
                        </div>
                        <div>
                            <p class="pt-4"><strong>Compliant delivery and fulfillment</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-5">
                    <div class="text-center">
                        <div>
                            <img src="{{ asset('images/business/5.png') }}" class="w-25">
                        </div>
                        <div>
                            <p class="pt-4"><strong>Enable off-platform online store menu embed</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-5">
                    <div class="text-center">
                        <div>
                            <img src="{{ asset('images/business/6.png') }}" class="w-25">
                        </div>
                        <div>
                            <p class="pt-4"><strong>Run compliant onsite operations</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-5">
                    <div class="text-center">
                        <div>
                            <img src="{{ asset('images/business/7.png') }}" class="w-25">
                        </div>
                        <div>
                            <p class="pt-4"><strong>Restock with top-selling products</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-5">
                    <div class="text-center">
                        <div>
                            <img src="{{ asset('images/business/8.png') }}" class="w-25">
                        </div>
                        <div>
                            <p class="pt-4"><strong>Analyze user traffic data</strong></p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">

            <div class="row pt-4 pb-5 bpforMobile">
                <div class="col-md-12">
                    <h2 class="text-center"><strong>Explore the Business ecosystem</strong></h2>
                </div>
            </div>

            <div class="row mt-5">

                <a href="{{ route('businesspages') }}" class="col-md-3 mb-5 bg-white">
                    <div class="text-center shadow p-4" style="border-radius: 15px;">
                        <div>
                            <h3><strong><span style="color: #f8971d;">420 Finder</span> Pages</strong></h3>
                        </div>
                        <div>
                            <p class="pt-4">Your listing for active consumers</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('businessads') }}" class="col-md-3 mb-5 bg-white">
                    <div class="text-center shadow p-4" style="border-radius: 15px;">
                        <div>
                            <h3><strong><span style="color: #f8971d;">420 Finder</span> Ads</strong></h3>
                        </div>
                        <div>
                            <p class="pt-4">More visibility for your business</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('businessdeals') }}" class="col-md-3 mb-5 bg-white">
                    <div class="text-center shadow p-4" style="border-radius: 15px;">
                        <div>
                            <h3><strong><span style="color: #f8971d;">420 Finder</span> Deals</strong></h3>
                        </div>
                        <div>
                            <p class="pt-4">Showcase your offers and deals</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('businessorders') }}" class="col-md-3 mb-5 bg-white">
                    <div class="text-center shadow p-4" style="border-radius: 15px;">
                        <div>
                            <h3><strong><span style="color: #f8971d;">420 Finder</span> Orders</strong></h3>
                        </div>
                        <div>
                            <p class="pt-4">Turn traffic into orders</p>
                        </div>
                    </div>
                </a>

            </div>

        </div>
    </section>

    <section class="py-5 setMobileSpacing">
        <div class="container">

            <div class="row mt-5 setMobileMargin">

                <div class="col-md-6 mb-5 bg-white py-5 setMobileSpacing">
                    <h1 class="pt-5"><strong>Solutions for brands</strong></h1>
                    <p>
                        Engage with active cannabis consumers to build brand awareness, trust, and loyalty, making it simple to discover your products through your growing network of authorized retailers.
                    </p>
                    <a href="{{ route('brands') }}" target="_blank" class="appointment-btn ms-0 py-3 px-5">Learn More</a>
                </div>

                <div class="col-md-6 mb-5 bg-white">
                    <img src="{{ asset('images/business/brands.jpg') }}" class="shadow w-100" style="border-radius: 15px;">
                </div>

            </div>

        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">

            <div class="row mt-5">

                <div class="col-md-6 mb-5">
                    <img src="{{ asset('images/business/retailers.jpg') }}" class="shadow w-100" style="border-radius: 15px;">
                </div>

                <div class="col-md-6 mb-5 py-5 ps-5 setMobileSpacing">
                    <h1 class="pt-5 setMobileSpacing"><strong>Solutions for retailers</strong></h1>
                    <p>
                        Power your business using the WM Business software suite. Get in front of cannabis consumers as they research products and dispensaries, help them discover your products and deals, and manage your online ordering and fulfillment process – all using integrated solutions designed to help your business thrive.
                    </p>
                    <a href="{{ route('addabusiness') }}" target="_blank" class="appointment-btn ms-0 py-3 px-5">Learn More</a>
                </div>

            </div>

        </div>
    </section>

@endsection

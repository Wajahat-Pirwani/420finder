@extends('layouts.app')

    @section('title', '420 Finder')
    
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
            display: block;
            width: calc(100% + 1.3px);
            height: 150px;
        }

        .custom-shape-divider-bottom-1636264041 .shape-fill {
            fill: #FFFFFF;
        }
        @media(max-width: 980px) {
            .margintopmobile {
                margin-top: 50px !important;
            }
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
                    <h1 class="text-white">420FINDER Business Listing for active cannabis community</h1>
                    <p class="text-white">
                        Your listing gets you right in front of ready to spend cannabis users, providing them with all the details needed so they can make a confident purchase locally.
                    </p>
                    <div class="forMobile">
                        <a href="{{ route('addabusiness') }}" class="btn bg-white br-30 py-3 px-5 me-4">Get Started</a>
                        <a href="{{ route('termsofuse') }}" class="btn bg-white br-30 py-3 px-5">Contact Us</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/businessright.PNG') }}" alt="" class="w-100 br-30">
                </div>

            </div>
            
        </div>
        <div class="custom-shape-divider-bottom-1636264041">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <section class="py-5 setMobileSpacing">
        <div class="container">
            
            <div class="row mt-5 setMobileMargin">
                
                <div class="col-md-6 mb-5 bg-white py-5 setMobileSpacing mb-3 margintopmobile">
                    <h1><strong>Your customers are looking for you now on 420 Finder.</strong></h1>
                </div>

                <div class="col-md-6 mb-5 bg-white">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ asset('images/businesspages1.png') }}" class="w-25">
                            <h4 class="pt-3"><strong>Millions</strong></h4>
                            <p>of active cannabis consumers each month</p>
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('images/businesspages2.png') }}" class="w-25">
                            <h4 class="pt-3"><strong>Billions</strong></h4>
                            <p>of pageviews each year</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section class="py-5" style="background: #252935;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pt-5">
                    <h1 class="text-white pt-5">More than a map marker</h1>
                    <p class="text-white">
                        Listing your business on 420FINDER will allow you to be discovered by active cannabis users. Customers can check out new brands and products, find local retailers, and utilize our review system to make their best choice. Your listing gives you the chance to appeal to and engage.
                    </p>
                    <a href="{{ route('addabusiness') }}" class="appointment-btn ms-0 py-3 px-5">Get Started</a>
                </div>
                <div class="col-md-6 text-center margintopmobile">
                    <img src="{{ asset('images/businesspagesright.png') }}" class="w-50">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/businesspagesleft.png') }}" class="w-50 mb-5">
                </div>
                <div class="col-md-6">
                    <h1>Pages for brands</h1>
                    <p>
                        Tell your brand story and make it easy for people to discover your products:
                    </p>
                    <ul>
                        <li>Showcase your full product catalog</li>
                        <li>Verify authorized retailers to display on your product locators </li>
                        <li>Manage customer reviews to build reputation and trust </li>
                        <li>Attract followers to your brand</li>
                    </ul>
                    <a href="{{ route('brands') }}" class="appointment-btn ms-0 py-3 px-5">Get Started</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-image: url(https://weedmaps.com/business/wp-content/uploads/2020/09/readytostartwithwm.jpg);">
        <div class="container py-5">
            <div class="row py-5">
                <div class="col-md-12 text-center">
                    <h1 class="text-white">
                        <strong>Ready to get started <br> with 420 Finder?</strong>
                    </h1>
                    <a href="{{ route('addabusiness') }}" class="btn btn-light py-3 px-4 br-30 shadow mt-3">Get Started</a>
                </div>
            </div>
        </div>
    </section>

@endsection
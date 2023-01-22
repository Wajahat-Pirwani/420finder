<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YRHK7EQE8W"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YRHK7EQE8W');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-199844755-50"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-199844755-50');
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PT53V6H');</script>
<!-- End Google Tag Manager -->

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    {{--    <title>{{ title() }}</title>--}}
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- SEO Tags -->
    <meta name="google-site-verification" content="jXVgUmsfHdwFvl_2OuqH4g5lVIg5b1cYtgETnQ397es"/>
    <meta name="msvalidate.01" content="D03D74C40363FF6F1FB6CD382332D360"/>
    <meta name="robots" content="index, follow"/>
    <meta name="googlebot" content="index, follow, max-snippet:-1" />
    <meta name=" bingbot
    " content="index, follow, max-snippet:-1" />
    <link rel="canonical" href="<?php echo (Request::url()); ?>"/>

    <!-- OG Tag -->
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="420 Finder Marijuana Deals, Dispensaries, Deliveries Near You"/>
    <meta property="og:description" content="Local 420 Deals & Businesses"/>
    <meta property="og:url" content="<?php echo (Request::url()); ?>"/>
    <meta property="og:image" content="https://420finder.net/assets/img/logo.png"/>
    <meta property="og:image:width" content="880"/>
    <meta property="og:image:height" content="660"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="420FINER"/>
    <!-- LANGUAGE TAG -->
    <link rel="alternate" href="https://420finder.net/" hreflang="en-us"/>
    <link rel="alternate" href="https://420finder.net/" hreflang="en-uk"/>
    <link rel="alternate" href="https://420finder.net/" hreflang="en-gb"/>
    <!-- TWITTER CARD TAG -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo (Request::url()); ?>">
    <meta name="twitter:creator" content="@420_finder">
    <meta name="twitter:title" content="Local 420 Deals & Businesses">
    <meta name="twitter:description"
          content="Find weed deals & discounts near you from your favorite local marijuana dispensaries.">
    <meta name="twitter:image" content="https://420finder.net/assets/img/logo.png">
    <meta name="google-site-verification" content="0kS28wxW9GIDXONYjr58XDs2P05DFXcQ5yIgSYGUZgk" />
    <!-- End -->
    {{-- DESKTOP MAPBOX --}}
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" rel="stylesheet"/>

    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/star-rating/star-rating-svg.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/mystyles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/business.css') }}">
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <style>
        .btn-enter {
            background-color: green;
            color: #fff;
            font-size: 26px;
        }

        .btn-enter:hover {
            background-color: #0a5c0a;
            color: #FFF
        }

        .btn-exit {
            background-color: red;
            color: #fff;
            font-size: 26px;
        }

        .btn-exit:hover {
            background-color: #cf0808;
            color: #FFF
        }

        .labelRadio {
            padding-left: 20px;
        }

        .personalLabel {
            background-color: lightgray;
            border-radius: 20px;
            width: 30%;
            margin: 10px;
            text-align: left
        }

        .model-background {
            background-image: url('{{asset('images/420finder_age_gateway_backgroundonly.jpg')}}');
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .modal-flable {
            font-size: 13px;
            color: #858484;
        }

        .modal-p {
            font-style: italic;
            /*font-weight: 600;*/
            color: #f7941d;
        }

        .modal-bb {
            background: #f7941d;
            border: 1px solid #f7941d;
            color: #FFF;
        }

        .modal-bb:focus {
            box-shadow: 0 0 0 0.25rem #f8971c4a;
        }

        .modal-bb:hover {
            background: #d57706;
            border: 1px solid #f7941d;
            color: #FFF;
        }

        .nav-tabs .nav-link {
            padding: 13px !important;
            font-size: 20px !important;
        }

        .review-wrapper {
            margin: 46px auto;
            max-width: 100% !important;
        }

        .checked {
            color: orange;
        }

        .swiper-pagination-bullets {
            display: none;
        }

        @font-face {
            font-family: "96 Sans", Arial, sans-serif !important;
            src: url('{{ asset('fonts/open-sans.light.ttf') }}');
        }

        /*body {*/
        /*    font-family:  "96 Sans",Arial,sans-serif !important;*/
        /*}*/
        /*h1, h2, h3, h4, h5, h6 , p, a, input, li, div, button, span{*/
        /*    font-family: "96 Sans",Arial,sans-serif !important;*/
        /*}*/
        .destopnone {
            display: none;
        }

        @media only screen and (max-width: 600px) {
            .model-background {
                background-image: url('{{asset('images/420finder_age_gateway_mobile_backgroundonly.jpg')}}');
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }

            .mdn {
                display: none;
            }

            .destopnone {
                display: block;
            }

            .personalLabel {
                width: 90%;
            }

            .nav-tabs .nav-link {
                padding: 10px !important;
                font-size: 15px !important;
            }
        }

        @media (max-width: 980px) {
            img.card-img-top {
                width: 100% !important;
                height: 150px !important;
            }

            .post-slide {
                margin: 0px 3px 0px !important;
            }

            .retailerOrderBtn {
                font-size: 8px !important;
            }

            .retailerTitle {
                font-size: 16px !important;
            }

            .post-slide {
                border: none !important;
            }

            .post-slide .post-content {
                padding: 0 !important;
            }

            .nav-link {
                padding: 0.5rem 1rem !important;
            }
        }

        /* DEAL SINGLE CONTENT */
        .liveMenu {
            border: 1px solid green;
            color: green;
            padding: 2px 6px;
            border-radius: 5px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .liveMenu:before {
            content: "•";
            width: 0.375rem;
            height: 0.375rem;
            font-size: 14px;
            border-radius: 50%;
            margin-right: 0.25rem;
        }

        i.fa.fa-star {
            color: #f8971c;
        }

        .showOnMobileRetailerSidebar {
            display: none;
        }

        @media (max-width: 980px) {
            .showOnMobileRetailerSidebar button {
                font-size: 12px;
            }

            .showOnMobileRetailerSidebar {
                display: block;
                margin-top: 15px;
            }

            .hideRetailerDetailSidebar {
                display: none;
            }

            i.fa.fa-star {
                font-size: 24px;
            }

            span.reviewCount {
                font-size: 14px;
            }

            .topDeliveryRow .col-4 img {
                width: 100% !important;
            }

            .topDeliveryRow .col-4 {
                text-align: left !important;
            }

            .topDeliveryRow .col-8 h3 {
                text-align: left;
                font-size: 24px;
            }

            .topDeliveryRow .col-8 p {
                text-align: left;
            }

            .detailedBox {
                padding: 10px 20px;
            }

            .retailerbnametext {
                font-size: 18px;
            }

            span.followers {
                display: none;
            }

            .favBrand.favoriteButton {
                position: absolute;
                top: 29%;
                right: 6%;
            }

            .ctaButtonFirst, .ctaButtonSecond {
                width: 50%;
                border: 1px solid silver;
            }
        }

        /* INDEX PAGE CONTENT */
        .forMobilePadding .forDesktop img {
            height: 356px;
        }

        .carousel-item img {
            height: 356px;
        }

        .retailerOrderBtn {
            background: transparent;
            border: 1px solid silver;
            border-radius: 30px;
            padding: 6px 15px;
            font-size: 12px;
            color: #606060;
        }

        .retailerOrderBtn:hover {
            color: unset;
        }

        .markerImageIcon {
            position: absolute;
            bottom: 0;
            right: 3%;
            width: 39px !important;
            height: 35px !important;
        }

        .forRating i.fa.fa-star {
            color: #F8971C !important;
            font-size: 18px;
            margin-top: 8px;
        }

        .forMobilePadding {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }

        .forMobile {
            display: none;
        }

        .forDesktop {
            display: block;
        }

        @media (max-width: 980px) {
            img.card-img-top {
                height: 100% !important;
            }

            ul.list-unstyled.d-flex.ratings {
                font-size: 12px;
            }

            .ratings i.far.fa-star {
                font-size: 14px;
                margin-top: 10px;
            }

            .mobileCarasoulTop {
                margin-top: 0 !important;
            }

            .owl-buttons {
                display: none;
            }

            .bg-light.defaultImage {
                height: 150px !important;
            }

            .carousel-item img {
                height: unset;
            }

            .forDesktop {
                display: none;
            }

            .forMobile {
                display: block;
            }

            /*.mainbanner {
                height: 95px;
            }*/
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

        /*.post-slide:hover .post-img img{
            transform: scale(1.1,1.1);
        }*/
        .post-slide .over-layer {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            /*opacity:0;*/
            /*background: linear-gradient(-45deg, rgba(6,190,244,0.75) 0%, rgba(45,112,253,0.6) 100%);
            transition:all 0.50s linear;*/
        }

        .post-slide:hover .over-layer {
            opacity: 1;
            text-decoration: none;
        }

        .post-slide .over-layer i {
            top: 3%;
            text-align: center;
            display: block;
            font-size: 19px;
            background: white;
            color: #adaeb0;
            border-radius: 50%;
            border: 1px solid #adaeb0;
            width: 32px;
            height: 32px;
            padding-top: 6px;
            float: right;
            margin-right: 10px;
            margin-top: 10px;
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
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            position: absolute;
            top: 34%;
            left: 6px;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            transition: background 0.5s ease 0s;
            filter: drop-shadow(rgba(0, 0, 0, 0.14) 0px 0.125rem 0.25rem) drop-shadow(rgba(0, 0, 0, 0.12) 0px 0.25rem 0.3125rem) drop-shadow(rgba(0, 0, 0, 0.2) 0px 0.0625rem 0.625rem);
        }

        .owl-controls .owl-buttons .owl-next {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            position: absolute;
            top: 34%;
            right: 6px;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            filter: drop-shadow(rgba(0, 0, 0, 0.14) 0px 0.125rem 0.25rem) drop-shadow(rgba(0, 0, 0, 0.12) 0px 0.25rem 0.3125rem) drop-shadow(rgba(0, 0, 0, 0.2) 0px 0.0625rem 0.625rem);
            transition: background 0.5s ease 0s;
        }

        /* .owl-controls .owl-buttons .owl-prev:after,
        .owl-controls .owl-buttons .owl-next:after{
            content: "";
            font-family: FontAwesome;
            color: #333;
            font-size: 23px;
        }
        .owl-controls .owl-buttons .owl-next:after{
            content:"";
        } */

        .owl-controls .owl-buttons .owl-prev i,
        .owl-controls .owl-buttons .owl-next i {
            color: #000;
            font-weight: bold;
        }

        @media only screen and (max-width: 1280px) {
            .post-slide .post-content {
                padding: 0px 15px 25px 15px;
            }
        }

        /* Navigation Content */
        .hambergerSubMenuItems {
            display: none;
        }

        input.form-control.border-0.mobileNavSearchBox:focus {
            border: none !important;
            box-shadow: none !important;
        }

        @media (max-width: 980px) {
            .hambergerSubMenuItems {
                display: block;
            }

            .subMenuRow {
                display: none !important;
            }

            nav#navbar {
                margin-right: 4% !important;
            }

        }

        .panel-title {
            display: inline;
            font-weight: bold;
        }

        .display-table {
            display: table;
        }

        .display-tr {
            display: table-row;
        }

        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }

        .footer-bg {
            background-image: url('{{asset("Vector Smart Object.png")}}');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            text-align: center;
            padding-bottom: 50px !important;
            padding-top: 85px;
            position: relative;
            top: -80px;
        }

        .footer-h {
            font-family: inherit !important;
            font-weight: bold !important;
            color: #FFF !important;
            margin-left: 46px !important;
            margin-bottom: 0px !important;
        }

        .footer-link {
            font-size: 14px;
            font-weight: bold;
            text-align: right;
            margin-right: 50px;
        }

        @media only screen and (max-width: 320px) {
            .footer-bg {
                top: 0px;
            }
        }

        @media only screen and (min-width: 321px) and (max-width: 768px) {
            .footer-bg {
                top: 0px;
            }
        }

        @media only screen and (min-width: 769px) {

        }

        .c-tabs {
            font-size: 0.8rem !important;
            padding: 5px 12px !important
        }
    </style>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YRHK7EQE8W"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-YRHK7EQE8W');
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-199844755-50"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-199844755-50');
    </script>

    <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "420 FINDER",
            "alternateName": "Marijuana Deals, Dispensaries, & Deliveries Near You",
            "url": "https://420finder.net/",
            "logo": "https://420finder.net/assets/img/logo.png",
            "sameAs": [
                "https://420finder.net/",
                "https://twitter.com/420_finder"
            ]
            }


    </script>
    <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "WholesaleStore",
            "name": "420 FINDER",
            "image": "https://420finder.net/assets/img/logo.png",
            "@id": "",
            "url": "https://420finder.net/",
            "telephone": "0000000000",
            "priceRange": "$",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Oklahoma City",
                "addressLocality": "Oklahoma City",
                "addressRegion": "OK",
                "postalCode": "73112",
                "addressCountry": "US"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": 35.5135639,
                "longitude": -97.5788975
            } ,
            "sameAs": [
                "https://twitter.com/420_finder",
                "https://420finder.net/"
            ]
            }


    </script>
    <script type="application/ld+json">
            {
            "@context": "https://schema.org/",
            "@type": "WebSite",
            "name": "420 FINDER",
            "url": "https://420finder.net/",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{search_term_string}",
                "query-input": "required name=search_term_string"
            }
            }


    </script>
    <meta name="google-site-verification" content="jXVgUmsfHdwFvl_2OuqH4g5lVIg5b1cYtgETnQ397es" />
    <meta name="msvalidate.01" content="D03D74C40363FF6F1FB6CD382332D360" />

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PT53V6H"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- End Google Tag Manager (noscript) -->
@yield('styles')

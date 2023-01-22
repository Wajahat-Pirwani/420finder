<?php
function distance($lat1, $lon1, $lat2, $lon2, $unit)
{
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);
    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}
?>
@extends('layouts.app')
@section('styles')
    <style>
        @media only screen and (max-width: 600px) {
            .brandSingleTopBanner {
                background-image: url('{{ $brand->mobile_cover??$brand->profile_picture }}') !important;
                background-size: 100% 100% !important;
                background-position: center center;
                margin-top: 30px;
            }
        }
    </style>
@endsection
@section('title', $brand->business_name)
@section('content')
    <section style="margin-top: 27px; padding: 0px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center brandSingleTopBanner"
                     style="background-image: linear-gradient(0deg , rgba(0,0,0,0) 0%, rgba(0, 0, 0, 0) 100%), url('{{ $brand->cover }}');background-size: cover;background-position: center center;height: 400px;">
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container text-start" style="padding-top: 20px; padding-left: 0px">
                            <h1 class="brandSingleTitle">{{ $brand->business_name }}</h1>
                            <div class="favBrand">
                                @if (Session::has('customer_id') == false)
                                    <a href="{{ route('signin') }}"><i class="far fa-heart pe-4"></i></a>
                                @else
                                    <?php
                                    $fav = \App\Models\Favorite::where('customer_id', session('customer_id'))->where('type_id', $brand->id)->first();
                                    ?>
                                    @if($fav)
                                        <a rel="{{ $brand->id }}" data="Brand" id="deletefavourite"
                                           class="unfavdelivery fav-style cursor-pointer">
                                            <i class="fa fa-heart pe-4 shadow ms-3"></i>
                                        </a>
                                        <a rel="{{ $brand->id }}" data="Brand" id="addfavourites"
                                           class="favdelivery cursor-pointer" style="display: none">
                                            <i class="far fa-heart pe-4 shadow ms-3"></i>
                                        </a>
                                    @else
                                        <a rel="{{ $brand->id }}" data="Brand" id="deletefavourite"
                                           class="unfavdelivery fav-style cursor-pointer" style="display: none">
                                            <i class="fa fa-heart pe-4 shadow ms-3"></i>
                                        </a>
                                        <a rel="{{ $brand->id }}" data="Brand" id="addfavourites"
                                           class="favdelivery cursor-pointer">
                                            <i class="far fa-heart pe-4 shadow ms-3"></i>
                                        </a>
                                    @endif
                                @endif
                                @auth
                                    @if($fav)
                                        <span class="followers">Favourite</span>
                                    @else
                                        <span class="followers">Add to favourite</span>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs pt-3 brandSingleTabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="discover-tab" data-bs-toggle="tab"
                                        data-bs-target="#discover" type="button" role="tab" aria-controls="discover"
                                        aria-selected="true">Discover
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="products-tab" data-bs-toggle="tab"
                                        data-bs-target="#products" type="button" role="tab" aria-controls="products"
                                        aria-selected="false">Contact Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="feeds-tab" data-bs-toggle="tab" data-bs-target="#feeds"
                                        type="button" role="tab" aria-controls="feeds" aria-selected="false">Feeds
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="retailers-tab" data-bs-toggle="tab"
                                        data-bs-target="#retailers" type="button" role="tab" aria-controls="retailers"
                                        aria-selected="false">Retailers
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="discover" role="tabpanel"
                                 aria-labelledby="discover-tab">
                                @if($featuredproducts->count() > 0)
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <h4 class="mb-3"><strong>Featured Products</strong></h4>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        @foreach($featuredproducts as $featured)
                                            <div class="col-md-3 col-6 mb-4 cursor-pointer"
                                                 onclick="location.href='{{ route('brandproductsingle', ['slug' => $featured['slug'], 'id' => encrypt($featured->id)]) }}';">
                                                <div class="card shadow-sm">
                                                    <img
                                                        onerror="this.src='https://420finder.net/assets/img/logo01.png'"
                                                        src="{{ $featured->image }}" class="card-img-top" alt="...">
                                                    <div class="card-body pt-1 border-top">
                                                        <div
                                                            style="font-size: 1rem;font-weight: 700;letter-spacing: 0.00625rem;line-height: 1.25rem;padding-top: 10px">{{ $featured->name }}
                                                        </div>
                                                        @php
                                                            $category = DB::table('categories')->where('id', $featured->category_id)->first();
                                                        @endphp
                                                        <div class="py-2"
                                                             style="font-weight: 400;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;">{{ $category->name }}</div>
                                                        <div class="py-2"
                                                             style="font-weight: 900;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;">{{ $brand->business_name }}</div>
                                                        <ul class="list-unstyled d-flex ratings">
                                                            <?php
                                                            if (count($featured['reviews']) > 0) {
                                                                $sum = 0;
                                                                foreach ($featured['reviews'] as $review) {
                                                                    $sum = $sum + $review['rating'];
                                                                }
                                                                $totalratings = $sum / count($featured['reviews']);
                                                            } else {
                                                                $totalratings = 0;
                                                            }
                                                            if ($totalratings < 1) {
                                                                echo '
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                ';
                                                            } elseif ($totalratings <= 1) {
                                                                echo '
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                ';
                                                            } elseif ($totalratings > 1 AND $totalratings <= 2) {
                                                                echo '
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                ';
                                                            } elseif ($totalratings > 2 AND $totalratings <= 3) {
                                                                echo '
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                ';
                                                            } elseif ($totalratings > 3 AND $totalratings <= 4) {
                                                                echo '
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                ';
                                                            } elseif ($totalratings > 4 AND $totalratings <= 5) {
                                                                echo '
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                ';
                                                            }
                                                            echo " <span class='reviewCount'>(" . count($featured['reviews']) . ")</span>";
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @if($products->count() > 0)
                                    @php
                                        $categories = \App\Models\Category::all();
                                    @endphp
                                    @foreach($categories as $category)
                                        @php
                                            $categoryProducts = \App\Models\BrandProduct::with('reviews')->where('brand_id', $brand->id)
        ->where('status', 1)->where('category_id', $category->id)->get();
                                        @endphp
                                        @if($categoryProducts->count() > 0)
                                            <div class="row mt-5">
                                                <div class="col-md-12">
                                                    <h4 class="mb-3"><strong>{{$category->name}}</strong></h4>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                @foreach($categoryProducts as $product)
                                                    <div class="col-md-3 col-6 mb-4 mb-4 cursor-pointer"
                                                         onclick="location.href='{{ route('brandproductsingle', ['slug' => $product['slug'], 'id' => encrypt($product->id)]) }}';">
                                                        <div class="card shadow-sm">
                                                            <img
                                                                onerror="this.src='https://420finder.net/assets/img/logo01.png'"
                                                                src="{{ $product->image }}" class="card-img-top"
                                                                alt="...">
                                                            <div class="card-body pt-1 border-top">
                                                                <div
                                                                    style="font-size: 1rem;font-weight: 700;letter-spacing: 0.00625rem;line-height: 1.25rem;padding-top: 10px">{{$product->name }}
                                                                </div>
                                                                @php
                                                                    $category = DB::table('categories')->where('id', $product->category_id)->first();
                                                                @endphp
                                                                <div class="py-2"
                                                                     style="font-weight: 400;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;">{{ $category->name }}</div>
                                                                <div class="py-2"
                                                                     style="font-weight: 900;margin: 0px;padding: 0px;font-size: 0.875rem;line-height: 1.25rem;">{{ $brand->business_name }}</div>
                                                                <ul class="list-unstyled d-flex ratings">
                                                                    <?php
                                                                    if (count($product['reviews']) > 0) {
                                                                        $sum = 0;
                                                                        foreach ($product['reviews'] as $review) {
                                                                            $sum = $sum + $review['rating'];
                                                                        }
                                                                        $totalratings = $sum / count($product['reviews']);
                                                                    } else {
                                                                        $totalratings = 0;
                                                                    }
                                                                    if ($totalratings < 1) {
                                                                        echo '
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                ';
                                                                    } elseif ($totalratings <= 1) {
                                                                        echo '
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                ';
                                                                    } elseif ($totalratings > 1 AND $totalratings <= 2) {
                                                                        echo '
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                ';
                                                                    } elseif ($totalratings > 2 AND $totalratings <= 3) {
                                                                        echo '
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                ';
                                                                    } elseif ($totalratings > 3 AND $totalratings <= 4) {
                                                                        echo '
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                                                ';
                                                                    } elseif ($totalratings > 4 AND $totalratings <= 5) {
                                                                        echo '
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                                                ';
                                                                    }
                                                                    echo " <span class='reviewCount'>(" . count($product['reviews']) . ")</span>";
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach

                                @endif
                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <h4 class="pt-4"><strong>About</strong></h4>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card px-4 py-2 shadow-sm">
                                            <?php echo $brand->description; ?>
                                            <div class="pt-2">
                                                @if($brand->introduction)
                                                    <p><strong>Description: </strong>{{ $brand->introduction }}</p>
                                                @endif
                                                @if($brand->license_type)
                                                    <p><strong>License Type: </strong>{{ $brand->license_type }}</p>
                                                @endif
                                                @if($brand->license_number)
                                                    <p><strong>License Number: </strong>{{ $brand->license_number }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
                                <div class="row mt-4">
                                    <div class="col-md-4 mb-5">
                                        <h4 class="mb-3"><strong>Contact Details</strong></h4>
                                        <div class="card shadow-sm p-4">
                                            <ul class="list-unstyled">
                                                @if($brand->business_name)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <i class="fas fa-laptop-house"></i>&nbsp;&nbsp; {{ $brand->business_name }}
                                                    </li>
                                                @endif
                                                @if($brand->business_phone_number)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <i class="fas fa-phone"></i>&nbsp;&nbsp; {{ $brand->business_phone_number }}
                                                    </li>
                                                @endif
                                                @if($brand->email)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <i class="far fa-envelope"></i>&nbsp;&nbsp; {{ $brand->email }}
                                                    </li>
                                                @endif
                                                @if($brand->business_type)
                                                    <li class="pb-3">
                                                        <i class="fas fa-sitemap"></i>&nbsp;&nbsp; {{ $brand->business_type }}
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="mb-3"><strong>Address</strong></h4>
                                        <div class="card shadow-sm p-4">
                                            <ul class="list-unstyled">
                                                @if($brand->country)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <strong>Country: </strong>&nbsp;&nbsp; {{ $brand->country}}
                                                    </li>
                                                @endif
                                                @if($brand->address_line_1)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <strong>Address line
                                                            1: </strong>&nbsp;&nbsp; {{ $brand->address_line_1 }}
                                                    </li>
                                                @endif
                                                @if($brand->address_line_2)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <strong>Address line
                                                            2: </strong>&nbsp;&nbsp; {{ $brand->address_line_2 }}
                                                    </li>
                                                @endif
                                                @if($brand->city)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <strong>City: </strong>&nbsp;&nbsp; {{ $brand->city }}
                                                    </li>
                                                @endif
                                                @if($brand->state_province)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <strong>State/Province: </strong>&nbsp;&nbsp; {{ $brand->state_province }}
                                                    </li>
                                                @endif
                                                @if($brand->postal_code)
                                                    <li class="pb-3">
                                                        <strong>Postal
                                                            code: </strong>&nbsp;&nbsp; {{ $brand->postal_code }}
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="feeds" role="tabpanel" aria-labelledby="feeds-tab">
                                <div class="row mt-4">
                                    <div class="col-md-4 mb-5">
                                        <h4 class="mb-3"><strong>Social</strong></h4>
                                        <div class="card shadow-sm p-4">
                                            <ul class="list-unstyled">
                                                @if($brand->facebook_url != NULL)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <a href="{{ $brand->facebook_url }}" target="_blank"><i
                                                                class="fab fa-facebook-f"></i>&nbsp;&nbsp; Facebook</a>
                                                    </li>
                                                @endif
                                                @if($brand->twitter_url != NULL)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <a href="{{ $brand->twitter_url }}" target="_blank"><i
                                                                class="fab fa-twitter"></i>&nbsp;&nbsp; Twitter</a>
                                                    </li>
                                                @endif
                                                @if($brand->instagram_url != NULL)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <a href="{{ $brand->instagram_url }}" target="_blank"><i
                                                                class="fab fa-instagram"></i>&nbsp;&nbsp; Instagram</a>
                                                    </li>
                                                @endif
                                                @if($brand->website_url != NULL)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <a href="{{ $brand->website_url }}" target="_blank"><i
                                                                class="fas fa-link"></i>&nbsp;&nbsp; Website</a>
                                                    </li>
                                                @endif
                                                @if($brand->yt_featured_url != NULL)
                                                    <li class="pb-3 border-bottom mb-3">
                                                        <a href="{{ $brand->yt_featured_url }}" target="_blank"><i
                                                                class="fab fa-youtube"></i>&nbsp;&nbsp; Youtube
                                                            Video</a>
                                                    </li>
                                                @endif
                                                @if($brand->yt_playlist_url != NULL)
                                                    <li class="pb-3">
                                                        <a href="{{ $brand->yt_playlist_url }}" target="_blank"><i
                                                                class="fab fa-youtube-square"></i>&nbsp;&nbsp; Youtube
                                                            Playlist</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="mb-3"><strong>Latest Posts</strong></h4>
                                        @if($feeds->count() > 0)
                                            <div class="row">
                                                @foreach($feeds as $feed)
                                                    <div class="col-md-6 mb-4">
                                                        <div class="shadow-sm" style="border: 1px solid #f3ebeb;">
                                                            <div class="row p-3">
                                                                <div class="col-md-12 d-flex">
                                                                    <img
                                                                        onerror="this.src='https://420finder.net/assets/img/logo01.png'"
                                                                        src="{{ $brand->profile_picture }}"
                                                                        alt="{{ $brand->name }}"
                                                                        style="width: 40px;height: 40px;">
                                                                    <h5 class="pt-1 ps-2"
                                                                        style="font-weight: 600;font-size: 1.25rem;line-height: 1.5rem;">{{ $brand->name }}</h5>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <img
                                                                    onerror="this.src='https://420finder.net/assets/img/logo01.png'"
                                                                    src="{{ $feed->image }}" alt="" class="w-100">
                                                            </div>
                                                            <div class="p-3 pb-0">
                                                                {{ $feed->description }}
                                                            </div>
                                                            <div class="row p-3">
                                                                <div class="col-md-6 border-top pt-3">
                                                                    <button class="bg-transparent border-0"><i
                                                                            class="far fa-heart"></i> Like
                                                                    </button>
                                                                </div>
                                                                <div class="col-md-6 text-end border-top pt-3">
                                                                    {{ $feed->created_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="row pt-5 mt-5">
                                                <div class="border col-md-8 offset-md-2 p-5 shadow-sm text-center">
                                                    <h5><strong>No posts yet</strong></h5>
                                                    <p>High Tide Organics currently doesn't have any posts. Please check
                                                        back later!</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="retailers" role="tabpanel" aria-labelledby="retailers-tab">
                                <div class="row mt-4">
                                    @if(count($retailers) > 0)
                                        @foreach($retailers as $retailer)
                                            <div class="col-6 col-md-4 col-lg-3" style="margin-bottom: 30px">
                                                <div class="post-slide" style="margin: 0">
                                                    <div class="post-img">
                                                        @if($retailer->profile_picture == 'https://images.weedmaps.com/original/image_missing.jpg')
                                                            <div style="width: auto; height: 238px;"
                                                                 class="bg-light defaultImage">
                                                                <img src="https://420finder.net/assets/img/logo.png"
                                                                     class="card-img-top" alt="..."
                                                                     style="opacity: 0.3; width:100%; padding-top: 60px;padding-left: 20px;padding-right: 20px;">
                                                            </div>
                                                        @elseif($retailer->profile_picture == '')
                                                            <div style="width: auto; height: 238px;"
                                                                 class="bg-light defaultImage">
                                                                <img src="{{ asset('assets/img/logo.png') }}"
                                                                     class="card-img-top" alt="..."
                                                                     style="opacity: 0.3;width:100%;padding-top: 60px;padding-left: 20px;padding-right: 20px;">
                                                            </div>
                                                        @else
                                                            <img
                                                                onerror="this.src='https://420finder.net/assets/img/logo01.png'"
                                                                src="{{ $retailer->profile_picture }}"
                                                                class="card-img-top"
                                                                style="width: 100%; height: 238px;">
                                                        @endif
                                                        @if($retailer->business_type == 'Dispensary')
                                                            <a href="{{ route('dispensarysingle', ['slug' => $retailer->slug??"retailer", 'id' => $retailer->id]) }}"
                                                               class="over-layer">
                                                                <i class="far fa-heart heartIcon"></i>
                                                                <img
                                                                    src="{{ asset('images/icons/icondispensary.png') }}"
                                                                    class="markerImageIcon">
                                                            </a>
                                                        @elseif($retailer->business_type == 'Delivery')
                                                            <a href="{{ route('deliverysingle', ['slug' => $retailer->slug??"retailer", 'id' => $retailer->id]) }}"
                                                               class="over-layer">
                                                                <i class="far fa-heart heartIcon"></i>
                                                                <img src="{{ asset('images/icons/icondelivery.png') }}"
                                                                     class="markerImageIcon">
                                                            </a>
                                                        @else
                                                            <a href="#" class="over-layer">
                                                                <i class="far fa-heart heartIcon"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div class="post-content">
                                                        <div class="card-body pt-1 mobilePaddingZero">
                                                            <div class="address-line">
                                                                {{ $retailer->address_line_1 }} |
                                                                <span style="font-size: 10px;font-weight: 100;">
                                      <?php
                                                                    $latitude = '';
                                                                    $longitude = '';
                                                                    if (Session::has('latitude') && Session::has('longitude')) {
                                                                        $latitude = session('latitude');
                                                                        $longitude = session('longitude');
                                                                    } else {
                                                                        $latitude = "34.0201613";
                                                                        $longitude = "-118.6919234";
                                                                    }
                                                                    echo round(distance($latitude, $longitude, $retailer->latitude, $retailer->longitude, 'M')); ?> mi</span>
                                                            </div>
                                                            <div class="address-title">
                                                                <a href="{{ route('deliverysingle', ['slug' => $retailer->slug??"retailer", 'id' => $retailer->id]) }}"
                                                                   class="retailerTitle">
                                                                    {{ $retailer->business_name }}
                                                                </a>
                                                            </div>
                                                            <div class="rating-wrap">
                                                                {{ $retailer->business_type }}
                                                            </div>
                                                            <?php
                                                            $reviews = App\Models\RetailerReview::where('retailer_id', $retailer->id)->get();
                                                            if (count($reviews) > 0) {
                                                                $sum = 0;
                                                                foreach ($reviews as $review) {
                                                                    $sum = $sum + $review->rating;
                                                                }
                                                                $totalratings = $sum / $reviews->count();
                                                            } else {
                                                                $totalratings = 0;
                                                            }
                                                            ?>
                                                            <div class="rating-wrap">
                                                                <div class="index-rating-deliveries"
                                                                     data-rating="{{ $totalratings }}"></div>
                                                                <div class="reviewAvgCount">
                                                                    <span>{{ number_format($totalratings , 1) }}</span>
                                                                    <span>({{ count($reviews) }})</span>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('deliverysingle', ['slug' => $retailer->slug??"retailer", 'id' => $retailer->id]) }}"
                                                                   class="retailerOrderBtn order-pickup-btn"><i
                                                                        class="fas fa-shopping-cart"></i>
                                                                    <span>Order for Delivery</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-4 offset-md-4 shadow p-5 text-center">
                                            <img src="{{ asset('images/not-found.svg') }}" alt="">
                                            <h3 class="pt-3" style="font-weight: bold;">No Deliveries in your area.</h3>
                                            <p class="text-black-50 pt-2">Would you like to look for a delivery service
                                                near you or try a different address?</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

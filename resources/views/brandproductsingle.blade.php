@extends('layouts.app')

@section('Categories', ' | 420 Finder')

@section('content')

    <section class="py-0" style="margin-top: 100px;">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4">
                    <img id="productFeatured" src="{{ $product->image }}" alt="{{ $product->name }}"
                         class="w-100 img-thumbnail">
                    <ul class="list-unstyled row mt-2 brandproductgallery" style="flex-wrap: inherit;overflow-x: auto;">
                        @if(count($product['gallery']) >0)
                            @foreach($product['gallery'] as $gallery)
                                <li class="col-md-3 col-3">
                                    <img src="{{ $gallery->image }}" alt=""
                                         class="w-100 img-thumbnail cursor-pointer galleryImage">
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-8">
                    <h2 style="line-height: 1.5;"><strong>{{ $product->name }}</strong></h2>
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

                        echo " <span class='reviewCount'> (" . count($product['reviews']) . ")</span>";

                        ?>
                    </ul>
                    @php
                        $deliveryRetailersProduct = \App\Models\DeliveryProducts::where('brand_id', $product->brand_id)->get();
                        $dispensaryRetailersProduct = \App\Models\DispenseryProduct::where('brand_id', $product->brand_id)->get();
                        $total = $deliveryRetailersProduct->count() + $dispensaryRetailersProduct->count();
                    @endphp
                    <div class="row mt-4">
                        @if($total > 0 )
                            <div class="col-md-6 bg-light p-3 shadow-sm">
                                @foreach($deliveryRetailersProduct as $deliveryRetailersP)
                                    @if($deliveryRetailersP->business->business_name)
                                        <div class="form-check">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                {{$deliveryRetailersP->business->business_name}}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach($dispensaryRetailersProduct as $dispensaryRetailersPr)
                                    @if($dispensaryRetailersPr->business->business_name)
                                        <div class="form-check">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                {{$dispensaryRetailersPr->business->business_name}}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        <div class="col-md-12 mt-3">
                            <p>Available from <strong
                                    class="primary-text">{{$total}}
                                    Retailers</strong></p>
                        </div>
                        {{--                        <div class="col-md-12">--}}
                        {{--                            <h3><strong>${{ $product->suggested_price }}</strong> <span class="text-black-50"--}}
                        {{--                                                                                        style="font-size: 14px;">each</span>--}}
                        {{--                            </h3>--}}
                        {{--                        </div>--}}
                        <div class="col-md-12 mt-4">
                            <div class="favBrand">
                                @if (Session::has('customer_id') == false)
                                    <a href="{{ route('signin') }}"><i class="far fa-heart pe-4 shadow ms-3"></i></a>
                                @else
                                    <a rel="{{ $product->id }}" class="favbrandproduct cursor-pointer"><i
                                            class="far fa-heart pe-4 shadow ms-3"></i></a>
                                @endif
                                <span class="followers"> 309 followers</span>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <h4><strong>Product description</strong></h4>
                            <p><?php echo $product->description; ?></p>
                        </div>
                        <div class="col-md-12 mt-5">
                            <ul class="row list-unstyled">
                                <?php
                                $names = explode(", ", $product->subcategory_names);
                                foreach ($names as $name) {
                                    echo "<li class='col-md-1 col-2 px-0 me-3'><strong class='bg-light shadow-sm px-2'>" . $name . "</strong></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

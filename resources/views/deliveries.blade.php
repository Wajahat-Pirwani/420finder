@extends('layouts.app')
@section('title', '420 Finder Deliveries')
@section('content')
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
    <section class="fiveCols mt-5">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 col-8">
                    <h5 style="font-weight: 600;" class="pb-2">Deliveries</h5>
                    @if(!empty($location))
                        <p>Showing Marijuana Listings in <strong>{{ $location }}</strong></p>
                    @else
                        <div class="col-md-4 offset-md-4 py-3 mb-4 border text-black-50 text-center">
                            Please select your location.
                        </div>
                    @endif
                </div>
                {{-- <div class="col-md-4 col-4 text-end">
                    <a href="{{ route('deliveries') }}" style="font-weight: 600;">View all ></a>
                </div> --}}
            </div>
            <div class="row">
                @if(count($deliveries) > 0)
                    @foreach($deliveries as $delivery)
                        <div class="col-6 col-md-2 col-lg-3" style="margin-bottom: 30px">
                            <div class="post-slide" style="margin: 0">
                                <div class="post-img">
                                    @if($delivery->profile_picture == 'https://images.weedmaps.com/original/image_missing.jpg')
                                        <div style="width: auto; height: 238px;" class="bg-light defaultImage">
                                            <img src="https://420finder.net/assets/img/logo.png" class="card-img-top"
                                                 alt="..."
                                                 style="opacity: 0.3; width:100%; padding-top: 60px;padding-left: 20px;padding-right: 20px;">
                                        </div>
                                    @elseif($delivery->profile_picture == '')
                                        <div style="width: auto; height: 238px;" class="bg-light defaultImage">
                                            <img src="{{ asset('assets/img/logo.png') }}" class="card-img-top" alt="..."
                                                 style="opacity: 0.3;width:100%;padding-top: 60px;padding-left: 20px;padding-right: 20px;">
                                        </div>
                                    @else
                                        <img src="{{ $delivery->profile_picture }}" class="card-img-top"
                                             style="width: 100%; height: 238px;">
                                    @endif
                                    <a href="{{ route('deliverysingle', ['slug' => $delivery->slug??"retailer", 'id' => $delivery->id]) }}"
                                       class="over-layer">
                                        <i class="far fa-heart heartIcon"></i>
                                        <img onerror="this.src='https://420finder.net/assets/img/logo01.png'"
                                             src="{{ asset('images/icons/icondelivery.png') }}" class="markerImageIcon">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="card-body pt-1 mobilePaddingZero">
                                        <div class="address-line">
                                            {{ $delivery->address_line_1 }} |
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
                                                echo round(distance($latitude, $longitude, $delivery->latitude, $delivery->longitude, 'M')); ?> mi</span>
                                        </div>
                                        <div class="address-title">
                                            <a href="{{ route('deliverysingle', ['slug' => $delivery->slug??"retailer", 'id' => $delivery->id]) }}"
                                               class="retailerTitle">
                                                {{ $delivery->business_name }}
                                            </a>
                                        </div>
                                        <div class="rating-wrap">
                                            <div class="index-rating-deliveries"
                                                 data-rating="{{ $delivery->calculatedRating() }}"></div>
                                            <div class="reviewAvgCount">
                                                <span>{{ $delivery->calculatedRating() }}</span>
                                                <span>({{ $delivery->review_count() }})</span>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{ route('deliverysingle', ['slug' => $delivery->slug??"retailer", 'id' => $delivery->id]) }}"
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
                        <p class="text-black-50 pt-2">Would you like to look for a delivery service near you or try a
                            different address?</p>
                    </div>
                @endif
            </div>
            @if(count($deliveries) > 0)
                <div class="paginate-links retailer-page-pagination">
                    {{ $deliveries->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(".index-rating-deliveries").starRating({
            readOnly: true,
            totalStars: 5,
            starSize: 18,
            emptyColor: 'lightgray',
            activeColor: '#f8971c',
            useGradient: false
        });
    </script>
@endpush

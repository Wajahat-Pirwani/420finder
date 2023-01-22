@extends('layouts.app')
@section('Cart', '420 Finder')
@section('content')
    <section class="mt-5" style="padding-top: 0 !important">
        <div class="container mt-4">
            <div class="row pb-5">
                @if($deliverycart->count() == 0 && $dealsClaimed->count() == 0)
                    <div class="carts-img">
                        <img src="{{ asset('images/cart/emptycart_banner_desktop.jpg') }}" alt="Empty Cart Desktop"
                             class="retailer-desktop-banner">
                        <img src="{{ asset('images/cart/emptycart_banner_mobile.jpg') }}" alt="Empty Cart Mobile"
                             class="retailer-mobile-banner">
                    </div>
                @endif
                @if($deliverycart->count() > 0 || $dealsClaimed->count() > 0)
                    <h1 class="cart-order-with">Your Order With: </h1>
                    <div class="row content-row">
                        <div class="col-12 col-md-6">
                            <div class="row topDeliveryRow retailer-cart-info">
                                <div class="col-md-4 text-center col-4 mb-4">
                                    @if($business->profile_picture == '')
                                        <img src="{{ asset('assets/img/logo.png') }}" alt=""
                                             class="w-100 h-100 img-thumbnail">
                                    @else
                                        <img src="{{ $business->profile_picture }}" alt=""
                                             class="w-100 h-100 img-thumbnail">
                                    @endif
                                </div>
                                <div class="col-md-8 col-8">
                                    <h3 class="retailerbnametext text-black-50">
                                        <strong>{{ $business->business_name }}</strong></h3>
                                    <?php
                                    $reviews = App\Models\RetailerReview::where('retailer_id', $business->id)->whereNull('product_id')->get();
                                    ?>
                                    <ul class="list-unstyled d-flex ratings">
                                        <?php
                                        if (count($reviews) > 0) {
                                            $sum = 0;
                                            foreach ($reviews as $review) {
                                                $sum = $sum + $review->rating;
                                            }
                                            $totalratings = $sum / $reviews->count();
                                        } else {
                                            $totalratings = 0;
                                        }
                                        // echo " <span class='reviewCount'>(".$reviews->count().")</span>";
                                        ?>
                                        <div class="rating-wrap rating-wrap-cart">
                                            <div class="retailer-rating" data-rating="{{ $totalratings }}"></div>
                                            <div class="reviewAvgCount">
                                                <span>{{ number_format($totalratings, 1) }}</span>
                                                <span>({{ count($reviews) }})</span>
                                            </div>
                                        </div>
                                    </ul>
                                    <p class="retailerbnametext">{{ $business->city }}
                                        , {{ $business->state_province }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 retailer-contact-info">
                            <div class="row detailedBox">
                                <div class="col-md-6 col-6">
                                    <ul class="list-unstyled">
                                        <li class="pb-2"><i class="fas fa-car"></i> Delivery only</li>
                                        <li class="pb-2"><i class="fas fa-id-card"></i> {{ $business->business_type }}
                                        </li>
                                        <li class="pb-2"><i class="fas fa-shopping-cart"></i> Order online (delivery)
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6 col-6">
                                    <ul class="list-unstyled">
                                        <li class="pb-2"><i class="fas fa-clock"></i>
                                            <?php
                                            if ($business->opening_time >= date('h:i') OR $business->closing_time <= date('h:i')) {
                                                echo "<span style='color: #00b700;font-weight: bold'> OPEN </span>";
                                            } else {
                                                echo "<span style='color: rgb(227, 69, 42);font-weight: bold; margin-right: 0.2rem;'> CLOSED </span> Opens " . $business->opening_time;
                                            }
                                            ?>
                                        </li>
                                        {{-- <li class="pb-2">
                                            <i class="fas fa-check-circle"></i> License Information
                                        </li> --}}
                                        <li class="pb-2"><a href="{{ $business->instagram }}" target="_blank"><i
                                                    class="fab fa-instagram"></i> Instagram</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex retailer-contact-btn">
                                    <a href="tel:{{ $business->phone_number }}" class="btn-cta">
                                        <i class="fas fa-phone-alt"></i>
                                        <span>{{ $business->phone_number }}</span>
                                    </a>
                                    <a href="mailto:{{ $business->email }}" class="btn-cta" target="_blank">
                                        <i class="fas fa-directions"></i>
                                        <span>Email the retailer</span>
                                    </a>
                                    <div class="favBrand favoriteButton">
                                        @if (Session::has('customer_id') == false)
                                            <a href="{{ route('signin') }}"><i
                                                    class="far fa-heart pe-4 shadow ms-3"></i></a>
                                        @else
                                            <a rel="{{ $business->id }}" class="favdelivery cursor-pointer"><i
                                                    class="far fa-heart pe-4 shadow ms-3"></i></a>
                                        @endif
                                        <span class="followers"> 309 followers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($deliverycart->count() > 0 || $dealsClaimed->count() > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mb-4"><strong>Your Items</strong></h4>
                        </div>
                        <div class="col-12 col-md-6">
                            @if($deliverycart->count() > 0)
                                @if(session()->has('update-cart'))
                                    <div class="alert alert-success">
                                        {{ session()->get('update-cart') }}
                                    </div>
                                @endif
                                <h6 style="font-weight: bold;">Products</h6>
                                <form action="{{ route('update-cart') }}" method="POST" id="update-cart-form">
                                    @csrf
                                    @foreach($deliverycart as $key => $item)
                                        <div class="card p-3 mb-2">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <img src="{{ $item->image }}" class="w-100 img-thumbnail">
                                                        </div>
                                                        <div class="col-9">
                                                            <p><strong>{{ $item->name }}  @if($item->flower_price_name)
                                                                        ( {{ $item->flower_price_name }} )
                                                                    @endif</strong>
                                                            </p>{{-- <p class="mt-4" style="font-size: 18px;"><strong>${{ $item->price }}</strong></p> --}}
                                                            <update-cart-item price="{{ $item->price }}"
                                                                              quantity="{{ $item->qty }}"
                                                                              loopkey="{{ $key }}"
                                                                              productid="{{ $item->product_id }}"></update-cart-item>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <a href="{{ route('deletedeliverycartitem', ['id' => $item->cartid]) }}"
                                                       onclick="return confirm('Are you sure you want to remove this item?');"
                                                       class="btn border text-black-50 shadow-sm"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn update-cart-btn" id="update-cart-submit-btn">Update
                                        Cart
                                    </button>
                                </form>
                            @endif
                            @if($dealsClaimed->count() > 0)
                                <h6 style="margin-top: 1.3rem;
                    font-weight: bold;">Deals</h6>
                            @endif
                            @foreach($dealsClaimed as $deal)
                                <div class="card p-3 mb-2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="{{ json_decode($deal->picture)[0] }}"
                                                         class="w-100 img-thumbnail">
                                                </div>
                                                <div class="col-9">
                                                    <p><strong>{{ $deal->title }}</strong></p>
                                                    <p class="mt-4" style="font-size: 18px;">
                                                        <strong>${{ $deal->deal_price }}</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <a href="{{ route('deletedealsClaimed', ['id' => $deal->id]) }}"
                                               onclick="return confirm('Are you sure you want to remove this deal?');"
                                               class="btn border text-black-50 shadow-sm"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card p-3">
                                <p class="border-bottom pb-2"><strong>Subtotal
                                        ( {{ $deliverycart->count() + $dealsClaimed->count() }} item ) </strong></p>
                                <ul class="list-unstyled">
                                    <?php $sum = 0;
                                    $indexOuter = 0;
                                    ?>
                                    @foreach($deliverycart as $index => $side)
                                        <li class="pb-3">
                                            <div class="row">
                                                <div class="col-6 d-flex">
                                                    <div>
                                                        <strong>{{ $indexOuter = $indexOuter + 1 }}. </strong>
                                                        <img src="{{ $side->image }}" class="img-thumbnail"
                                                             style="width: 30px;height: 30px;">
                                                    </div>
                                                    <div style="padding-left: 0.6rem;">
                                                        {{ Str::limit($side->name, 60,'...')}}
                                                        <div>
                                                            <span
                                                                style="padding-right: 0.3rem;"> ${{ $side->price }} </span>
                                                            <span
                                                                style="padding-right: 0.5rem;"> x {{ $side->qty }} </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex justify-content-end">
                                                    <?php $totalSidePrice = $side->price * $side->qty?>
                                                    <span><strong> ${{ $totalSidePrice }}</strong></span>
                                                </div>
                                            </div>
                                        </li>
                                        <?php $sum = $sum + $totalSidePrice; ?>
                                    @endforeach
                                    <?php $dealsSum = 0; ?>
                                    @foreach($dealsClaimed as $index => $deal)
                                        <li class="pb-3">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <strong>{{ $indexOuter = $indexOuter + 1 }}. </strong>
                                                    <img src="{{ json_decode($deal->picture)[0] }}"
                                                         class="img-thumbnail" style="width: 30px;height: 30px;">
                                                    {{ Str::limit($deal->title, 60,'...')}}
                                                </div>
                                                <div class="col-md-3 d-flex justify-content-end">
                                                    <span><strong>${{ $deal->deal_price }}</strong></span>
                                                </div>
                                            </div>
                                        </li>
                                        <?php $dealsSum = $dealsSum + $deal->deal_price; ?>
                                    @endforeach
                                </ul>
                                <div class="row border-top pt-3">
                                    <div class="col-6">
                                        <p>
                                            <strong>Order Total</strong>
                                        </p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p><strong>${{ $sum + $dealsSum }}</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card p-3 mt-3">
                                @include('partials.success-error')
                                <form action="{{ route('stripe.post') }}" method="post" id="paymentForm"
                                      class="delivery-cart-form">
                                    @csrf
                                    <div class="form-group pb-2">
                                        <label for=""><strong>Name on Order</strong></label>
                                        <input type="text" name="nameonorder" placeholder="Enter Name"
                                               class="form-control" value="{{ old('nameonorder') }}">
                                    </div>
                                    <div class="form-group pb-2">
                                        <label for=""><strong>Phone Number</strong></label>
                                        <input type="text" name="phone_number" placeholder="Enter Phone Number"
                                               class="form-control" id="phoneNumber" value="{{ old('phone_number') }}">
                                    </div>
                                    <div class="form-group pb-2">
                                        <label for=""><strong>Name on ID</strong></label>
                                        <input type="text" name="nameonid" placeholder="Enter Name on ID"
                                               class="form-control" value="{{ old('nameonid') }}">
                                    </div>
                                    <div class="form-group pb-2">
                                        <label for=""><strong>ID Type</strong></label>
                                        <select name="id_type" id="" class="form-control">
                                            <option value="">Select ID Type</option>
                                            <option
                                                value="Driver License" {{ old('id_type') == 'Driver License' ? "selected" : "" }}>
                                                Driver License
                                            </option>
                                            <option
                                                value="Passport" {{ old('id_type') == 'Passport' ? "selected" : "" }}>
                                                Passport
                                            </option>
                                            <option value="ID Card" {{ old('id_type') == 'ID Card' ? "selected" : "" }}>
                                                ID Card
                                            </option>
                                            <option
                                                value="Military ID" {{ old('id_type') == 'Military ID' ? "selected" : "" }}>
                                                Military ID
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group pb-2">
                                        <label for=""><strong>ID Number</strong></label>
                                        <input type="text" name="id_number" placeholder="Enter ID Number"
                                               class="form-control" value="{{ old('id_number') }}">
                                    </div>
                                    <div class="form-group pb-2">
                                        <label for=""><strong>Delivery Address</strong></label>
                                        <input type="text" name="delivery_address" placeholder="Enter Delivery Address"
                                               class="form-control" value="{{ old('delivery_address') }}">
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for=""><strong>City</strong></label>
                                                <input type="text" name="city" class="form-control"
                                                       value="{{ old('city') }}" placeholder="Enter City">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for=""><strong>State</strong></label>
                                                <input type="text" name="state" class="form-control"
                                                       value="{{ old('state') }}" placeholder="Enter State">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for=""><strong>Zip Code</strong></label>
                                                <input type="number" name="zip_code" class="form-control"
                                                       value="{{ old('zip_code') }}" placeholder="Enter Zip Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group pb-2">
                                        <label for=""><strong>Additional Delivery Notes:</strong></label>
                                        <textarea name="additional_notes"
                                                  placeholder="Enter Additional Delivery Notes..." cols="5" rows="5"
                                                  class="form-control">{{ old('additional_notes') }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="btn appointment-btn m-0 w-100 delivery-cart-submit"
                                                    type="submit" id="payButton">Place Order
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/star-rating/star-rating-svg.css') }}">
@endsection
@push('scripts')
    <script type="application/javascript" src="{{ asset('assets/js/star-rating/jquery.star-rating-svg.js') }}"></script>
    <script>
        $(function () {
            $(".delivery-cart-form").submit(function () {
                $(".delivery-cart-submit").attr("disabled", true);
                return true;
            });
            $("#update-cart-form").submit(function () {
                $("#update-cart-submit-btn").attr("disabled", true);
                return true;
            });
        });
        $(".retailer-rating").starRating({
            readOnly: true,
            totalStars: 5,
            starSize: 18,
            emptyColor: 'lightgray',
            activeColor: '#f8971c',
            useGradient: false
        });
        $('#phoneNumber').on('change', function () {
            let phoneNumber = $('#phoneNumber').val();
            let x = phoneNumber.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            phoneNumber = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
            $('#phoneNumber').val(phoneNumber);
        });
    </script>
@endpush

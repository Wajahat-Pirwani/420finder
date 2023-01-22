@extends('layouts.app')

    @section('title', '420 Finder')

    @section('content')

    <section class="mt-5 pt-5">

        <div class="container mt-4">

            <div class="row pt-5 customerLeftSidebar">

                <div class="col-md-3">
                    @include('partials/sidebar')
                </div>

                <div class="col-md-9">

                    <div class="card p-3">

                        <div class="row">
                            <div class="col-md-6">
                                <h6>Order #{{ $tracking_number }} details</h6>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('orderhistory') }}" class="btn border bg-white shadow-sm btn-sm">Go Back</a>
                            </div>
                        </div>
                        <?php $total = 0?>
                        @if($orderProducts->count() > 0)
                        <div class="row mt-3">

                            <div class="col-md-12">

                                <h6 style="font-weight: bold;
                                margin: 0.3rem 0 0.7rem;
                                border-bottom: 2px solid #f8971c;
                                display: inline-block;
                                padding-bottom: 0.3rem;">Products</h6>

                                <div class="table-responsive">

                                    <table class="table table-hover">

                                        <thead>
                                            <th>#</th>
                                            <th>Retailer</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                        </thead>

                                        <tbody>

                                            @if($orderProducts->count() > 0)
                                                @foreach($orderProducts as $index => $order)
                                                    <?php $total = $total + $order->price; ?>
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            <?php
                                                                $retailer = App\Models\Business::where('id', $order->retailer_id)->select('business_name', 'business_type')->first();
                                                                echo $retailer->business_name . '<br><span class="text-black-50" style="font-size: 12px;">( ' . $retailer->business_type . ' )</span>';
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if ($retailer->business_type == 'dispensary') {
                                                                    if($order->product_id != null){
                                                                        $product = App\Models\DispenseryProduct::where('id', $order->product_id)->select('name', 'image')->first();
                                                                    }else{

                                                                    }
                                                                    echo "<img src=" . $product->image . " style='width: 50px;height:50px;'> " . substr($product->name, 0,30)."...";
                                                                } else {
                                                                    if($order->product_id != null){

                                                                        $product = App\Models\DispenseryProduct::where('id','=', $order->product_id)->select('name', 'image')->first();

                                                                    }else{
                                                                        dd('zohaib');
                                                                        $product = App\Models\Deal::where('id', $order->deal_id)->select('title AS name', 'picture AS image')->first();
                                                                        dd($product);
                                                                    }
                                                                    echo "<img src=" . $product->image . " style='width: 50px;height:50px;'> " . substr($product->name, 0,30)."...";
                                                                }

                                                            ?>
                                                        </td>
                                                        <td>{{ $order->qty }}</td>
                                                        <td>${{ $order->price }}</td>
                                                    </tr>

                                                @endforeach
                                                {{-- <tr class="bg-light">
                                                    <td colspan="2"><strong>Total Paid:</strong></td>
                                                    <td colspan="3" class="text-end"><strong>$<?php
                                                    //  echo $total;
                                                      ?></strong></td>
                                                </tr> --}}
                                            @else
                                                {{-- <tr class="text-center">
                                                    <td colspan="5">No Orders yet.</td>
                                                </tr> --}}
                                            @endif

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>
                        @endif

                        {{-- DEALS --}}
                        @if($orderDeals->count() > 0)
                        <div class="row mt-3">

                            <div class="col-md-12">

                                <h6 style="font-weight: bold;
                                margin: 0.3rem 0 0.7rem;
                                border-bottom: 2px solid #f8971c;
                                display: inline-block;
                                padding-bottom: 0.3rem;">Deals</h6>

                                <div class="table-responsive">

                                    <table class="table table-hover">

                                        <thead>
                                            <th>#</th>
                                            <th>Retailer</th>
                                            <th>Title</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                        </thead>

                                        <tbody>

                                            @if($orderDeals->count() > 0)
                                                @foreach($orderDeals as $index => $order)
                                                    <?php $total = $total + $order->price; ?>
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <?php
                                                                $retailer = App\Models\Business::where('id', $order->retailer_id)->select('business_name', 'business_type')->first();
                                                                echo $retailer->business_name . '<br><span class="text-black-50" style="font-size: 12px;">( ' . $retailer->business_type . ' )</span>';
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php

                                                                    $deal = App\Models\Deal::where('id', $order->deal_id)->first();
                                                                    echo "<img src=" . json_decode($deal->picture)[0] . " style='width: 50px;height:50px;'> " . $deal->title;

                                                            ?>
                                                        </td>
                                                        <td>{{ $order->qty }}</td>
                                                        <td>${{ $order->price }}</td>

                                                    </tr>

                                                @endforeach
                                            @else
                                            @endif

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                         </div>
                        @endif

                        {{-- TOTAL --}}
                        @if($orderProducts->count() > 0 || $orderDeals->count() > 0)
                        <div class="row mt-3">
                            <div class="total-paid" style="display: flex; justify-content: space-between">
                                <h6 style="font-weight: bold;
                                margin: 0.3rem 0 0.7rem;
                                display: inline-block;
                                font-size: 1.2rem;
                                padding-bottom: 0.3rem;">Total:</h6>
                                <span style="font-weight: bold;
                                font-size: 1.2rem;">$ {{ $total }}</span>
                            </div>
                        </div>
                        @endif

                        {{-- No Products / Deals --}}
                        @if($orderProducts->count() < 1 && $orderDeals->count() < 1 )
                        <div class="row mt-3">
                            <div style="text-align: center">
                                <p>No products / deals found</p>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

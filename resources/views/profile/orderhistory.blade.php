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

                        <h6>My Orders</h6>

                        <div class="row mt-3">

                            <div class="col-md-12">

                                <div class="table-responsive">

                                    <table class="table table-hover">

                                        <thead>
                                            <th>Order Number</th>
                                            <th>Retailer Info</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </thead>

                                        <tbody>

                                            @if($orders->count() > 0)
                                                @foreach($orders as $order)

                                                    <tr>
                                                        <td><strong>{{ $order->tracking_number }}</strong></td>
                                                        <td>
                                                            <?php
                                                                $retailer = App\Models\Business::where('id', $order->retailer_id)->select('business_name', 'business_type')->first();
                                                                echo $retailer->business_name . '<br><span class="text-black-50" style="font-size: 12px;">( ' . $retailer->business_type . ' )</span>';
                                                            ?>
                                                        </td>

                                                        <?php
                                                           $orderPrice =  App\Models\Order::where('tracking_number', $order->tracking_number)->sum('price')
                                                        ?>
                                                        <td>${{ $orderPrice }}</td>
                                                        <td>{{ $order->status }}</td>
                                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                                        <td>
                                                            <a href="{{ route('orderdetails', ['tracking_number' => $order->tracking_number]) }}" class="btn border shadow-sm bg-white btn-sm"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>

                                                @endforeach

                                            @else
                                                <tr class="text-center">
                                                    <td colspan="5">No Orders yet.</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

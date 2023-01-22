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
                  <h6>My Reviews ( {{ $reviews->count() }} )</h6>

                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="table-responsive">

                        <table class="table table-hover" style="font-size: 12px;">

                          <thead>
                            <th>#</th>
                            <th>Retailer</th>
                            <th>Product / Retailer </th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Created At</th>
                            <th>Remove</th>
                          </thead>

                          <tbody>
                            @if($reviews->count() > 0)

                              @foreach($reviews as $index => $review)

                                <tr>
                                  <td>{{ $index + 1 }}</td>
                                  <td>
                                    <?php
                                        $retailer = App\Models\Business::where('id', $review->retailer_id)->select('business_name', 'business_type')->first();
                                        echo $retailer->business_name . '<br><span class="text-black-50" style="font-size: 12px;">( ' . $retailer->business_type . ' )</span>';
                                    ?>
                                  </td>
                                  <td width="300">
                                    <?php
                                        if ($retailer->business_type == 'Dispensary') {
                                           // echo 'Dispensary';

                                            if(is_null($review->product_id)) {
                                                echo 'Retailer';
                                            } else {
                                            $product = App\Models\DispenseryProduct::where('id', $review->product_id)->select('name', 'image')->first();
                                            echo "<img src=" . $product->image . " style='width: 50px;height:50px;'> " . substr($product->name, 0,30)."...";
                                            }
                                        } else {
                                            if(is_null($review->product_id)) {
                                                echo 'Retailer';
                                            } else {
                                            $product = App\Models\DeliveryProducts::where('id', $review->product_id)->select('name', 'image')->first();
                                            echo "<img src=" . $product->image . " style='width: 50px;height:50px;'> " . substr($product->name, 0,30)."...";
                                           }
                                        }
                                    ?>
                                  </td>
                                  <td>{{ $review->rating }}</td>
                                  <td>{{ substr($review->description, 0, 20) }}...</td>
                                  <td>{{ $review->created_at->diffForHumans() }}</td>
                                  <td><a href="{{ route('removereview', ['id' => $review->id]) }}" onclick="return confirm('Are you sure you want to delete this review?');" class="btn border bg-white btn-sm shadow-sm">Remove</a></td>
                                </tr>

                              @endforeach

                            @else

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

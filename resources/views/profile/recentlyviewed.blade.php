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
                  <h6>Recently Viewed</h6>

                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="table-responsive">

                        <table class="table table-hover" style="font-size: 12px;">

                          <thead>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Picture</th>
                            <th>Product From</th>
                            <th>View</th>
                            <th>Remove</th>
                            <th>Created At</th>
                          </thead>

                          <tbody>
                            @if($recentlyvieweds->count() > 0)

                              @foreach($recentlyvieweds as $index => $recent)

                                @if($recent->type == 'dispensary')

                                  <?php

                                    $dispensary = App\Models\DispenseryProduct::where('id', $recent->product_id)->first();

                                  ?>

                                  <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $dispensary->name }}</td>
                                    <td>
                                      <img src="{{ $dispensary->image }}" class="img-thumbnail" style="width: 25px; height: 25px;">
                                    </td>
                                    <td>
                                      Dispensary
                                    </td>
                                    <td>
                                      <a href="">View</a>
                                    </td>
                                    <td>
                                      <a href="{{ route('removerecentproduct', ['id' => $recent->id]) }}" class="text-danger" onclick="return confirm('Are you sure you want to remove?');">Remove</a>
                                    </td>
                                    <td>{{ $recent->created_at }}</td>
                                  </tr>

                                @else

                                  <?php

                                    $delivery = App\Models\DeliveryProducts::where('id', $recent->product_id)->first();

                                  ?>

                                  <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $delivery->name }}</td>
                                    <td>
                                      <img src="{{ $delivery->image }}" class="img-thumbnail" style="width: 25px; height: 25px;">
                                    </td>
                                    <td>
                                      Delivery
                                    </td>
                                    <td>
                                      <a href="">View</a>
                                    </td>
                                    <td>
                                      <a href="{{ route('removerecentproduct', ['id' => $recent->id]) }}" class="text-danger" onclick="return confirm('Are you sure you want to remove?');">Remove</a>
                                    </td>
                                    <td>{{ $recent->created_at }}</td>
                                  </tr>

                                @endif

                              @endforeach

                            @else
                              <tr class="text-center">
                                <td colspan="7">No Product Added.</td>
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

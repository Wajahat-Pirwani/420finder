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
                  <h6>Deals Purchased ( {{ $dealsPurchased->count() }} )</h6>

                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="table-responsive">

                        <table class="table table-hover">

                          <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Created At</th>
                          </thead>

                          <tbody>

                            @forelse ($dealsPurchased as $deal)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $deal->title }}
                                    </td>
                                    <td>
                                        <img src="{{ json_decode($deal->picture)[0] }}" alt="Deal Image" height="60px" width="60px">
                                    </td>
                                    <td>
                                        $ {{ $deal->deal_price }}
                                    </td>
                                    <td>
                                        {{ $deal->status }}
                                    </td>
                                    <td>
                                        {{ $deal->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"> No Deals Purchased Yet.</td>
                                </tr>
                            @endforelse
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
